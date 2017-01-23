<?php
include_once("custom-fields.php");

// We don't need that. Please write up to date jQuery.
add_action('wp_default_scripts', function($scripts) {
    if (!empty( $scripts->registered['jquery'])) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff($jquery_dependencies, array('jquery-migrate'));
    }
});

// import parent's style.css
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// import custom javascripts
add_action( 'admin_enqueue_scripts', 'include_custom_js' );
function include_custom_js(){
    wp_register_script("multi_select", "/wp-content/themes/twentysixteen-child/multi-select.js", array(), NULL);
    wp_enqueue_script("multi_select");
}

add_action('admin_head', 'custom_admin_styles');
function custom_admin_styles() {
  echo '<style>
    .wp-pointer{
      display: none !important;
    }
  </style>';
}

// Set CORS headers
// function add_cors_http_header(){
//     header("Access-Control-Allow-Origin: *");
// }
// add_action('rest_api_init','add_cors_http_header');


function additional_routes(){
  register_rest_route( 'futures_categories', '/(?P<id>.+)', array(
    'methods' => 'GET',
    'callback' => 'futures_get_categories',
    'args' => array(
      'id' => array(
        'validate_callback'  => function($param, $request, $key) {
          // validate parameters
          return true;
        }
      ),
    ),
  ));
}


function futures_get_categories(WP_REST_Request $request){
  $param = urldecode($request['id']);
  $param = $param . " Categories";

  global $wpdb;
  $statement = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s", $param);
  $group_ID = $wpdb->get_var($statement);

  $fields = array();
  $fields = apply_filters('acf/field_group/get_fields', $fields, $group_ID);

  $categories = $fields[0]["choices"];
  if(!$categories){
    $categories = null;
  }
  return $categories;
}
add_action("rest_api_init", "additional_routes");


/*-----------------------------------------------------------------------------------*/
/* Custom Return Data */
/*-----------------------------------------------------------------------------------*/
function ual_futures_prepare_post( $data, $post, $request ) {
  $_data = general_prepare_posts($data, $post->ID, $request);
  $_data["appData"] = "features";

  $_data["tags"] = [];
  $temp_tags = wp_get_post_tags($post->ID, array('fields' => 'names'));

  foreach($temp_tags as $tag){
    array_push($_data["tags"], $tag);
  }

  $_data["level"] = 2;

  $_data["category"] = "Features";

	return $_data;
}
add_filter( 'rest_prepare_post', 'ual_futures_prepare_post', 10, 3 );


function ual_futures_prepare_events( $data, $post, $request ) {
  $_data = general_prepare_posts($data, $post->ID, $request);

  $ch = curl_init("http://localhost:8081/eb");

  $options = array(
    CURLOPT_RETURNTRANSFER => true,   // return web page
    CURLOPT_HEADER         => false,  // don't return headers
    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
    CURLOPT_ENCODING       => "",     // handle compressed
    CURLOPT_USERAGENT      => "test", // name of client
    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
    CURLOPT_TIMEOUT        => 120,    // time-out on response
  );

  curl_setopt_array($ch, $options);

  $request_header = "url:" . $_data['eventbrite_url'];
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    $request_header,
  ));

  $content  = curl_exec($ch);
  curl_close($ch);

  $_data["ebData"] = json_decode($content);

  if($_data["category"] == "Futures"){
    $_data["level"] = "1";
  }else{
    $_data["level"] = "0";
  }

  $_data["appData"] = "events";

  // $_data["debug"] = $request_header;

  return $_data;
}
add_filter( 'rest_prepare_events', 'ual_futures_prepare_events', 10, 3 );


function ual_futures_prepare_opportunities( $data, $post, $request ) {
  $_data = general_prepare_posts($data, $post->ID, $request);
  $_data["level"] = "0";
  $_data["appData"] = "opportunities";

  return $_data;
}
add_filter( 'rest_prepare_opportunities', 'ual_futures_prepare_opportunities', 10, 3 );


function ual_futures_prepare_directories( $data, $post, $request ) {
  $_data = general_prepare_posts($data, $post->ID, $request);
  $_data["level"] = "0";
  $_data["appData"] = "directory";

  return $_data;
}
add_filter( 'rest_prepare_directories', 'ual_futures_prepare_directories', 10, 3 );


