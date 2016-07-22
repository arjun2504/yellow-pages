<html>
<head>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="../css/bootflat.css" type="text/css">
<link rel="stylesheet" href="../css/custom.css" type="text/css">
<title>Administrator Login</title>
</head>
<body>
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="well" style="margin-top: 40%">
			<center><h4>Administrator Login</h4></center>
			<br>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group <?php if(isset($_GET['error'])) echo 'has-error has-feedback'; ?>">
					<label for="username" class="col-sm-2">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="username" name="u">
						<?php
						if(isset($_GET['error'])) {
						?>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group <?php if(isset($_GET['error'])) echo 'has-error has-feedback'; ?>">
					<label for="pass" class="col-sm-2">Password</label>
					<div class="col-sm-10">
						<input type="password" id="pass" name="p" class="form-control">
						<?php
						if(isset($_GET['error'])) {
						?>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="pass" class="col-sm-2"></label>
					<div class="col-sm-10">
						<center><button class="btn btn-warning">Log in</button> <a href="../index.php"><button class="btn btn-default">Cancel</button></a></center>
					</div>
				</div>
				
			</form>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
</body>
</html>
<?php
	include_once "../db.php";
	if(isset($_POST['u']) && isset($_POST['p']) && !empty($_POST['u']) && !empty($_POST['p'])) {
		$u = $_POST['u'];
		$p = md5($_POST['p']);
		$q = mysqli_query($con,"SELECT * FROM user WHERE username = '$u' AND password = '$p'");
		if(mysqli_num_rows($q) == 1) {
			session_start();
			$_SESSION['admin'] = $u;
			header("Location: index.php");
		}
		else {
			header("Location: login.php?error=1");
		}
	}

?>