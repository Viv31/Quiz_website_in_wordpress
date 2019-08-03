<?php 
if(isset($_SESSION['user_email'])){
	$path = site_url();
	unset($_SESSION['user_email']);
	session_destroy();
	wp_redirect($path);
}

?>
<?php /* Template name: Logout Page  */
//get_header();
?>
