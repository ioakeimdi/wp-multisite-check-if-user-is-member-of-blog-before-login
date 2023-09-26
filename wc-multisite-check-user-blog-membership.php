<?php
// Check if a user from multisite belongs to this site to login

add_filter('woocommerce_process_login_errors', 'wc_check_user_blog_membership', 20, 3);
function wc_check_user_blog_membership($validation_error, $username, $password) {

	if(is_email($username)){
		$user = get_user_by('email', $username);
	}else{
		$user = get_user_by('login', $username);
	}
	
	if($user && !is_user_member_of_blog($user->ID, get_current_blog_id())){
		$validation_error->add('authentication_failed', __('You are not a member of this website', 'woocommerce'));
	}

	return $validation_error;
	
}
