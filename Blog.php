  <?php require_once("includes/DB.php");?>
 <?php require_once("includes/Functions.php");?>
 <?php require_once("includes/Sessions.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Blog Page</title>

	<style>
		.heading{
	font-family: Bitter, Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	color: #005E90;
     }
     .heading:hover{
	color: #0090DB;
     }
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/style.css">

	 
</head>
<body>
	
<!-- navbar -->
<div style="height: 10px; background:#27aae1;"></div>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container" >
		<a href="#" class="navbar-brand">Sujan Kanti Paul</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapseCMS">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapseCMS"> 
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a href="Blog.php" class="nav-link">Home</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">About</a>
			</li>
			<li class="nav-item">
				<a href="Blog.php" class="nav-link">Blog</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Contact Us</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Features</a>
			</li>
			
		</ul>

		<ul class="navbar-nav ml-auto">
			<form class="form-inline d-none d-sm-block" action="Blog.php">
				<div class="form-group">
				<input class="form-control mr-2" type="text" name="Search" placeholder="Search here" value="">
				<button  class="btn btn-primary" name="SearchButton">Go</button>
				</div>
			</form>
		</ul>
		</div>
	</div>
</div>
<div style="height: 10px; background:#27aae1;"></div>

<!-- navabr end -->

<!-- Main starts -->

<div class="container">
	<div class="row mt-4">
		<div class="col-sm-8 " >

			<h1>the Complete Responsive CMS log</h1>
			<h1 class="lead">Lorem ipsum dolor, sit, amet consectetur adipisicing elit. Accusamus, natus.</h1>
			<?php 
					echo ErrorMessage();
					echo SuccessMessage();

				?>
			
			<?php 
			global $ConnectingDB;

			//SQL query when search button is active

			if(isset($_GET["SearchButton"])){
				$Search = $_GET["Search"];
				$sql = "SELECT * FROM posts WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post LIKE :search" ;
				$stmt = $ConnectingDB->prepare($sql);
				$stmt->bindValue(':search','%'.$Search.'%');
				$stmt->execute();
			}// Query when pagination is active i.e Blog.php?Page=1
			elseif (isset($_GET["page"])) {
				$Page = $_GET["page"];
				if($Page==0){
					$ShowPostFrom=0;
				}else{
				$ShowPostFrom=($Page*5)-5;
				}
				$sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
				$stmt = $ConnectingDB->query($sql);
			}
		/*	Query when category is active in URL Tab*/
			elseif (isset($_GET["category"])) {
				$Category = $_GET["category"];
				$sql= "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
				$stmt = $ConnectingDB->query($sql);
			}


			//The default SQL query
				
				else{$sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
				     $stmt = $ConnectingDB->query($sql);
			         }
				while($DataRows = $stmt->fetch()){
					$PostId			 = $DataRows["id"];
					$DateTime		 = $DataRows["datetime"];
					$PostTitle		 = $DataRows["title"];
					$Category		 = $DataRows["category"];
					$Admin			 = $DataRows["author"];
					$Image			 = $DataRows["image"];
					$PostDescription = $DataRows["post"];
				

			?>

			<div class="card">
				<img src="uploads/<?php echo htmlentities($Image);?>" style="max-height: 450px;" class="img-fluid card-img-top"/>
				<div class="card-body">
					<h4 class="card-title"><?php echo htmlentities($PostTitle);?></h4>
					<small class="text-muted"> Category: <span class="text-dark"><a href="Blog.php?category=<?php echo $Category;?>"><?php echo $Category;?></a></span> &  Written by <span class="text-dark"><a href="Profile.php?username=<?php echo htmlentities($Admin);?>"><?php echo htmlentities($Admin);?></a></span> On <span class="text-dark"><?php echo 
					htmlentities($DateTime);?></span></small>
					<span style="float: right;" class="badge badge-dark text-light">Comments <?php echo ApproveCommentsAccordingToPost($PostId);?></span>
					<hr>
					<p class="card-text"><?php if(strlen($PostDescription)>150){$PostDescription= substr($PostDescription,0,150).'...';} echo htmlentities($PostDescription);?></p>
					<a href="FullPost.php?id=<?php echo $PostId;?>" style="float: right;"><span class="btn btn-info">Read More >></span></a>
				</div>
			</div>

		<?php } ?>

	<!-- 	Pagnatipon  -->

	<nav>
		<ul class="pagination pagination-lg mt-2">
			<!-- creating backward button -->

			<?php if(isset($Page)){
				if($Page>1){

				?>
			<li class="page-item">
				<a href="Blog.php?page=<?php echo $Page-1;?>" class="page-link">&laquo;</a>
			</li>
		<?php } } ?>
			<?php 
			global $ConnectingDB;
			$sql = "SELECT COUNT(*) FROM posts";
			$stmt =$ConnectingDB->query($sql);
			$RowPagination=$stmt->fetch();
			$TotalPosts=array_shift($RowPagination);
			/*echo $TotalPosts."<br>";*/
			$PostPagination=$TotalPosts/5;
			$PostPagination=ceil($PostPagination);
			/*echo $PostPagination;*/
			for ($i=1; $i <=$PostPagination; $i++) { 
				if(isset($Page)){
					if($i==$Page){ 	?>
				<li class="page-item active">
				<a href="Blog.php?page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a>
			    </li>
				 
			<?php 
			}else{ ?>
	
			<li class="page-item">
				<a href="Blog.php?page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a>
			</li>
			<?php } } }  ?>

			<!-- Creatting forward button -->

			<?php if(isset($Page) && !empty($Page)){
				if($Page+1<=$PostPagination){

				?>
			<li class="page-item">
				<a href="Blog.php?page=<?php echo $Page+1;?>" class="page-link">&raquo;</a>
			</li>
		<?php } } ?>
				
			
		</ul>
	</nav>

		</div>

    <!-- Main ends -->
	<!-- 	side area start -->

		<div class="col-sm-4" >
			<div class="card mt-4">
				<div class="card-body">
					<img src="images/blog.jpg" class="d-block img-fluid mb-3" alt="">
					<div class="text-center">
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo consequatur, voluptatem veritatis et beatae fugiat reprehenderit natus dicta perspiciatis voluptate dolor hic sit libero incidunt esse at nostrum. Minus, nam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo consequatur, voluptatem veritatis et beatae fugiat reprehenderit natus dicta perspiciatis voluptate dolor hic sit libero incidunt esse at nostrum. Minus, nam.
					</div>
				</div>
			</div>

			<br>

			<div class="card">
				<div class="card-header bg-dark text-light">
					<h2 class="lead">Sign Up !</h2>
				</div>
				<div class="card-body">
					<button type="submit" class="btn btn-success btn-block text-center text-white mb-4">Join the forward</button>
					<button type="submit" class="btn btn-danger btn-block text-center text-white mb-4">Login</button>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="" placeholder="Enter your Email" value="">
						<div class="input-group-append">
							<button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe now</button>
						</div>
					</div>

				</div>


			</div>
			<br>
			<div class="card">
				<div class="card-header bg-primary text-light">
					<h2 class="lead">
						Categories
					</h2>
					</div>
					<div class="card-body">
						<?php 

						global $ConnectingDB;
						$sql="SELECT * FROM category ORDER BY id desc";
						$stmt = $ConnectingDB->query($sql);
						while($DataRows = $stmt->fetch()){
							$CategoryId = $DataRows["id"]; 
							$CategoryName = $DataRows["title"];

						?>
							<a href="Blog.php?category=<?php echo $CategoryName;?>"><span class="heading"><?php echo $CategoryName;?></span></a><br>

					<?php } ?>
					
				</div>
			</div>

			<br>
			<div class="card">
				<div class="card-header bg-info text-white">
					<h2 class="lead">Recent Posts</h2>
				</div>
				<div class="card-body">
					<?php 
					global $ConnectingDB;
					$sql ="SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
					$stmt= $ConnectingDB->query($sql);
					while($DataRows=$stmt->fetch()){
						$Id 	= $DataRows["id"];
						$Title 	= $DataRows["title"];
						$DateTime = $DataRows["datetime"];
						$Image = $DataRows["image"];
					
					?>
					<div class="media">
						<img src="uploads/<?php echo htmlentities($Image) ;?>" class="d-block img-fluid align-self-start" width="90" height="94" alt="">
						<div class="media-body ml-2">
							<a href="FullPost.php?id=<?php echo htmlentities($Id);?>" target="_blank"><h6 class="lead"><?php echo htmlentities($Title);?></h6></a>
							<p class="small"><?php echo htmlentities($DateTime);?></p>
						</div>
					</div>
					<hr>


					<?php } ?>
				</div>
			</div>
			
		</div>

		<!-- side area ends -->
	</div>
</div>



<br>





<!-- Footer starts -->

<footer class="bg-dark text-white">
	<div class="container">
		<div class="row">
		  		<div class="col">
				<p class="lead text-center">Thanks BY | sujan kanti | <span id="year"></span>&copy; --All right reserved.</p>
			</div>
		</div>
	</div>
</footer>
<div style="height: 10px; background:#27aae1;"></div>

<!-- Footer ENds
 -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
	$('#year').text(new Date().getfullYear());
</script>
	
</body>
</html>