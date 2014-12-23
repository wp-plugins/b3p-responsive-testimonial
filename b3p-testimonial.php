<?php
/*
Plugin Name: B3P Testimonial
Plugin URI: 
Description: This is testimonial slider and show all testimonial plugin.
Author: Brother three power
Author URI: http://www.fiverr.com/shafayat
Version: 1.1
*/


/*Some Set-up*/
define('B3P_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


	if (!is_admin() ){
function b3p_default_wp_jquery() {
	wp_register_script('b3p_flexslider_js',B3P_PLUGIN_PATH. 'js/jquery.flexslider-min.js', true);
	wp_register_script('b3p_main_js',B3P_PLUGIN_PATH. 'js/main.js',true);
	wp_register_script('b3p_modernizr_js',B3P_PLUGIN_PATH. 'js/modernizr.js',true);

	
	wp_enqueue_script('jquery');
	wp_enqueue_script('masonry');
	wp_enqueue_script( 'b3p_flexslider_js', false, false, true);
	wp_enqueue_script( 'b3p_main_js', false, false, true);
	wp_enqueue_script( 'b3p_modernizr_js', false, false, true);

}
	}
add_action( 'wp_enqueue_scripts', 'b3p_default_wp_jquery' );


// ------- wp enqueue style  ------ 

function b3p_testimonial_stylesheet() { 
	if ( !is_admin() ){

		wp_register_style( 'b3p_reset_css', B3P_PLUGIN_PATH. 'css/reset.css', array(), '1', 'all' );
		wp_register_style( 'b3p_main_css', B3P_PLUGIN_PATH. 'css/style.css', array(), '1', 'all' );

		wp_enqueue_style( 'b3p_reset_css' );
		wp_enqueue_style( 'b3p_main_css' );
	}
}
add_action( 'wp_enqueue_scripts', 'b3p_testimonial_stylesheet' );


 /*	add post thamb nail 	*/
add_theme_support( 'post-thumbnails');


/*Files to Include*/
require_once('testmonial_type.php');

/*------TINIMY MCE BUTTON ADD START ------*/

function wptuts_buttons() {
    add_filter( "mce_external_plugins", "wptuts_add_buttons" );
    add_filter( 'mce_buttons', 'wptuts_register_buttons' );
}
function wptuts_add_buttons( $plugin_array ) {
    $plugin_array['wptuts'] = plugins_url('js/b3p_testimonial_btn.js', __FILE__);
    return $plugin_array;
}
function wptuts_register_buttons( $buttons ) {
    array_push( $buttons, 'b3ptestimonial' );
    return $buttons;
}
add_action( 'init', 'wptuts_buttons' );
/*------TINIMY MCE BUTTON ADD END ------*/

/*-----shortcode -------*/

function b3p_testimonal_section_shortcode($atts , $content = null){
	extract(shortcode_atts(array(
	),$atts
	));
	return '

		'.do_shortcode('[b3p_testimonial_slider]').'

	';
		}  
	add_shortcode('b3p_testiminial','b3p_testimonal_section_shortcode');

	/*----- -------*/
	
function b3p_testimonial_slider_shortcode($atts , $content = null){
	extract(shortcode_atts(array(
	'title'=>'',
	),$atts
	));
	$q = new WP_Query(
		array('posts_per_page'=>-1, 'post_type'=>'B3P-testimonial')
		);
		
		$list = '
<div class="cd-testimonials-wrapper cd-container">
	<ul class="cd-testimonials">';

		while ($q->have_posts()) : $q->the_post();
			global $post;
			$b3p_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
				$list.='

				<li>
					<p >'.get_the_content().'</p>
					<div class="cd-author">'.get_the_post_thumbnail( $post->ID ).'
						<ul class="cd-author-info">
							<li>'.get_the_title().'</li>
						</ul>
					</div>
				</li>

				';
				
		endwhile;
		$list.='		
	</ul> 

</div> <!-- cd-testimonials-wrapper -->';
		
		wp_reset_query();
		
	return $list;
		}  
	add_shortcode('b3p_testimonial_slider','b3p_testimonial_slider_shortcode');	
	
