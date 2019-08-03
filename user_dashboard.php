<?php 
if(!isset($_SESSION['user_email'])){
	$path = site_url();
	wp_redirect($path);
}

?>

<?php 
/* Template name: User Dashboard */ 
get_header();
?>
<div class="container">
	<a href="<?php echo site_url();?>/logout"><button class="btn btn-primary pull-right ">Logout</button></a>
	<center><h5>Welcome,<?php echo $_SESSION['user_email']; ?></h5>
<button type="button" class="btn btn-primary" data-toggle="tab" href="#select">Start Quiz</button></center>
		<br>
		<div class="col-md-4"></div>
  <div class="col-md-4">
	 <div id="select" class="tab-pane fade">
	 	<form method ="post" action ="<?php echo site_url();?>/quiz-page">
	 		<select class="form-control" id="" name="cat_id" required>
	 			<option value="">------Select Category-----</option>
	 		 <?php 
	 		 global $wpdb;
			 $select_category = "SELECT * FROM  category";
			$all_Category = $wpdb->get_results($select_category);

    foreach( $all_Category as $category ) { 
    	/*echo "<pre>";
		print_r($all_Category);die;
		echo "</pre>";*/
		?>

<option value="<?php echo $category->id; ?>">
	<?php echo $category->category_name; ?>
</option>
		<?php 
    }
    	?>
     	
	 	</select>
	 	<br><center><input type="submit" name="submit" class="btn btn-primary"></center>
	 </form>

	 </div>
	</div>
</div>