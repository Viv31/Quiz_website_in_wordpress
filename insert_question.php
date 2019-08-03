<?php
session_start();
/* Template name: Insert New Question  */

if(isset($_POST['insert_new_question'])){
//echo "Question";

$question = ucfirst($_POST['question']);
$ans1 = $_POST['ans1']; 
$ans2 = $_POST['ans2']; 
$ans3 = $_POST['ans3']; 
$ans4 = $_POST['ans4']; 
$ans = $_POST['ans']; 
$category_id = $_POST['category_id']; 

if(empty($question) && empty($ans1) && empty($ans2) && empty($ans3) && empty($ans4) && empty($ans) &&empty($category_id)){

	$_SESSION['error_question'] = "All fields are required";
	$admin_url = admin_url();
		wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

}
else{

	global $wpdb;

	$check_exist_question = "SELECT question FROM questions WHERE question = '".$question."'";
	$exist_question = $wpdb->get_results($check_exist_question);
	//print_r($exist_question); die;
	if($exist_question){

		$_SESSION['error_question'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> This Question Already exist.</div>';
		$admin_url = admin_url();
		wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

	}
	else{
			

	$insert_Questions = $wpdb->insert('questions',
		array(
			'question'=>$question,
			'ans1'=>$ans1,
			'ans2'=>$ans2,
			'ans3'=>$ans3,
			'ans4'=>$ans4,
			'ans'=>$ans,
			'category_id'=>$category_id,
			'no_answer'=>'no_answer'
	)
	);
	if(is_wp_error($insert_Questions)){
		$_SESSION['error_question'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Failed to insert Question.</div>';
		$admin_url = admin_url();
		wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

	}
	else{
		 $_SESSION['success_qusetion'] =  '<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Question inserted Succesfully.</div>';
		$admin_url = admin_url();
		wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
	}
}

}
}

?>