<?php
/* Plugin Name: wiki
Plugin URI: http://miapple.ca/cn
Description: Wiki is a complete Wiki Management plugin for WordPress. It provides a Wiki custom post type With category taxonomy which can be used to effortlessly add Wiki sections to your website. It's easy to install the plugin and adding new questions and categories. After adding questions you can show the wiki items in your "Post", "Page", or in "Widget" of your website using shortcode.
Version: 1.1
Author: Alice Ding
Author URI: http://cn.aliceding.com
License: NPL
*/

define( 'WIKI_URL', plugin_dir_url(__FILE__) );
define( 'WIKI_PATH', plugin_dir_path(__FILE__) );

require_once( WIKI_PATH . 'wiki.posttype.php' );
require_once( WIKI_PATH . 'settings.php' );

function wiki_scripts() {
    if (!is_admin()) {
	
	wp_enqueue_script('jquery');
	
	if(get_option('ff_action') == 'toggle'){
		wp_enqueue_script('utility', plugins_url('/js/toggle.js', __FILE__));
	}else{
		wp_enqueue_script('utility', plugins_url('/js/accordion.js', __FILE__));
	}

	wp_enqueue_style ('wiki_style', plugins_url('/css/style.css', __FILE__));
	}
}
add_action('init', 'wiki_scripts', 0);

add_shortcode("wiki", "wiki_display_wiki");

function wiki_display_wiki($attr, $content) {

    extract(shortcode_atts(array(
                'category' => '',
                'item' => -1,
                'order' => 'ASC'
                    ), $attr));
					
    $plugins_url = plugins_url();

 	$html .= '<div class="sample"><dl class="wikis">';
	
	$tmp = $wp_query;
	$wp_query = new WP_Query('post_type=wiki&orderby=menu_order&posts_per_page=' . $item . '&order=' . $order . '&wiki_cat='.$category);
	if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
	
	$question = get_the_title();
	$answer = get_the_content();

	$html .= '<dt><a href="#nofollow">';
	$html .= $question;
	$html .= '</a></dt><dd>';
	$html .= $answer;
	$html .= '</dd>';

	endwhile;
	wp_reset_query();
	endif;
	
	$html .= '</dl></div>';
	
	$wp_query = $tmp;
	
	if(get_option('ff_showicon') == 'css'){
		$html .= "<style>
					.wikis dt{font-weight:bold;background:transparent;padding:3px 0 15px 30px;position:relative;}
					.wikis dt:after{content:'Q';position:absolute;left:0;top:4px;width:25px;height:25px; background: " . get_option('ff_pbgcolor') . ";color:#fff; font-weight:bold; text-align:center;border-radius:3px;}

					.wikis dd{background:transparent;margin-bottom: 20px;padding:0 0 10px 30px;position:relative;}
					.wikis dd:after{content:'A';position:absolute;left:0;top:4px;width:25px;height:25px; background: " . get_option('ff_abgcolor') . ";color:#fff; font-weight:bold; text-align:center;border-radius:3px;}
				</style>";
				
	}else if(get_option('ff_showicon') == 'image'){
		$html .= "<style>
					.wikis dt{font-weight:bold;background:url(" . WIKI_URL . "/images/q.gif) 0 4px no-repeat;padding:3px 0 15px 30px;position:relative;}
					.wikis dd{background:url(" . WIKI_URL . "/images/a.gif) 0 2px no-repeat;margin-bottom: 20px;padding:0 0 10px 30px;position:relative;}
				</style>";
	
	
	}else{
		$html .= "<style>
					.wikis dt{font-weight:bold;background:transparent;}
					.wikis dd{background:transparent;margin-bottom: 20px;padding:0 0 10px 0px;position:relative;}
				</style>";
	}
	
    return $html;
}
?>