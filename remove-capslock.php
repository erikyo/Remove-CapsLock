<?php
/*
Plugin Name: Remove CapsLock
Description: Remove uppercase text from title content and comments.
Author: Erik
Version: 0.0.1
Author URI: https://codekraft.it/
*/

/**
 * if the first X characters are uppercase it returns the normalised text
 *
 * @param $string string - the string to parse
 * @param $precision - the number of chars to check
 *
 * @return string - the clean text
 */
function rcl_denoise( $string, $precision = 10 ) {
    return preg_replace_callback( '/([A-Z\ ,-]{' . $precision . ',})/',
        function ( $m ) { return ucfirst( strtolower( $m[1] ) ); },
        $string
    );
}

// Return the title into a clean format
add_filter( 'the_title', function ( $content ) {
    $text_precision = apply_filters( 'rcl_title_precision', 6 );

    return rcl_denoise( $content, $text_precision );
} );

// Returning comments in a way that ensures a democratic conversation
add_filter( 'comment_text', function ( $content ) {
    $text_precision = apply_filters( 'rcl_comment_precision', 5 );

    return rcl_denoise( $content, $text_precision );
} );

// Return the content into human readable format
add_filter( 'the_content', function ( $content ) {
    $text_precision = apply_filters( 'rcl_text_precision', 10 );

    return is_main_query() ? rcl_denoise( $content, $text_precision ) : $content;
} );

?>