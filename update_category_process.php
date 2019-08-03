<?php 
/* Template name: Update Category Process  */

$category_id = $_POST['category_id'];
 //echo $category_id;
 $category_name = strtoupper($_POST['category_name']);

 if(empty($category_name)){
 	$_SESSION['error'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> All fields are required.</div>';
	$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

 }
 else{
global $wpdb;
$chk_exist_category_for_update = "SELECT category_name FROM  category WHERE category_name='".$category_name."'";
$exist_category_update = $wpdb->get_results($chk_exist_category_for_update);

//print_r($exist_category_update); 
if($exist_category_update){
	$_SESSION['error'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> This Category Already exist.</div>';
	
	$admin_url = admin_url();
				 wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

}
else{
	$update_category = $wpdb->update('category',
  				array('id'=>$category_id,
  					'category_name'=>$category_name

  			),array('id'=>$category_id));

  				if(is_wp_error($update_category)){
		echo '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Category failed to Update.</div>';
$admin_url = admin_url();
				 wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
				}
				else{
					//echo"Category Updated successfully";
					$_SESSION['success']='<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Category updated Succesfully.</div>';
				 $admin_url = admin_url();
				 wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
				}

}
}
 ?>

 