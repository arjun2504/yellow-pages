<?php
	include_once "db.php";
?><html>
	<head>
		<title>Harish Ganapathy Yellow Pages</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootflat.css">
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>
		<script type="text/javascript">
			$('#abcd a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			<header class="jumbotron"></header>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php include_once"catbar.php"; ?>
				</div>
				<div class="col-md-6">
					<ol id="abcd" class="breadcrumb breadcrumb-arrow">
						<li><a href="">Home</a></li>
						<li><a href="">Home</a></li>
						<li><a href="">Home</a></li>
						<li><a href="">Home</a></li>
					</ol>
					
				</div>
				<div class="col-md-3"><?php include_once "rsidebar.php"; ?></div>
			</div>
		</div>
	</body>
</html>