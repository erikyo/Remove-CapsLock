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
    return preg_replace_callback( '/([A-Z\ ,-]{' . intval($precision) . ',})/',
        function ( $m ) { return ucfirst( strtolower( $m[1] ) ); },
        $string
    );
}

$rcl_available_filters = apply_filters( 'rcl_available_filters' , array(
    array('the_title','rcl_title_precision', 6), // Return the title into a clean format
    array('widget_title','rcl_title_precision', 6), // Return the widget normalized title
    array('comment_text','rcl_comment_precision', 5), // Returning comments in a way that ensures a democratic conversation
) );

foreach ( $rcl_available_filters as $filter ) {

    // get the needed precision for uppercase replace regex (-1 means no replace)
    $text_precision = intval( apply_filters( $filter[0], intval($filter[2]) ) );
    if ($text_precision < 0) return;

    // add the filter with the chosen options
    add_filter( $filter[0], function ( $content ) use ( $filter ) {
        return rcl_denoise( $content, $filter[2] );
    } );
}

// Return the content into human readable format
add_filter( 'the_content', function ( $content ) {
    $text_precision = intval(apply_filters( 'rcl_text_precision', 10 ));
    if ($text_precision < 0) return $content;

    return is_main_query() ? rcl_denoise( $content, $text_precision ) : $content;
} );

?>