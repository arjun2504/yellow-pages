<?php
	include_once "../db.php";
	session_start();
	if(isset($_SESSION['admin'])) {
		$sid = $_POST['sid'];
		$sname = $_POST['storename'];
		$desc = $_POST['desc'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$fax = $_POST['fax'];
		$web = $_POST['web'];
		$addr = $_POST['addr'];
		$cati = $_POST['cati'];
		mysqli_query($con,"UPDATE CategoryContent SET con_name = '$sname', con_desc = '$desc', contact = '$phone', address = '$addr', cat_id = '$cati', web = '$web', fax = '$fax', email = '$email' WHERE con_id = $sid");
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	else {
		header("Location: login.php?error=1");
	}
?>