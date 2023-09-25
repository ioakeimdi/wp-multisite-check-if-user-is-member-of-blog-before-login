<?php
// Check if a user from multisite belongs to this site to login

add_filter('authenticate', 'wp_check_user_blog_membership', 20, 3);
function wp_check_user_blog_membership($user, $username, $password){

	if($user && !is_user_member_of_blog($user->ID, get_current_blog_id())){

		$user = new WP_Error('authentication_failed', __('You are not a member of this website', 'woocommerce'));

	}
	
	return $user;
}
