<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Administrator Dashboard</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(!isset($_GET['id'])) echo "class='active'"; ?>><a href="index.php">Add Content <span class="sr-only">(current)</span></a></li>
        <li <?php if(isset($_GET['id']) && ($_GET['id'] == 2)) echo "class='active'"; ?>><a href="index.php?id=2">Edit Content</a></li>
		<li <?php if(isset($_GET['id']) && ($_GET['id'] == 3)) echo "class='active'"; ?>><a href="index.php?id=3">Manage Advertisements</a></li>
      </ul>
  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Log out</a></li>
    
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>