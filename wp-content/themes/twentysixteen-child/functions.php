<?php
// include_once("custom-fields.php");

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


/*-----------------------------------------------------------------------------------*/
/* Custom Return Data */
/*-----------------------------------------------------------------------------------*/
function ual_futures_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$student = get_fields( $post );

  $_data = array_merge($_data, $student);

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
  
  // unset($_data["categories"]);

  $_data["appData"] = "posts";

	return $_data;
}
add_filter( 'rest_prepare_post', 'ual_futures_prepare_post', 10, 3 );


function ual_futures_prepare_event( $data, $post, $request ) {
  $_data = $data->data;
  $student = get_fields( $post );

  $_data = array_merge($_data, $student);

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
  
  // unset($_data["categories"]);

  $_data["appData"] = "events";

  return $_data;
}
add_filter( 'rest_prepare_event', 'ual_futures_prepare_event', 10, 3 );


function ual_futures_prepare_opportunity( $data, $post, $request ) {
  $_data = $data->data;
  $student = get_fields( $post );

  $_data = array_merge($_data, $student);

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
  
  // unset($_data["categories"]);

  $_data["appData"] = "opportunities";

  return $_data;
}
add_filter( 'rest_prepare_opportunity', 'ual_futures_prepare_opportunity', 10, 3 );



// Ask browser to cache the return data
add_filter( 'rest_cache_headers', function() {
    return array( 'Cache-Control' => 'private,max-age=172800' );
});


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
      'show_in_rest' => true
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
      'show_in_rest' => true
    )
  );
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