<?php
	include_once "../db.php";
	session_start();
	if(isset($_SESSION['admin'])) {
		$sname = $_POST['storename'];
		$desc = $_POST['desc'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$fax = $_POST['fax'];
		$web = $_POST['web'];
		$addr = $_POST['addr'];
		if($_POST['cat'] != "new") {
			$cat = $_POST['cat'];
			$ld = mysqli_fetch_array(mysqli_query($con,"SELECT con_id FROM CategoryContent ORDER BY con_id DESC LIMIT 1"));
			$last = $ld[0] + 1;
			mysqli_query($con,"INSERT INTO CategoryContent VALUES ($last,'$sname','$desc','$phone','$addr','$cat','$web','$fax','$email')");
		}
		else {
			$catname = $_POST['catname'];
			$catdes = $_POST['catdes'];
			$lastc = mysqli_fetch_array(mysqli_query($con,"SELECT cat_id FROM Categories ORDER BY cat_id DESC LIMIT 1"));
			$lastb = $lastc[0] + 1;
			mysqli_query($con,"INSERT INTO Categories VALUES ($lastb,'$catname','$catdes')");
			$ld = mysqli_fetch_array(mysqli_query($con,"SELECT con_id FROM CategoryContent ORDER BY con_id DESC LIMIT 1"));
			$last = $ld[0] + 1;
			mysqli_query($con,"INSERT INTO CategoryContent VALUES ($last,'$sname','$desc','$phone','$addr','$lastb','$web','$fax','$email')");
		}
		header("Location: index.php?success=1");
	}
	else {
		header("Location: login.php?error=1");
	}
?>