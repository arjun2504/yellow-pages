<?php
	require_once('db.php');
	$cid = $_GET['id'];
	$from = $_GET['from'];
	$to = $_GET['to'];
	$disp = $con->query("SELECT * FROM ads WHERE cat_id = $cid LIMIT $from, $to");
	while($i = $disp->fetch_array(MYSQLI_BOTH)) {
?>
<div class="well">
	<img src="ad/<?php echo $i['filename']; ?>" style="width: 100%; height: 292px">
</div>
<?php } ?>