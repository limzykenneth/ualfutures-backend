<?php
/*-----------------------------------------------------------------------------------*/
/* Custom Fields */
/*-----------------------------------------------------------------------------------*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_directories',
		'title' => 'Directories',
		'fields' => array (
			array (
				'key' => 'field_58286149b37e8',
				'label' => 'External Links',
				'name' => 'external_links',
				'type' => 'textarea',
				'instructions' => 'Enter one link per line',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'directories',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_events',
		'title' => 'Events',
		'fields' => array (
			array (
				'key' => 'field_5814ade3d47a1',
				'label' => 'Eventbrite URL',
				'name' => 'eventbrite_url',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_582861077277e',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_582861077277f',
				'label' => 'Event Date',
				'name' => 'event_date',
				'type' => 'date_time_picker',
				'required' => 1,
				'field_type' => 'date_time',
				'date_format' => 'yy-mm-dd',
				'time_format' => 'HH:mm',
				'past_dates' => 'yes',
				'first_day' => 1,
				'time_selector' => 'select'
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_opportunities',
		'title' => 'Opportunities',
		'fields' => array (
			array (
				'key' => 'field_581550ad8bf27',
				'label' => 'Job/Opportunity type',
				'name' => 'opps_type',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_581550db8bf28',
				'label' => 'Poster',
				'name' => 'poster',
				'type' => 'text',
				'instructions' => 'Who is looking for candidate?',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'opportunities',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_required-fields-for-all',
		'title' => 'Required fields for all',
		'fields' => array (
			array (
				'key' => 'field_5814a64ac9832',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5814a64ac9830',
				'label' => 'Authors',
				'name' => 'created_by',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Written by ...',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5814a5e1c9831',
				'label' => 'Post feature level',
				'name' => 'level',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					0 => 0,
					1 => 1,
					2 => 2,
				),
				'default_value' => 0,
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_58154fc657456',
				'label' => 'Cover photo',
				'name' => 'cover_photo',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'opportunities',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'directories',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	// Slideshow content
	register_field_group(array (
		'id' => 'acf_slideshow',
		'title' => 'Slideshow',
		'fields' => createSlidesFields(10),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slideshow',
					'order_no' => 0,
					'group_no' => 0,
				)
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

function createSlidesFields($number_of_slides){
	$result = array();

	$fields_id = 1;
	for ($i = 1; $i <= $number_of_slides; $i++) {
		$first_field = 	array (
						'key' => 'field_' . $fields_id,
						'label' => 'Slide ' . $i,
						'name' => 'slide_' . $i,
						'type' => 'select',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_' . ($fields_id - 3),
									'operator' => '==',
									'value' => 'Text',
								),
								array (
									'field' => 'field_' . ($fields_id - 3),
									'operator' => '==',
									'value' => 'Image',
								),
							),
							'allorany' => 'any',
						),
						'choices' => array (
							'Text' => 'Text',
							'Image' => 'Image',
						),
						'default_value' => '',
						'allow_null' => 1,
						'multiple' => 0,
					);
		if($i == 1){
			unset($first_field['conditional_logic']);
		}
		$fields_id++;

		$second_field = array (
							'key' => 'field_' . $fields_id,
							'label' => 'Text ' . $i,
							'name' => 'text_' . $i,
							'type' => 'text',
							'required' => 1,
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_' . ($fields_id - 1),
										'operator' => '==',
										'value' => 'Text',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'html',
							'maxlength' => '',
						);
		$fields_id++;

		$third_field =  array (
							'key' => 'field_' . $fields_id,
							'label' => 'Image ' . $i,
							'name' => 'image_' . $i,
							'type' => 'image',
							'required' => 1,
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_' . ($fields_id - 2),
										'operator' => '==',
										'value' => 'Image',
									),
								),
								'allorany' => 'all',
							),
							'save_format' => 'url',
							'preview_size' => 'medium',
							'library' => 'all',
						);
		$fields_id++;

		array_push($result, $first_field, $second_field, $third_field);
	}

	return $result;
}