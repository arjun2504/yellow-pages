<?php
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location: login.php");
	}
	else {
		include_once "../db.php";
?>

<!DOCTYPE>
<html>
	<head>
		<title>Administrator Dashboard</title>
		<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
		<link rel="stylesheet" href="../css/bootflat.css" type="text/css">
		<link rel="stylesheet" href="../css/custom.css" type="text/css">
		<script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="../js/bootstrap.js" type="text/javascript"></script>
		<script>
			function newcat() {
				if(document.getElementById('catch').value == 'new') {
					$('#insertcat').removeAttr("style");
					$('#insertcat').attr("style","display:block");
				}
				else {
					$('#insertcat').removeAttr("style");
					$('#insertcat').attr("style","display:none");
				}
			}
			function check() {
				if(document.getElementById('cont').value == '') {
					alert("Please enter the Store name");
					return false;
				}
				else if(document.getElementById('catch').value == 'new' && document.getElementById('catname').value == '') {
					alert("Please enter the new category name");
					return false;
				}
				else {
					return true;
				}
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<?php include_once "nav.php"; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="well" style="display:inline-block; width: 100%">
						
						<?php
							if(!isset($_GET['id'])) {
						?>
						<center><h4>Add Content</h4></center>
						<hr>
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<?php
								if(isset($_GET['success'])) {
							?>
							<div class="alert alert-success">Your content has been posted!</div>
							<?php } ?>
							<form class="form-horizontal" action="addcontent.php" method="post" onsubmit="return check();">
								<div class="form-group">
									<label for="cont" class="col-sm-3">Store Name</label>
									<div class="col-sm-9">
										<input type="text" id="cont" name="storename" placeholder="Enter name of the hotel or theatre or store name" class="form-control" required />
									</div>
								</div>
								
								<div class="form-group">
									<label for="desc" class="col-sm-3">Description</label>
									<div class="col-sm-9">
										<textarea id="desc" name="desc" placeholder="Describe the store" class="form-control"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label for="addr" class="col-sm-3">Address</label>
									<div class="col-sm-9">
										<textarea id="desc" name="addr" placeholder="Enter location address" class="form-control"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label for="phone" class="col-sm-3">Phone</label>
									<div class="col-sm-9">
										<input type="text" name="phone" id="phone" placeholder="Type phone number" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label for="email" class="col-sm-3">Email</label>
									<div class="col-sm-9">
										<input type="text" name="email" id="email" placeholder="Type email address" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label for="web" class="col-sm-3">Website</label>
									<div class="col-sm-9">
										<input type="text" name="web" id="web" placeholder="Type web address" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label for="cont" class="col-sm-3">Fax</label>
									<div class="col-sm-9">
										<input type="text" name="fax" id="cont" placeholder="Type fax number" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label for="cont" class="col-sm-3">Category</label>
									<div class="col-sm-9">
										<select class="form-control" id="catch" name="cat" onchange="newcat()">
											<?php
												$q = mysqli_query($con,"SELECT * FROM Categories");
												while($r = mysqli_fetch_array($q)) {
											?>
											<option value="<?php echo $r['cat_id']; ?>"><?php echo $r['cat_name']; ?></option>
											<?php } ?>
											<option disabled>------------------</option>
											<option value="new">Add New Category</option>
										</select>
									</div>
								</div>
								
								<span id="insertcat" style="display:none">
								<div class="form-group">
									<label for="catname" class="col-sm-3">Category Name</label>
									<div class="col-sm-9">
										<input type="text" id="catname" name="catname" placeholder="New category name" class="form-control">
									</div>
								</div>
								
								
								<div class="form-group">
									<label for="catdes" class="col-sm-3">Short description</label>
									<div class="col-sm-9">
										<textarea id="catdes" name="catdes" placeholder="Brief description about the category" class="form-control"></textarea>
									</div>
								</div>
								</span>
								
								<div class="form-group">
									<label for="submit" class="col-sm-3"></label>
									<div class="col-sm-9">
										<center><button type="submit" class="btn btn-success">Add</button></center>
									</div>
								</div>
								
							</form>
							
						</div>
						<div class="col-md-3"></div>
						
						<?php
						}
						else if($_GET['id'] == 2) {
							?>
							<center><h4>Edit Content</h4></center>
							<hr>
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<form class="form-horizontal" action="" id="fetcont" method="get">
									<div class="form-group">
										<label class="col-sm-3" for="catch">Category</label>
										<div class="col-sm-9">
											<input type="hidden" name="id" value="2">
											<select class="form-control" name="catid" onchange="getcontent()">
												<option>Select a category</option>
												<?php
													$q = mysqli_query($con,"SELECT * FROM Categories ORDER BY cat_name");
													while($r = mysqli_fetch_array($q)) {
												?>
												<option value="<?php echo $r['cat_id']; ?>" <?php if($r['cat_id'] == $_GET['catid']) echo 'selected'; ?>><?php echo $r['cat_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									</form>
									<?php
										if(isset($_GET['catid'])) {
											?>
											<form class="form-horizontal" action="" method="get" id="fetform">
									<div class="form-group">
										<label class="col-sm-3">Choose Store / Sub Category</label>
										<div class="col-sm-9">
											<input type="hidden" value="2" name="id">
											<input type="hidden" name="catid" value="<?php echo $_GET['catid']; ?>">
											<select class="form-control" name="store" onchange="getform()">
												<option>Select Content</option>
											<?php
												$catid = $_GET['catid'];
												$q = mysqli_query($con,"SELECT * FROM CategoryContent WHERE cat_id = $catid ORDER BY con_name");
												while($r = mysqli_fetch_array($q)) {
											?>
												<option value="<?php echo $r['con_id']; ?>" <?php if($r['con_id'] == $_GET['store']) echo 'selected'; ?>><?php echo $r['con_name']; ?></option>
											<?php } ?>
											
											</select>
										</div>
									</div>
											</form>
											<?php
										}
									?>
								
								<?php
									if(isset($_GET['catid']) && isset($_GET['id']) && isset($_GET['store']) && ($_GET['id'] == 2)) {
								?>
								
								<form class="form-horizontal" action="editcontent.php" method="post">
									
									
									<?php
										$conr = $_GET['store'];
										$qr = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM CategoryContent WHERE con_id = $conr LIMIT 1"));
									?>
									
									
									<div class="form-group">
										<label for="cont" class="col-sm-3">Store Name</label>
										<div class="col-sm-9">
											<input type="text" id="cont" name="storename" placeholder="Enter name of the hotel or theatre or store name" class="form-control" required value="<?php echo $qr['con_name']; ?>" />
											<input type="hidden" name="sid" value="<?php echo $qr['con_id']; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="desc" class="col-sm-3">Description</label>
										<div class="col-sm-9">
											<textarea id="desc" name="desc" placeholder="Describe the store" class="form-control"><?php echo $qr['con_desc']; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="addr" class="col-sm-3">Address</label>
										<div class="col-sm-9">
											<textarea id="desc" name="addr" placeholder="Enter location address" class="form-control"><?php echo $qr['address']; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="phone" class="col-sm-3">Phone</label>
										<div class="col-sm-9">
											<input type="text" name="phone" id="phone" placeholder="Type phone number" value="<?php echo $qr['contact']; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-sm-3">Email</label>
										<div class="col-sm-9">
											<input type="text" name="email" id="email" placeholder="Type email address" value="<?php echo $qr['email']; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label for="web" class="col-sm-3">Website</label>
										<div class="col-sm-9">
											<input type="text" name="web" id="web" placeholder="Type web address" value="<?php echo $qr['web']; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label for="cont" class="col-sm-3">Fax</label>
										<div class="col-sm-9">
											<input type="text" name="fax" id="cont" placeholder="Type fax number" class="form-control" value="<?php echo $qr['fax']; ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="cont" class="col-sm-3">Category</label>
										<div class="col-sm-9">
											<select class="form-control" id="catch" name="cati">
												<?php
													$q1 = mysqli_query($con,"SELECT * FROM Categories");
													while($r = mysqli_fetch_array($q1)) {
												?>
												<option value="<?php echo $r['cat_id']; ?>" <?php if($qr['cat_id'] == $r['cat_id']) echo 'selected'; ?>><?php echo $r['cat_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="cont" class="col-sm-3"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-success">Make Changes</button>
										</div>
									</div>
									
									
									
									
								</form>
								
								<?php } 
								
								?>
								<script type="text/javascript">
									function getcontent() {
										document.getElementById('fetcont').submit();
									}
									function getform() {
										document.getElementById('fetform').submit();
									}
								</script>
								
								
							</div>
							<div class="col-md-3"></div>
							<?php
						}
						else if($_GET['id'] == 3) {
							?>
							
							
							<center><h4>Add Adverts</h4></center>
							<hr>
							<div class="col-md-3"></div>
							<div class="col-md-6">
								
								
								<form class="form-horizontal" action="upad.php" method="post" enctype="multipart/form-data">
									
									<div class="form-group">
										<label for="cont" class="col-sm-3">Category</label>
										<div class="col-sm-9">
											<select class="form-control" id="catch" name="cati">
												<?php
													$q1 = mysqli_query($con,"SELECT * FROM Categories");
													while($r = mysqli_fetch_array($q1)) {
												?>
												<option value="<?php echo $r['cat_id']; ?>" <?php if($qr['cat_id'] == $r['cat_id']) echo 'selected'; ?>><?php echo $r['cat_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								
									
									<div class="form-group">
										<label for="cont" class="col-sm-3">Browse Image</label>
										<div class="col-sm-9">
											<input type="file" name="upload_file[]" >
										</div>
									</div>
									
									<div class="form-group">
										<label for="cont" class="col-sm-3"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-success">Upload</button>
										</div>
									</div>
									
									
								</form>
							</div>
							<hr style="clear: both">
							
							<center><h4>Existing Ads</h4></center>
							<div class="col-md-3"></div>
							<div class="col-md-6">
								
								<form class="form-horizontal" action="" method="get">
									
									<div class="form-group">
										<label for="cont" class="col-sm-3">Choose Category</label>
										<div class="col-sm-9">
											<input type="hidden" value="3" name="id">
											<select class="form-control" id="catch" name="view_cat" onchange="this.form.submit()">
												<option>---Choose a Category---</option>
												<?php
													$q1 = mysqli_query($con,"SELECT * FROM Categories");
													while($r = mysqli_fetch_array($q1)) {
												?>
												<option value="<?php echo $r['cat_id']; ?>" <?php if($qr['cat_id'] == $r['cat_id']) echo 'selected'; ?>><?php echo $r['cat_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</form>	
									<?php
										if(isset($_GET['view_cat'])) {
											?>
											
											<div class="row">
											<?php
												$selId = $_GET['view_cat'];
												$quer = $con->query("SELECT * FROM ads WHERE cat_id = $selId");
												while($images = $quer->fetch_array(MYSQLI_BOTH)) {
													?>
													
													<div class="col-xs-6 col-md-3">
													    <a href="../ad/<?php echo $images['filename']; ?>" class="thumbnail">
													      <img src="../ad/<?php echo $images['filename']; ?>">
													<div style="height: 10px; width: 100%"></div>
													<form action="delad.php" method="post">
														<input type="hidden" value="<?php echo $images['aid']; ?>" name="aid">
													<center><button type="submit" title="Delete this ad" style="border-width: 0; background-color: transparent" class="glyphicon glyphicon-trash"></button></center>
													</form>
													    </a>
														
													  </div>
													
													<?php
												}
											?>	
											</div>
											
											
											<?php
										}
									?>
									
									</form>
								
							</div>
							
							<?php
						}
						 ?>
					</div>
					
				</div>
			</div>

		</div>
	</body>
</html>
<?php } ?>