<?php
/* Some setup */
define('B3P_TESTIMONIAL_NAME', "Testimonials");
define('B3P_TESTIMONIAL_SINGLE', "Testimonial");
define('B3P_TESTIMONIAL_TYPE', "B3P-testimonial");
define('B3P_TESTIMONIAL_ADD_NEW_ITEM', "Add New Testimonial");
define('B3P_TESTIMONIAL_EDIT_ITEM', "Edit Testimonial");
define('B3P_TESTIMONIAL_NEW_ITEM', "New Testimonial");
define('B3P_TESTIMONIAL_VIEW_ITEM', "View Testimonial");

/* Register custom post for Testimonial*/
function B3P_TESTIMONIAL_custom_post_register() {  
    $args = array(  
        'labels' => array (
			'name' => __( B3P_TESTIMONIAL_NAME ),
			'singular_label' => __(B3P_TESTIMONIAL_SINGLE),  
			'add_new_item' => __(B3P_TESTIMONIAL_ADD_NEW_ITEM),
			'edit_item' => __(B3P_TESTIMONIAL_EDIT_ITEM),
			'new_item' => __(B3P_TESTIMONIAL_NEW_ITEM),
			'view_item' => __(B3P_TESTIMONIAL_VIEW_ITEM),
		), 
        'public' => true,  
		'menu_icon' => 'dashicons-image-flip-horizontal',
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor','thumbnail')  
       );  
    register_post_type(B3P_TESTIMONIAL_TYPE , $args );  
}
add_action('init', 'B3P_TESTIMONIAL_custom_post_register');





add_action( 'admin_head', 'b3p_testimonial_icon_set' );
function b3p_testimonial_icon_set() {
    ?>
    <style type="text/css" media="screen">
		#adminmenu .menu-icon-b3p-testimonial div.wp-menu-image:before {
		  content: '\f169';
		  color: #3CBA95;
		}
	</style>
 <?php  } ?>