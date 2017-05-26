<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('setMenuIemActive'))
{
	/**
	 * Sets the menu item active.
	 *
	 * @return     string  add a class to the item
	 */
	function setMenuItemActive($flag=false){
		if ($flag) {
			return 'class="active"';
		}
		return "";
	}
}
?>