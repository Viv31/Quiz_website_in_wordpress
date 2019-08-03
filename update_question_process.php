<?php  
/* Template name: Update Question Process */

$question_id = $_POST['quest_id'];
//echo $question_id;

if(isset($_POST['update_questions'])){
	$question = ucfirst($_POST['question']);
	$ans1 = $_POST['ans1'];
	$ans2 = $_POST['ans2'];
	$ans3 = $_POST['ans3'];
	$ans4 = $_POST['ans4'];
	$ans = $_POST['ans'];
	$category_name = $_POST['category_name'];

	/*echo $question."<br>";
	echo $ans1."<br>";
	echo $ans2."<br>";
	echo $ans3."<br>";
	echo $ans4."<br>";
	echo $ans."<br>";
	echo $category_name;*/
	if(empty($question) && empty($ans1) && empty($ans2) && empty($ans3) && empty($ans4) && empty($ans)){
		$_SESSION['error_question'] = "All fields are required";
		$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
	}
	else{

		global $wpdb;

		$check_exist_question_for_update ="SELECT question FROM questions WHERE question = '".$question."'";
		$exist_question_update = $wpdb->get_results($check_exist_question_for_update);
		if($exist_question_update){
			
			$_SESSION['error_question'] = '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> This Question Already exist.</div>';
			$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

		}
		else{
			//echo "not exist"; die;
		


		$update_questions_data = $wpdb->update('questions',
			array(
				'id'=>$question_id,
				'question'=>$question,
				'ans1'=>$ans1,
				'ans2'=>$ans2,
				'ans3'=>$ans3,
				'ans4'=>$ans4,
				'ans'=>$ans



			),array('id'=>$question_id));
		if(is_wp_error($update_questions_data)){

			

			$_SESSION['error_question'] =  '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong>Failed to Update .</div>';

			$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');

		}
		else{

			
			$_SESSION['success_qusetion'] = '<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Question updated Successfully.
</div>';
			$admin_url = admin_url();
			wp_redirect($admin_url.'/admin.php?page=manage_quiz_que_and_ans');
			//echo "Question Updated Successfully";
		}
	}

}
}
?>