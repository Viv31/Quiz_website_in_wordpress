<?php 
session_start();
/* This will show a option Manage Quiz on admin side bar  */

add_action('admin_menu','admin_options_for_users_and_questions');

function admin_options_for_users_and_questions(){
	/* Here Manage Quiz will be visible in our admin sidebar and manage_quiz_que_and_ans is our slug  and change_quiz_setting is callback function */

  add_menu_page('Manage Quiz', 'Manage Quiz', 'manage_options', 'manage_quiz_que_and_ans', 'change_quiz_setting' );

/* For Editing user data */

  add_menu_page('Edit Questions ', 'Edit Questions', 'manage_options', 'edit_quiz_questions_msg', 'edit_quiz_setting' );
    remove_menu_page('edit_quiz_questions_msg');
}

/* CallBack Function */

function change_quiz_setting(){
	?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style type="text/css">
	/* making td and th in center */
	td,th{
		text-align: center;
	}
	.container{
		margin-top: 30px;
	}
</style>
<!--Container Starts here-->
<div class="container">
	
	<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#all_user_list">All User</a></li>
  <li><a data-toggle="pill" href="#quiz_categories">Categories</a></li>
  <li><a data-toggle="pill" href="#quiz_questions">Questions</a></li>
  <li><a data-toggle="pill" href="#quiz_user_result">Result</a></li>
</ul>
<!--All user list Tab starts here-->
<div class="tab-content">
  <div id="all_user_list" class="tab-pane fade in active">
  	<!-- All user tab initially loads  -->
    <h3>All User List</h3>
    <table class="table table-bordered">
	<thead>
		<tr>
			<th>
				Sno
				<?php  $no=1;?>
			</th>
			<th>
				First Name
			</th>
			
			<th>
				Last Name
			</th>
			
			<th>
				Email
			</th>
			<th>
				Action
			</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
    global $wpdb;
	$select_all_user ="SELECT * FROM user_registration";
	$userlist = $wpdb->get_results($select_all_user); 
	//print_r($userlist);
	foreach ($userlist as $key => $data) { 

		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data->first_name; ?></td>
			<td><?php echo $data->last_name; ?></td>
			<td><?php echo $data->user_email; ?></td>
			<td><a href=""><button class="btn btn-danger">Delete</button></a></td>
	</tr>		
		
		<?php
	}
	

	?>
</tbody>
</table>		
    
  </div>
  <!-- All user tab ends here  -->
  <!-- Categories tab starts here -->
  <div id="quiz_categories" class="tab-pane fade">
    <h3>Categories</h3>
    <div><?php if(isset($_SESSION['success'])){
    	echo $_SESSION['success'];
    } 

    unset($_SESSION['success']); 
    if(isset($_SESSION['error'])){
    	echo $_SESSION['error'];

    }
    unset($_SESSION['error']);

    if(isset($_SESSION['failed_delete'])){
    	echo $_SESSION['failed_delete'];
    }
    unset($_SESSION['failed_delete']);

    if(isset($_SESSION['delete_success'])){
    	echo $_SESSION['delete_success'];
    }
    unset($_SESSION['delete_success']);
    ?></div>
    <!--Model call button for adding category -->
   <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_new_category">Add Category</button>
   <br>
    <table class="table table-bordered">
	<thead>
		<tr>
			<th>
				Sno
				<?php  $no=1;?>
			</th>
			<th>
				Category Name
			</th>
			
			
			<th colspan="2">
				Action
			</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
    global $wpdb;
	$select_all_category ="SELECT * FROM category";
	$categorylist = $wpdb->get_results($select_all_category); 
	//print_r($userlist);
	foreach ($categorylist as $key => $data_category) { 
		//echo $data_category->id;

		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data_category->category_name; ?></td>
			

			<td><a href="<?php echo  site_url();?>/update-category?category_id=<?php echo $data_category->id; ?>"><button class="btn btn-primary">Update</button></a></td>
			<td><a href="<?php echo site_url();?>/delete-category?category_id=<?php echo $data_category->id; ?>"><button class="btn btn-danger">Delete</button></a></td>
	</tr>		
		
		<?php
	}
	

	?>
</tbody>
</table>		
  </div><!-- Categories tab ends here -->
  <!--Model Starts for adding categories-->

  <div id="add_new_category" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Add Category Form</h4>
      </div>
      <div class="modal-body">
      	<form action="<?php echo site_url();?>/insert-category" method="POST">
      		<div class="form-group">
      			<label>Category Name:</label>
      			<input type="text" name="category_name" class="form-control" placeholder="Enter category name" required>

      		</div>
      		<button type="submit" name="insert_new_category" class="btn btn-primary">Insert</button>
      	</form>
      </div>
  </div>
</div>
</div>
<!-- Model Ends here -->


<!-- Tab starts for Questions -->
  <div id="quiz_questions" class="tab-pane fade">
    <h3>Questions</h3>
    <div><?php if(isset($_SESSION['success_qusetion'])){
    	echo $_SESSION['success_qusetion'];
    } 

    unset($_SESSION['success_qusetion']);

    if(isset($_SESSION['error_question'])){
    	echo $_SESSION['error_question'];

    }
    unset($_SESSION['error_question']);

    if(isset($_SESSION['error_del_question'])){
    	echo $_SESSION['error_del_question'];
    }
    unset($_SESSION['error_del_question']);

    if(isset($_SESSION['question_del_success'])){
    	echo $_SESSION['question_del_success'];
    }
    unset($_SESSION['question_del_success']);

    ?></div>
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_new_questions">Add Question</button>
    <table class="table table-bordered">
	<thead>
		<tr>
			<th>
				Sno
				<?php  $no=1;?>
			</th>
			<th>
				Question
			</th>
			<th>
				Answer1
			</th>
			<th>
				Answer2
			</th>
			<th>
				Answer3
			</th>
			<th>
				Answer4
			</th>
			<th>
				Right Answer
			</th>
			<th>
				Category
			</th>
			
			<th colspan="2">
				Action
			</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
    global $wpdb;
	$select_all_questions ="SELECT * FROM questions";
	$questionslist = $wpdb->get_results($select_all_questions); 
	//print_r($userlist);
	foreach ($questionslist as $key => $data_questions) { 
		 $que_id = $data_questions->id;
			//echo $que_id;
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data_questions->question; ?></td>
			<td><?php echo $data_questions->ans1; ?></td>
			<td><?php echo $data_questions->ans2; ?></td>
			<td><?php echo $data_questions->ans3; ?></td>
			<td><?php echo $data_questions->ans4; ?></td>
			<td><?php echo $data_questions->ans; ?></td>
			<td> <?php 
    global $wpdb;
	$select_all_category ="SELECT * FROM category WHERE id='".$data_category->id."'";
	$categorylist = $wpdb->get_results($select_all_category); 
	//print_r($userlist);
	foreach ($categorylist as $key => $data_category) { 

		//echo $data_category->category_name;

	}


		?>
</td>
			<td><a href="<?php echo site_url();?>/update-questions-page?question_id=<?php echo $que_id; ?>"><button class="btn btn-primary">Update</button></a></td>
			<td><a href="<?php echo site_url();?>/delete-question?question_id=<?php echo $que_id; ?>"><button class="btn btn-danger">Delete</button></a></td>

	</tr>		
		
		<?php
	}
	

	?>
</tbody>
</table>		
  </div><!-- Tab Ends for Questions -->

<!--Model Starts for adding Questions-->

  <div id="add_new_questions" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Add Questions Form</h4>
      </div>
      <div class="modal-body">
      	<form action="<?php echo site_url();?>/insert-new-question" method="POST">
      		<div class="form-group">
      			<label>Category Name:</label>
      			<select name="category_id" class="form-control" required>
      				<option value="">---Selecet Category---</option>
      				 <?php global $wpdb;
	$select_all_category_data ="SELECT * FROM category";
	$all_category_list = $wpdb->get_results($select_all_category_data); 
	//print_r($userlist);
	foreach ($all_category_list as $key => $all_category_data) { 
		?>

		
		
      				<option value="<?php echo $all_category_data->id;?>"><?php echo $all_category_data->category_name;  ?></option>
      				
<?php
	}
	?>
      				
      			</select>
      			

      		</div>
      		<div class="form-group">
      			<label>Question:</label>
      			<input type="text" name="question" class="form-control" placeholder="insert Question" required>
      			

      		</div>
      		<div class="form-group">
      			<label>Option1:</label>
      			<input type="text" name="ans1" class="form-control" placeholder="insert Option1" required>
      			

      		</div>
      		<div class="form-group">
      			<label>Option2:</label>
      			<input type="text" name="ans2" class="form-control" placeholder="insert Option2" required>
      			

      		</div>
      		<div class="form-group">
      			<label>Option3:</label>
      			<input type="text" name="ans3" class="form-control" placeholder="insert Option3" required>
      			

      		</div>
      		<div class="form-group">
      			<label>Option4:</label>
      			<input type="text" name="ans4" class="form-control" placeholder="insert Option4" required>
      			

      		</div>
      		<div class="form-group">
      			<label>Right Answer:</label>
      			<input type="text" name="ans" class="form-control" placeholder="Insert Right Answer" required>
      			

      		</div>
      		<button type="submit" name="insert_new_question" class="btn btn-primary">Insert Question</button>
      	</form>
      </div>
  </div>
</div>
</div>
<!-- Model Ends here -->


<!-- Tab starts for Result -->
  <div id="quiz_user_result" class="tab-pane fade">
    <h3>User List</h3>
    <table class="table table-bordered">
	<thead>
		<tr>
			<th>
				Sno
				<?php  $no=1;?>
			</th>
			<th>
				Name
			</th>
			<th>
				Category
			</th>
			<th>
				Total Questions
			</th>
			<th>
				Right Answer
			</th>
			<th>
				Wrong Answer
			</th>
			<th>
				Percentage
			</th>
			<th>
				Status
			</th>
			<th>
				Date of test
			</th>
			
			<th colspan="2">
				Action
			</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
    global $wpdb;
	$select_all_results ="SELECT * FROM result";
	$resultslist = $wpdb->get_results($select_all_results); 
	//print_r($userlist);
	foreach ($resultslist as $key => $result_data) { 
		 $que_id = $result_data->id;
			//echo $que_id;
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $result_data->name; ?></td>
			<td><?php  $result_data->category_id; 

			global $wpdb;
	$select_category_name ="SELECT * FROM category WHERE id = '".$result_data->category_id."'";
	$all_categoryname_list = $wpdb->get_results($select_category_name); 
	//print_r($all_categoryname_list); die;
	
		echo $all_categoryname_list[0]->category_name;

	



			?></td>
			<td><?php echo $result_data->total_questions; ?></td>
			<td><?php echo $result_data->right_ans; ?></td>
			<td><?php echo $result_data->wrong_ans; ?></td>
			<td><?php echo $result_data->percentage.'%'; ?></td>
			<td><?php echo $result_data->status; ?></td>
			<td><?php echo $result_data->date; ?></td>
			
			
			<td><a href="#"><button class="btn btn-danger">Delete</button></a></td>

	</tr>		
		
		<?php
	}
	

	?>
</tbody>
</table>		
  </div><!-- Tab ends for Questions -->
</div><!--All user list Tab ends here-->
	
</div>
<!--Container Ends here-->

	<?php 

}

function edit_quiz_setting(){

}

?>