<?php
/*
Plugin Name: Social Numbers
Plugin URI: http://www.filipjohansson.se/social-numbers
Description: This plugin adds a new template tag to show how many times a page or post has been liked and shared to Facebook or mentioned in tweets on Twitter.
Version: 0.1
Author: Filip Johansson
Author URI: http://www.filipjohansson.se
License: GPL2


	Copyright 2012

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function the_social_number( $network ) {
	echo get_the_social_number( $network );
}

function get_the_social_number( $network ) {
	global $post;
	if ( !$post->ID )
		return;
	else
		return get_social_number( $network, $post->ID );
}

function social_number( $network, $id ) {
	echo get_social_number( $network, $id );
}

function get_social_number( $network, $id ) {
	$url = get_permalink( $id );
	switch ( $network ) {
		case 'facebook':
			if ( function_exists( 'curl_init' ) ) { 
    			$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, 'http://graph.facebook.com/?ids=' . $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
				$file_contents = curl_exec( $ch );
				$json = json_decode( $file_contents, true );
				curl_close( $ch ); 
    		} else {
				$json_string = file_get_contents( 'http://graph.facebook.com/?ids=' . $url );
    			$json = json_decode( $json_string, true );
			}
			
			return (isset($json[$url]['shares']) ? intval( $json[$url]['shares'] ) : 0);
			break;
		case 'twitter':
			if ( function_exists( 'curl_init' ) ) { 
    			$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, 'http://urls.api.twitter.com/1/urls/count.json?url=' . $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
				$file_contents = curl_exec( $ch );
				$json = json_decode( $file_contents, true );
				curl_close( $ch ); 
    		} else {
				$json_string = file_get_contents( 'http://urls.api.twitter.com/1/urls/count.json?url=' . $url );
    			$json = json_decode( $json_string, true );
			}
			
    		
    		return ( isset( $json['count'] ) ? intval( $json['count'] ) : 0 );
			break;
	}
}
?>