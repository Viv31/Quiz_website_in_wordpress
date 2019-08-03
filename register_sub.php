
<?php /* Template name:  User Registration  Page */ 
//get_header();
?>
<?php 
if(isset($_POST['insert'])){

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$user_email = $_POST['user_email'];
$user_password = md5($_POST['user_password']);

/*$pass = wp_generate_password( 20, false );
$user_password = md5($pass); */  


/*echo $first_name;
echo"<br>";
echo $last_name;
echo"<br>";
echo $user_email;
echo"<br>";
echo $user_password;
echo"<br>";
die;*/

if(!empty($first_name && $last_name && $user_email && $user_password)){

global $wpdb;
 $sql = "SELECT user_email FROM  user_registration WHERE user_email='".$user_email."'";
$exist_email = $wpdb->get_results($sql);

if($exist_email){

	//wp_redirect('http://localhost/wordpress/cms_wordpress_june_15/');	
	echo  $error =  "<p style='color:#CC0000;'>Email Exist</p>";

}
else{

		$insert_data =$wpdb->insert('user_registration',
	array(
		'first_name'=>$first_name,
		'last_name'=>$last_name,
		'user_email'=>$user_email,
		'user_password'=>$user_password
		));

if(is_wp_error($insert_data)){

	//wp_redirect('http://localhost/wordpress/cms_wordpress_june_15/');	
	$error =  "<p style='color:#CC0000;'>Failed To Register</p>";
	echo $error;

}
else{
	//wp_redirect('http://localhost/wordpress/cms_wordpress_june_15/');	
	$success =  "<p style='color:green;'>Register Successful</p>";
	echo $success ;
			$to = $user_email;
		$subject = 'The subject';
		$body = 'Your Password is=>'.$pass;
		$headers = array('Content-Type: text/html; charset=UTF-8');
 
	$email_status = wp_mail( $to, $subject, $body, $headers );
	if($email_status){

		echo "A mail sent to user";

	}
	else{
		echo "Sending failed";

	}

}

}

}
else{
	$error =  "<p style='color:#CC0000;'>All Fields are Required</p>";
	echo $error;
}

}

 
//get_footer();
?>