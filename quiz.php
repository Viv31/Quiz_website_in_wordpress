<?php 
if(!isset($_SESSION['user_email'])){
	$path = site_url();
	wp_redirect($path);
}
?>
<style type="text/css">
    .clickable{
        cursor: pointer;
    }

    #questions_form{
        /*background-color: grey;*/
        margin-left: 20px;
    }
</style>
<div class="container">
<div class="row">
    
<center><h3>Welcome ,<?php echo ucfirst($_SESSION['user_email']);?></h3></center>
    	<div class="col-md-3"></div>
    	<div class="col-md-6">
<div id="timer"></div>
    	<div class="jumbotron">
    		
    		<?php

$category_id = $_POST['cat_id'];
//echo "category_id". $category;
$_SESSION['cat_id'] = $category_id;

$test_category_id = $_SESSION['cat_id'];

global $wpdb;
			 $select_questions = "SELECT * FROM  questions WHERE category_id = '".$category_id."'";
			$all_questions = $wpdb->get_results($select_questions);
$question_count = '1';
    foreach( $all_questions as $questions ){
    	/*echo "<pre>";
    	print_r($all_questions);
    	echo "</pre>";*/
    	?>
    	
    	<form action="<?php echo site_url();?>/quiz-submit-page" method="POST">
    		
    			<div class="form-group" id="questions_form">
    				 <?php echo $question_count++; ?>&nbsp;)&nbsp;<?php echo $questions->question; ?><br>
    				<span class="clickable">A)&nbsp;<input type="radio" name="<?php echo $questions->id; ?>" value="<?php echo $questions->ans1; ?>"><?php echo $questions->ans1; ?></span>

    				<span class="clickable">B)&nbsp;<input type="radio" name="<?php echo $questions->id; ?>" value="<?php echo $questions->ans2; ?>"><?php echo $questions->ans2; ?></span><br>

    				<span class="clickable">C)&nbsp;<input type="radio" name="<?php echo $questions->id; ?>" value="<?php echo $questions->ans3; ?>"><?php echo $questions->ans3; ?></span>

    				<span class="clickable">D)&nbsp;<input type="radio" name="<?php echo $questions->id; ?>" value="<?php echo $questions->ans4; ?>"><?php echo $questions->ans4; ?></span>

    				<input type="radio" value="<?php echo "no_answer";?> " checked="checked" style="display:none;" name="<?php echo $questions->id;?>"/>
    			</div>


    	<?php 
    }
?>
<input type="submit" value="submit Quiz" id="submit" class="btn btn-success"/>

    		

    	</form>
</div>
</div>
<div class="col-md-3"></div>
</div>
</div>

<?php /* Template name: Quiz page */ 
get_header();
?>


<?php get_footer(); ?>
<!-- Script starts for timer    -->
<script>
var total_seconds =1800;
var c_minutes=parseInt(total_seconds/60);
var c_seconds=parseInt(total_seconds%60);
function CheckTime()
{
document.getElementById('timer').innerHTML='TIME LEFT:'+' '+ c_minutes+'   ' + 'min'+' '+ c_seconds+'  ' + 'sec';
if(total_seconds<=30){
{
 	timer.style.color='#f90';
 	//
 }
}
if(total_seconds<=10){

 {
 	timer.style.color='red';
 	//
}
}
if(total_seconds<=0){

			//alert("Sorry your time is over!!!");
        $("#submit").click();
        //this code is used for submitting form it requires Jquery CDN 
        
        
        
        
    }
    else{
    total_seconds=total_seconds-1;
    c_minutes=parseInt(total_seconds/60);
    c_seconds=parseInt(total_seconds%60); 
     setTimeout("CheckTime()",1000);
	}
}
setTimeout("CheckTime()",1000);
   </script>
   <!-- Script ends for timer    -->

   <script type="text/javascript">
    /*
        this script is used for making whole td clickable  
    */
    $('.clickable').click(function(event) {
  if(event.target.type !== 'radio') {
    $(':radio', this).trigger('click');
  }
});
  </script>