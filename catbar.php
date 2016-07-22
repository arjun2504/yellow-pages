<div class="list-group">
	<?php
		$query = mysqli_query($con,"SELECT * FROM Categories");
		while($row = mysqli_fetch_array($query)) {
	?>
	<a href="category.php?id=<?php echo $row['cat_id']; ?>" class="list-group-item"><?php echo $row['cat_name']; ?><span class="badge">3</span></a>
	<?php } ?>
</div>