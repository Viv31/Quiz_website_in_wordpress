<?php 
if(isset($_SESSION['user_email'])){
	$path = site_url();
	unset($_SESSION['user_email']);
	session_destroy();
	wp_redirect($path);
}
/* 
Above code used if there is no user_email in session it will redirect to login page here $path is used for making dynamic path of this quiz website so wherever you run it will get base path of that website.
*/

?>

<?php 
if(isset($_POST['login'])){

	$user_email = $_POST['user_email'];
	$user_password =md5($_POST['user_password']);

	/*echo $user_email;
	echo $user_password;

	 die;*/

if(!empty($user_email && $user_password)){
	global $wpdb;
 $sql = "SELECT id,user_email,user_password FROM  user_registration WHERE user_email='".$user_email."' and user_password = '".$user_password."'";
$user_login_query = $wpdb->get_results($sql);
//print_r($user_login_query);//die;

/* GET id by indexing from array */
 $user_id = $user_login_query[0]->id;//die;

 /* Another method for fetching id */
/*foreach ($user_login_query as $key => $user_data) {

	//echo $user_data->id;

}*/

if($user_login_query){

	/*Storeing email and id in session*/

	$_SESSION['user_email'] = $user_email;
	 $_SESSION['user_id'] = $user_id;
//die;

$path = site_url();
	wp_redirect($path.'/dashboard/');
	/* if login success it will redirect to dashboard  */	
	//echo  $login_success =  "<p style='color:green;'>Login Success</p>";

}else{
	$error = "<p style='color:red;text-align:center;'>login failed</p>";
}

}
else{
	 $error =  "<p style='color:#CC0000;'>All Fields are Required</p>";
}

}
?>
<?php 
/* Template name: User Login*/
get_header();
?>
<div class="container">

<div class="col-md-3"></div>
<div class="col-md-6">
	<p><?php if(isset($error)){
		echo  $error;
	} ?></p>
<div class="jumbotron">
		
			
				<h4>User login</h4>
				<form action="" method="POST">
					<div class="form-group">
					<label>Username:</label>
					<input type="text" name="user_email" placeholder="Uername" class="form-control">
					</div>
					<div class="form-group">
					<label>Password:</label>
					<input type="password" name="user_password" placeholder="Password" class="form-control">
					</div>
					<input type="submit" name="login" value="Login">
				</form>
				<button data-toggle="modal" data-target="#myModal" class="pull-right">Register Here</button>
				<a href="<?php echo site_url();?>/lost-password">Lost Password</a>
			
		</div>
		</div>
<div class="col-md-3"></div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Registration Form</h4>
      </div>
      <div class="modal-body">
      	<form action="<?php echo site_url();?>/user-registration"  method = "POST" 
      		onsubmit="return registrationFormValidation();">
      		<div class="form-group">
      			<label>First Name:</label>
      			<input type="text" name="first_name" class="form-control" placeholder="Enter Name" id="first_name">
      				<div class="popup_error" id="first_name_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Last Name:</label>
      			<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" id="last_name">
      			<div class="popup_error" id="last_name_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Email:</label>
      			<input type="email" name="user_email" class="form-control" placeholder = "Enter Email" id="insert_email">
      			<div class="popup_error" id="email_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Password:</label>
      			<input type="password" name="user_password" class="form-control" placeholder="Enter password">
      		</div>
      		<div class="form-group">
      			<center><input type="submit" name="insert" value="Register"></center>
      		</div>
      	</form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>	
</div>
<?php get_footer(); ?>
<script type="text/javascript">
/*
validation for registration form on client side

*/

	function registrationFormValidation(){

		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var insert_email = $('#insert_email').val();
		//alert(insert_email);

		if(first_name==""){
			$('#first_name_error_msg').show();
			$('#first_name_error_msg').css('color','#CC0000');
			$('#first_name_error_msg').html('Please Enter First Name');
			$('#first_name').focus();
  			$('#first_name').addClass('error');
  			setTimeout("$('#first_name_error_msg').fadeOut(); ", 3000);
return false;

		}

		if(last_name== ""){
			$('#last_name_error_msg').show();
			$('#last_name_error_msg').css('color','#CC0000');
			$('#last_name_error_msg').html('Please Enter Last Name');
			$('#last_name').focus();
			$('#last_name').addClass('error');
			setTimeout("$('#last_name_error_msg').fadeOut();",3000);
			return false;

		}

		if(insert_email== ""){
			$('#email_error_msg').show();
			$('#email_error_msg').css('color','#CC0000');
			$('#email_error_msg').html('Please Enter Email');
			$('#insert_email').focus();
			$('#insert_email').addClass('error');
			setTimeout("$('#email_error_msg').fadeOut();",3000);
			return false;

		}

	}
</script>