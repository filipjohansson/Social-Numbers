=== Social Numbers ===
Contributors: filipjohansson
Donate link: http://www.filipjohansson.se
Tags: social media, facebook, twitter, template tag
Requires at least: 3.3.1
Tested up to: 3.3.1

This plugin adds a new template tag to show how many times a page or post has been liked and shared to Facebook or mentioned in tweets on Twitter.

== Description ==

This plugin adds a new template tag to show how many times a page or post has been liked and shared to Facebook or mentioned in tweets on Twitter.

== Installation ==

This is how you install and use the plugin.

1. Upload the folder `social-numbers` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

This gives you two new template tags to use in your Wordpress theme.

This function to use inside the loop to get the shares of the current post.
`<?php the_social_number( $network ); ?>`
The parameter $network is a string and can take two values: facebook, twitter.

Example that writes out the number of tweets mentioning the url of the current post:
`<?php the_social_number( 'twitter' ); ?>`

If you don't want to echo the result you can use the function with the get_ prefix.
`<?php get_the_social_number( $network ); ?>`


This other function returns the number of shares to a specific post.
`<?php social_number( $network, $id ); ?>`
The parameter $network is a string and can take two values: facebook, twitter.
The second parameter $id is an int.

If you don't want to echo the result you can use the function with the get_ prefix.
`<?php get_social_number( $network, $id ); ?>`


== Changelog ==

= 0.1 =
* Initial release. Supporting Facebook and Twitter.