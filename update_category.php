<?php 
/* Template name: Update Category  */

$category_id = $_GET['category_id'];
//echo $category_id;

$select_category ="SELECT * FROM category WHERE id ='".$category_id."'";
$category_data = $wpdb->get_results($select_category);
//print_r($category_data);

foreach ($category_data as $key => $update_category) {
	# code...
}
?>
<div class="container">
<form action="<?php echo site_url();?>/update-category-process-page" method="POST">
	<div class="form-group">
		<input type="text" name="category_name" class="form-control" value="<?php echo $update_category->category_name; ?>" required>
	</div>
	<input type="hidden" name="category_id" value="<?php echo $update_category->id;?>">
	<div class="form-group">
		<input type="submit" name="update" class="btn btn-primary">
	</div>


</form>
</div>
<?php get_header(); ?>