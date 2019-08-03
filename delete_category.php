<?php 
/* Template name: Delete Catgory   */
//get_header();

$category_id = $_GET['category_id'];
//echo $category_id;
$table ='category';

$delte_category = $wpdb->delete($table,array('id'=>$category_id));
if(is_wp_error($delte_category)){
	$_SESSION['failed_delete']='<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Failed to Delete.</div>';
	//echo "Failed to Delete ";
	$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
}
else{
	echo "Deleted Successfully";
	$_SESSION['delete_success']='<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Category Deleted Successfully.</div>';
	$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
}

?>