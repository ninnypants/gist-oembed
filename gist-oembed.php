<?php
/*
Plugin Name: Gist oEmbed
Plugin URI: http://ninnypants.com/plugins/
Description: Embed gists into posts
Version: 1.0
Author: ninnypants
Author URI: http://ninnypants.com
License: GPL2

Copyright 2013  Tyrel Kelsey  (email : tyrel@ninnypants.com)

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

class Gists_oEmbed {
	public function __construct(){
		add_action( 'init', array( $this, 'setup_handler' ) );
	}

	public function gist_result( $url ){
		$url = $url[0];
		if( !preg_match( '#\.js$#i', $url ) )
			$url .= '.js';
		return '<script src="' . $url . '"></script>';
	}

	public function setup_handler(){
		wp_embed_register_handler( 'gist', '#https?://gist.github.com/.*#i', array( $this, 'gist_result' ) );
	}
}

$gists_oembed = new Gists_oEmbed();