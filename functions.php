<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
}

function dmeng_get_https_avatar($avatar) {
	//~ 替换为 https 的域名
	$avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com", "secure.gravatar.com"), "gravatar.yipai.me", $avatar);
	//~ 替换为 https 协议
	$avatar = str_replace("http://", "https://", $avatar);
	return $avatar;
}
add_filter('get_avatar', 'dmeng_get_https_avatar');

add_filter( 'comment_excerpt_length', function($length) {
    return 50;
}, PHP_INT_MAX );

function mytheme_custom_excerpt_length( $length ) {
    return 140;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );