<?php
session_start();
if(isset($_SESSION['admin'])) {
	include_once "../db.php";
	$cat = $_POST['cati'];
	
	$lid = $con->query("SELECT aid FROM ads ORDER BY aid DESC");
	$l_id = $lid->fetch_array(MYSQLI_NUM);
	$newid = $l_id[0] + 1;
	$fileName = $newid."_".$_FILES["upload_file"]["name"][0];
	$fileTmpLoc = $_FILES["upload_file"]["tmp_name"][0];
	//$fileType = @$_FILES["upload_file"]["image/png||image/jpg"];
	$fileSize = $_FILES["upload_file"]["size"][0];
	$fileErrorMsg = $_FILES["upload_file"]["error"][0];
	$moveResult= move_uploaded_file($fileTmpLoc, "../ad/$fileName");
	mysqli_query($con, "INSERT INTO ads (aid, filename, cat_id) VALUES ($newid, '$fileName',$cat)");
	unlink($fileTmpLoc);
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
else {
	header("Location: login.php?error=1");
}
?>