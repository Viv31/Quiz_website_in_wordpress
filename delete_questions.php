<?php 
/*Template name: Delete Questions */
$question_id = $_GET['question_id'];

$table ='questions';

$delete_questions = $wpdb->delete($table ,array('id'=>$question_id)); 

if(is_wp_error($delete_questions)){
	$_SESSION['error_del_question']='<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Failed to Delete.</div>';
$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

}
else{
	$_SESSION['question_del_success']='<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Question Deleted Successfully.</div>';
$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
}


?>