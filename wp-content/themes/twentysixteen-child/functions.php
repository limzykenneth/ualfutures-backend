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
function student_data_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$student = get_fields( $post );

	if ($student == false) {
		return;
	}

  $_data = $student;

  if ($_data["hero_image_video"] == "Image"){
    $_data["hero_image"] = $student["hero_image"]["url"];
    if ($student["hero_image"]["sizes"]["medium"]){
      $_data["hero_image_medium"] = $student["hero_image"]["sizes"]["medium_large"];
    }else{
      $_data["hero_image_medium"] = $student["hero_image"]["url"];
    }
  }
  if ($_data["image_video_1"] == "Image"){
    $_data["image_1"] = $student["image_1"]["url"];
    if ($student["image_1"]["sizes"]["medium"]){
      $_data["image_1_medium"] = $student["image_1"]["sizes"]["medium_large"];
    }else{
      $_data["image_1_medium"] = $student["image_1"]["url"];
    }
  }
  if ($_data["image_video_2"] == "Image"){
    $_data["image_2"] = $student["image_2"]["url"];
    if ($student["image_2"]["sizes"]["medium"]){
      $_data["image_2_medium"] = $student["image_2"]["sizes"]["medium_large"];
    }else{
      $_data["image_2_medium"] = $student["image_2"]["url"];
    }
  }

  if ($_data["hero_image"] === false){
    unset($_data["hero_image"]);
  }
  if ($_data["image_1"] === false){
    unset($_data["image_1"]);
  }
  if ($_data["image_2"] === false){
    unset($_data["image_2"]);
  }

	$_data['id'] = $student['student_number'];

  // Parse other field into tags
	$other_tags = explode(",", $_data['other:']);
	foreach ($other_tags as &$value) {
	    $value = trim($value);
	}
	$_data['tags'] = array_merge($_data['tags'], $other_tags);

  for ($i; $i<count($_data['tags']); $i++){
    if ($_data['tags'][$i] == ""){
      unset($_data['tags'][$i]);
    }
  }

	unset($_data['other:']);
	return $_data;
}
add_filter( 'rest_prepare_student_info', 'student_data_prepare_post', 10, 3 );



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
}


/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/
// function remove_admin_menu_items() {
//   $remove_menu_items = array(__('Links'),__('Posts'),__('Comments'),__('Pages'));
//   global $menu;
//   end ($menu);
//   while (prev($menu)){
//     $item = explode(' ',$menu[key($menu)][0]);
//     if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
//     unset($menu[key($menu)]);}
//   }
// }
// add_action('admin_menu', 'remove_admin_menu_items');



/*-----------------------------------------------------------------------------------*/
/* Don't ask me what this do */
/*-----------------------------------------------------------------------------------*/
add_filter( 'wpmu_signup_user_notification', '__return_false' );