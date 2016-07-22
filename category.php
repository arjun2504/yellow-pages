<?php
	include_once "db.php";
	error_reporting(0);
?><html>
	<head>
		<title> Yellow Pages</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootflat.css">
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>
		<script type="text/javascript">
			$('#abcd a').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show');
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
					
					<div class="well">
						<?php
							$id = $_GET['id'];
							$view = $_GET['view'];
							$catname = mysqli_fetch_array(mysqli_query($con,"SELECT cat_name FROM Categories WHERE cat_id = $id"));
							$conname = mysqli_fetch_array(mysqli_query($con,"SELECT con_name FROM CategoryContent WHERE con_id = $view"));
							if(isset($_GET['view'])) {
								echo "<h4>".$conname[0]."</h4>";
							}
							else if(!isset($_GET['view'])) {
								echo "<h4>".$catname[0]."</h4>";
							}
						?>
					</div>
					<ol id="abcd" class="breadcrumb breadcrumb-arrow">
						<?php
							if((basename($_SERVER['PHP_SELF']) == "category.php") && !isset($_GET['view'])) {
						?>
						<li><a href="index.php">Home</a></li>
						<li class="active"><span><?php echo $catname[0]; ?></span></li>
						<?php } else if((basename($_SERVER['PHP_SELF']) == "category.php") && isset($_GET['view'])) {
						?>
						<li><a href="index.php">Home</a></li>
						<li><a href="category.php?id=<?php echo $_GET['id']; ?>"><?php echo $catname[0]; ?></a></li>
						<li class="active"><span><?php echo $conname[0]; ?></span></li>
						<?php
						}	
						?>
					</ol>
					
					<?php
						if(!isset($_GET['view'])) {
					?>
					
					<div class="panel">
					<div class="tabbable tabs-right">
					  	<ul class="nav nav-tabs">
						<?php
							$alphas = range('A', 'Z');
							$alphass = range('a','z');
							for($i=0;$i<count($alphas);$i++) {
								$q = mysqli_query($con,"SELECT con_name FROM CategoryContent WHERE cat_id = $id AND (LEFT(con_name,1) = '$alphas[$i]' OR LEFT(con_name,1) = '$alphass[$i]') ORDER BY con_name ASC");
								if(!(mysqli_num_rows($q) > 0)) {
									continue;
								}
								
						?>
					    	<li><a href="#<?php echo $alphas[$i]; ?>" <?php //if($alphas[$i] == 'A') echo "class='active'"; ?> data-toggle="tab">&nbsp;&nbsp; <?php echo $alphas[$i]; ?> &nbsp;&nbsp;</a></li>
						<?php } ?>
					  	</ul>
						<br>
					  	<div class="tab-content">
							<div class="tab-pane fade active in" id="ALL">
								<ul class="list-group custi">
								<?php
									
									$q = mysqli_query($con,"SELECT * FROM CategoryContent WHERE cat_id = $id");
									while($r = mysqli_fetch_array($q)) {
								?>
								<a href="category.php?id=<?php echo $id.'&view='.$r['con_id']; ?>"><li class="list-group-item"><?php echo $r['con_name']; ?></li></a>
								<?php } ?>
								</ul>
							</div>
							<?php
								$alp1 = range('A','Z');
								$alp2 = range('a','z');
								for($i=0;$i<count($alp1);$i++) {
									$q = mysqli_query($con,"SELECT con_name, con_id FROM CategoryContent WHERE cat_id = $id AND (LEFT(con_name,1) = '$alp1[$i]' OR LEFT(con_name,1) = '$alp2[$i]') ORDER BY con_name ASC");
									if(!(mysqli_num_rows($q) > 0)) {
										continue;
									}
							?>
					    	<div class="tab-pane fade" id="<?php echo $alp1[$i]; ?>"><p>
								<ul class="list-group custi">
					    		<?php
									while($r = mysqli_fetch_array($q)) {
								?>
									<a href="category.php?id=<?php echo $id.'&view='.$r['con_id']; ?>"><li class="list-group-item"><?php echo $r['con_name']; ?></li></a>
								<?php
									}
								?>
								</ul>	
								
					    		</p>
							</div>
							
							
							
							<?php } ?>
					  		</div>
						</div>
					</div>
					<?php }
						else {
							$q = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM CategoryContent WHERE con_id = $view"));
					?>
						<div class="well">
							<?php echo $q['con_desc']; ?>
							<?php
								if($q['address'] != NULL) {
							?>
							<hr>
							<span class="glyphicon glyphicon-envelope"></span>&nbsp; &nbsp; <?php echo $q['address']; ?>
							<?php } ?>
							<?php
								if($q['contact'] != NULL) {
							?>
							<hr>
							<span class="glyphicon glyphicon-phone"></span>&nbsp; &nbsp; <?php echo $q['contact']; ?>
							<?php } ?>
							<?php
								if($q['email'] != NULL) {
							?>
							<hr>
							<span class="glyphicon glyphicon-send"></span>&nbsp; &nbsp; <?php echo $q['email']; ?>
							<?php } ?>
							<?php
								if($q['web'] != NULL) {
							?>
							<hr>
							<span class="glyphicon glyphicon-globe"></span>&nbsp; &nbsp; <a href="<?php echo $q['web']; ?>" rel="nofollow" target="_blank"><?php echo $q['web']; ?></a>
							<?php } ?>
							<?php
								if($q['fax'] != NULL) {
							?>
							<hr>
							<span class="glyphicon glyphicon-print"></span>&nbsp; &nbsp; <?php echo $q['fax']; ?>
							<?php } ?>
						</div>
					<?php
						}
					?>
				</div>
				<div class="col-md-3">
					<div id="refreshAds">
						
						<?php
							
							$cid = $_GET['id'];
							$disp = $con->query("SELECT * FROM ads WHERE cat_id = $cid LIMIT 0,10");
							while($i = $disp->fetch_array(MYSQLI_BOTH)) {
						?>
						<div class="well">
							<img src="ad/<?php echo $i['filename']; ?>" style="width: 100%; height: 292px">
						</div>
						<?php } ?>
						
					</div>
				
				</div>
				<?php
					$cid = $_GET['id'];
					$adlimit = $con->query("SELECT COUNT(aid) FROM ads WHERE cat_id = $cid");
					$lim = $adlimit->fetch_array(MYSQLI_NUM);
				?>
				<script>
				$(document).ready(function() {
					var wth = "rsidebar.php";
					var i = 10;
					var j = parseInt(i) + 20;
					function callAjax() {
						$.ajax({
							url :wth + "?id=" + <?php echo $_GET['id']; ?> + "&from=" + i + "&to=" + j,
							type:"GET",
							data: 'html',
							success:function(data){
								$('#refreshAds').html(data);
							},
							error:function(er){
								$('#refreshAds').html(er.responseText);
							}
						});
						
						i = i + 10;
						j = i + 10;
						
						if(i > <?php echo $lim[0]; ?>) {
							i = 0;
							j = parseInt(i) + 10;
						}
						
					  }

						setInterval(function() { callAjax(); },2000);
				});
					
				</script>
			</div>
		</div>
	</body>
</html>