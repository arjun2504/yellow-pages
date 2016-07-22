<?php
	session_start();
	if(isset($_SESSION['admin'])) {
		include_once "../db.php";
		$adId = $_POST['aid'];
		$file = mysqli_fetch_array(mysqli_query($con,"SELECT filename FROM ads WHERE aid = $adId LIMIT 1"));
		unlink("../ad/".$file[0]);
		$con->query("DELETE FROM ads WHERE aid = $adId");
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
?>