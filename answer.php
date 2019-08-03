<?php 
/* Template name: Quiz submit answer */
get_header();
?>
<?php
/*echo $_SESSION['cat_id'];
echo $_SESSION['user_email'];
 die; */

 /* Generating random session ID for particular session of test  */
 $_SESSION['session_ID']= rand(1000,1000000000);
 //print_r($_POST); die;
foreach ($_POST as $que => $answers)
{
	/*echo "<br>";
	echo $que;
	echo "<br>";
	echo $answers;*/
	//die;

	$insert_user_ans = $wpdb->insert('user_ans_details',
		array(
			'name'=>$_SESSION['user_email'],
			'question_id'=>$que,
			'answer'=> $answers,
			'category_id'=>$_SESSION['cat_id'],
			'session_id'=>$_SESSION['session_ID'],
			'date'=>'CURRENT_TIMESTAMP()'


		));
	if(is_wp_error($insert_user_ans)){
		echo "Failed to submit";
	}
	else{
		//echo "Quiz submitted";
	}
}

					
global $wpdb;
  $check_answers = "SELECT id,ans from  questions WHERE category_id='".$_SESSION['cat_id']."' ";	
$user_answers = $wpdb->get_results($check_answers);

/*echo "<pre>";				
print_r($user_answers);
echo "</pre>";*/

					$right=0;
					$wrong=0;
					$no_answer=0;			

foreach ($user_answers as $user_Ans) {
					
					/*echo "USER ANS==>". $user_Ans->ans;
					echo "ANSID==>" .$_POST[$user_Ans->id];
					die;*/
	


	if($user_Ans->ans == $_POST[$user_Ans->id]){
		 $right++;

	}
	
	elseif($_POST[$user_Ans->id] == "no_answer"){
		 $no_answer++;

	}
	else{
		 $wrong++; //die;
	}

	/*echo $user_Ans->ans;
	echo $user_Ans->id; die;*/

	

	$array=array();
							$array['right'] = $right;
							$array['wrong'] = $wrong;
							$array['no_answer'] = $no_answer;
							/*echo"<br>";
							echo"Right";
							print_r($array['right']);
							echo"Wrong";
							print_r($array['wrong']);
							echo"No Answer";
							print_r($array['no_answer']);
							die;*/

							/*echo  'RightAns'. "  ".$right;

							echo 'Wrong'.'<br>'.$wrong;

							echo  '<br>'.$no_answer;

*/
							$_SESSION['Right']=$array['right'];
							$_SESSION['Wrong']=$array['wrong'];
							$_SESSION['NoANS']=$array['no_answer'];

}

/*echo "R".$right;
	echo"<br>";
	echo "W".$wrong;
	echo"<br>";
	echo "NO".$no_answer;
*/
	$total =	$right + $wrong + $no_answer;

	  $per=($right*100)/($total);
		 $per."%";	

		 //echo $per."%";

?>

<div class="container">
	<center><h4 class="text-center">Score Details</h4>
		<table border="1" class="table table-striped table-responsive">
	<tr>
	<th>sno<?php $counter=1;?></th>
	<th>Total</th>
	<th>Right</th>
	<th>Wrong</th>
	<th>Not Attempt</th>
	<th>PERCENTAGE</th>
	<th>STATUS</th>
		
	</tr>
	<tr>
		<td><?php echo $counter++ ;?></td>
		<td><?php echo $total;?></td>
		<td><?php echo $right; ?></td>
		<td><?php echo $wrong; ?></td>
		<td><?php echo $no_answer; ?></td>
		<td><?php echo $per."%";?></td>
		<?php 
		if($per<='33'){
			$status="Failed";

		}
		else{
			$status = "Pass";

		}


		?>
		<td>
			<?php 
			if($per<33){

				echo"<p style='color:red;'>FAIL</p>";

			} 
			else{
				echo "<p style='color:green;'>PASS</p>";
			}

		

		?></td>

		


	</tr>
</table>



	</center>
<?php 
global $wpdb;
$insert_ans_by_user = $wpdb->insert('result',
	array(
		
		'name'=>$_SESSION['user_email'],
		'category_id'=>$_SESSION['cat_id'],
		'total_questions'=>$total,
		'right_ans'=>$right ,
		'wrong_ans'=>$wrong ,
		'percentage'=>$per."%",
		'status'=>$status,
		'date'=>''


	));

if(is_wp_error($insert_ans_by_user)){
	echo "failed to insert ";

}
else{
	//echo "Inserted";
}

?>

	<a href="<?php echo site_url();?>/check-answers"><button>Check Answer</button></a>
</div>