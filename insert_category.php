<?php 
/* Template name:Insert New Category */

if(isset($_POST['insert_new_category'])){
	//echo "insert click";
	$insert_category_name = strtoupper($_POST['category_name']);
	//echo $insert_category_name; 
	if(empty($insert_category_name)){
		$_SESSION['error'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> All fields are required.</div>';
	$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
		
	}
	else{
		global $wpdb;
 $check_exist_category = "SELECT category_name FROM  category WHERE category_name='".$insert_category_name."'";
$exist_category = $wpdb->get_results($check_exist_category);
//print_r($exist_category);

if($exist_category){
	$_SESSION['error'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> This Category Already exist.</div>';
	$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

}
else{
	//echo "Not exist";
	$insert_category_query =$wpdb->insert('category',
			array('category_name'=>$insert_category_name));
		if(is_wp_error($insert_category_query)){

		$_SESSION['error'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Failed to insert category.</div>';
		}
		else{
			$_SESSION['success'] = '<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Category inserted successfully.</div>';
			$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
		}

}


 //die;
	
	}
	
}



?>