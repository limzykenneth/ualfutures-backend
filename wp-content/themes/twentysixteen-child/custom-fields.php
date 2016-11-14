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
}