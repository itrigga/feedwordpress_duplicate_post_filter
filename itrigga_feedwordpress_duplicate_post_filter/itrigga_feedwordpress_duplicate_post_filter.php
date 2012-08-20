<?php
/*
Plugin Name: iTrigga FeedWordPress Duplicate Post Filter
Plugin URI: http://www.itrigga.com/
Description: Checks DB to see if any previous posts have the same title AND (post_date_gmt or guid). If it does, it skip that post.
Author: Al Davidson, based on FeedWordPress Duplicate Post Filter by Mark Allen
Version: 1.0
*/

/* 

Original copyright notice:

Copyright (C) 2008, 2009 by Mark R. Allen
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted 
provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of 
      conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list 
      of conditions and the following disclaimer in the documentation and/or other 
      materials provided with the distribution.
    * Neither the name of Mark Allen nor the names of any contributors may be used to 
      endorse or promote products derived from this software without specific prior written 
      permission.

*/

function itfwpdpf_debug( $msg, $data=NULL, $handle=NULL )
{
	$line = "itfwpdpf - " . sprintf( $msg, $data );
	if($handle){
		fprintf( $handle, "\n".$line );
	} 
	echo( $line );
	
	
}

function itfwpdpf_check_duplicate ( $post ) 
{
    global $wpdb;


    $handle;
    $debug = 1;

    if ( $debug ) 
    {
        $wpdb->show_errors();

        $handle = fopen("itrigga_feedwordpress_duplicate_post_filter.log", "a+"); 

		//itfwpdpf_debug( "post = \n%s", print_r( $post, true ), $handle );
    }

    $sql = $wpdb->prepare( "
            SELECT ID FROM $wpdb->posts
            WHERE 
            (post_title = '%s' OR post_title = '%s')
			AND 
            ( guid = '%s' OR post_date_gmt like '%s' )
			",
            esc_html($post['post_title']),
            $post['post_title'],
			$post['guid'],
			$post['post_date_gmt']
        );     

    if ( $debug )
    {
        itfwpdpf_debug( "checking for existing post with sql %s", $sql, $handle );
    }

    $wpdb->query( $sql );

	if ( $debug )
	{
		itfwpdpf_debug( "query returned %d rows", $wpdb->num_rows, $handle);
	}

    if($wpdb->num_rows) //Already posted; discard
    {
        if ( $debug ) 
        {
            itfwpdpf_debug("...skipping this post.");
            fclose($handle);
        }
        return NULL;
    }

    // Otherwise continue to process.

    if ( $debug || $handle)
    {
        fclose($handle);
    }

    return $post;
}

add_action('syndicated_post', 'itfwpdpf_check_duplicate');
?>