function general_prepare_posts($data, $postID, $request){
  $_data = $data->data;
  $post = get_fields( $post );

  $_data = array_merge($_data, $post);

  unset($_data["acf"]);
  unset($_data["link"]);
  unset($_data["guid"]);
  $_data["title"] = $_data["title"]["rendered"];
  $_data["content"] = $_data["content"]["rendered"];
  unset($_data["excerpt"]);
  unset($_data["featured_media"]);
  unset($_data["comment_status"]);
  unset($_data["ping_status"]);
  unset($_data["sticky"]);
  unset($_data["meta"]);
  $_data["date_gmt"] = $_data["date_gmt"] . "Z";

  $_data["tags"] = [];
  $temp_tags = wp_get_post_terms($postID, "tags", array("fields" => "names"));

  foreach($temp_tags as $tag){
    array_push($_data["tags"], $tag);
  }

  // $temp_cat = wp_get_post_categories($postID, array('fields' => 'names'));
  // $_data["category"] = $temp_cat[0];

  unset($_data["categories"]);
  unset($_data[""]);

  return $_data;
}


function ual_futures_prepare_slideshow( $data, $post, $request ) {
  // $_data = $data->data;
  $post = get_fields( $post );

  foreach ($post as $i => $value) {
    if($value == false){
      unset($post[$i]);
    }
  }

  $post["size"] = count($post) / 2;

  // $_data = array_merge($_data, $post);
  $_data["slideshow"] = $post;
  return $_data;
}

add_filter( 'rest_prepare_slideshow', 'ual_futures_prepare_slideshow', 10, 3 );


function ual_futures_prepare_about( $data, $post, $request ) {
  $_data = $data->data;

  unset($_data["guid"]);
  unset($_data["link"]);
  unset($_data["acf"]);
  $_data["title"] = $_data["title"]["rendered"];
  $_data["content"] = $_data["content"]["rendered"];

  return $_data;
}

add_filter( 'rest_prepare_about', 'ual_futures_prepare_about', 10, 3 );

// Ask browser to cache the return data
// add_filter( 'rest_cache_headers', function() {
//     return array( 'Cache-Control' => 'private,max-age=172800' );
// });


/*-----------------------------------------------------------------------------------*/
/* Custom Post Type */
/*-----------------------------------------------------------------------------------*/

// Create the student_info post type
add_action('init', 'create_post_type');

function create_post_type() {
  register_post_type('events',
    array(
      'labels' => array(
        'name' => __('Events'),
        'singular_name' => __('Event')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
    )
  );

  register_post_type('opportunities',
    array(
      'labels' => array(
        'name' => __('Opportunities'),
        'singular_name' => __('Opportunity')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
    )
  );

  register_post_type('directories',
    array(
      'labels' => array(
        'name' => __('Directories'),
        'singular_name' => __('Directory')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
    )
  );

  register_post_type('slideshow',
    array(
      'labels' => array(
        'name' => __('Slideshow'),
        'singular_name' => __('Slideshow')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true
    )
  );

  register_post_type('about',
    array(
      'labels' => array(
        'name' => __('About'),
        'singular_name' => __('About')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true
    )
  );
}

/* Custom Post Type Tags */
add_action( 'init', 'create_tag_taxonomies', 0 );

function create_tag_taxonomies(){
  $tag_labels = array(
      'name'              => _x( 'Tags', 'taxonomy general name' ),
      'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Tags' ),
      'all_items'         => __( 'All Tags' ),
      'parent_item'       => null,
      'parent_item_colon' => null,
      'edit_item'         => __( 'Edit Tag' ),
      'update_item'       => __( 'Update Tag' ),
      'add_new_item'      => __( 'Add New Tag' ),
      'new_item_name'     => __( 'New Tag Name' ),
      'menu_name'         => __( 'Tags' ),
    );

    $tag_args = array(
      'hierarchical'      => false,
      'labels'            => $tag_labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'tag' ),
      'show_in_rest'       => true,
      'rest_base'          => 'tags',
      'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'tags', array( 'events', 'opportunities', 'directories' ), $tag_args );
}


/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/
function remove_admin_menu_items() {
  $remove_menu_items = array(__('Links'),__('Comments'));
  global $menu;
  end ($menu);
  while (prev($menu)){
    $item = explode(' ',$menu[key($menu)][0]);
    if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
    unset($menu[key($menu)]);}
  }
}
add_action('admin_menu', 'remove_admin_menu_items');



/*-----------------------------------------------------------------------------------*/
/* Don't ask me what this do */
/*-----------------------------------------------------------------------------------*/
add_filter( 'wpmu_signup_user_notification', '__return_false' );