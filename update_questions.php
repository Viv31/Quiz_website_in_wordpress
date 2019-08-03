<?php
/* Template name:Update Questions Page  */

$question_id = $_GET['question_id'];
//echo $question_id;

$select_questions_for_update ="SELECT * FROM questions WHERE id ='".$question_id."'";
$question_data = $wpdb->get_results($select_questions_for_update);
foreach ($question_data as $key => $Question) {
	# code...
	$category_Id = $Question->category_id;
}

?>
<div class="container">
	<div class="'row">
	<form action="<?php echo site_url();?>/update-question-process-page" method="POST">
		<div class="form-group">
			<label>Category:</label>
			<select name="category_name" class="form-control">
				
				<?php global $wpdb;
	$select_all_category_data ="SELECT * FROM category WHERE id='".$category_Id."'";
	$all_category_list = $wpdb->get_results($select_all_category_data); 
	//print_r($userlist);
	foreach ($all_category_list as $key => $all_category_data) { 
		?>
				<option><?php echo $all_category_data->category_name; ?></option>
			</select>
		</div>
		<div class="form-group">
			<label>Question:</label>
			<input type="text" name="question" value="<?php echo $Question->question; ?>" placeholder="" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Option1:</label>
			<input type="text" name="ans1" value="<?php echo $Question->ans1; ?>" placeholder="" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Option2:</label>
			<input type="text" name="ans2" value="<?php echo $Question->ans2; ?>" placeholder="" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Option3:</label>
			<input type="text" name="ans3" value="<?php echo $Question->ans3; ?>" placeholder="" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Option4:</label>
			<input type="text" name="ans4" value="<?php echo $Question->ans4; ?>" placeholder="" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Right Answer:</label>
			<input type="text" name="ans" value="<?php echo $Question->ans; ?>" placeholder="" class="form-control" required>
		</div>
		<input type="hidden" name="quest_id" value="<?php echo $Question->id; ?>">
		<input type="submit" name="update_questions" class="btn btn-primary" value="Update">
	</form>
	<a class="btn btn-primary" onClick="javascript:history.go(-1);">Back</a>
</div>
</div>
<?php } ?> 
<?php get_header(); ?>