
 <?php require_once("includes/DB.php");?>
 <?php require_once("includes/Functions.php");?>
 <?php require_once("includes/Sessions.php");?>

<?php 
 $_SESSION["TrackingURL"]= $_SERVER["PHP_SELF"];
 
 //echo  $_SESSION["TrackingURL"];
Confirm_Login();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Comments</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/style.css">

	 
</head>
<body>
	
<!-- navbar -->
<div style="height: 10px; background:#27aae1;"></div>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container" >
		<a href="#" class="navbar-brand">NEUON AI</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapseCMS">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapseCMS"> 
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
			</li>
			<li class="nav-item">
				<a href="Dashboard.php" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item">
				<a href="Posts.php" class="nav-link">Posts</a>
			</li>
			<li class="nav-item">
				<a href="Categories.php" class="nav-link">Categories</a>
			</li>
			<li class="nav-item">
				<a href="Admins.php" class="nav-link">Manage Admins</a>
			</li>
			<li class="nav-item">
				<a href="Comments.php" class="nav-link">Comments</a>
			</li>
			<li class="nav-item">
				<a href="Blog.php?page=1" class="nav-link">Live Blog</a>  
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i> Logout</a></li>
		</ul>
		</div>
	</div>
</div>
<div style="height: 10px; background:#27aae1;"></div>

<!-- navabr end -->

<!-- header starts -->


<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h1><i class="fas fa-comments" style="color: #27aae1"></i>Manage Comments</h1>
				</div>
				
			</div>
		</div>
	</div>
</header>
<br>

<!-- header ends -->

<section class="container py-2 mb-4">
	<div class="row" style="min-height: 30px;">
		<div class="col-lg-12" style="min-height: 400px;">

			<?php 
					echo ErrorMessage();
					echo SuccessMessage();

				?>

				<h2>Up-Approved Comments</h2>
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Date&Time</th>
						<th>Name</th>
						
						<th>Comment</th>
						<th>Approve</th>
						<th>Action</th>
						<th>Details</th>
						
					</tr>
				</thead>
			


		
			<?php
			global $ConnectingDB;
			$sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
			while ($DataRows=$Execute->fetch()){
				$CommentId= $DataRows["id"];
				$DateTimeOfComment =  $DataRows["datetime"];
				$CommenterName = $DataRows["name"];
				$CommentContent = $DataRows["comment"];
				$CommentPostId = $DataRows["post_id"];
				$SrNo++;
			?>
	
				<tbody>
					<tr>
						<td><?php echo htmlentities($SrNo);?></td>
						<td><?php echo htmlentities($DateTimeOfComment);?></td>
						<td><?php echo htmlentities($CommenterName);?></td>
						
						<td><?php echo htmlentities($CommentContent);?></td>
						<td><a class="btn btn-success" href="ApproveComments.php?id=<?php echo $CommentId?>">Approve</a></td>
						<td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId?>">Delete</a></td>
						<td style="min-width: 140px;"><a class="btn btn-primary" href="FullPost.php?id<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
					</tr>
				
				</tbody>
			<?php } ?>
			</table>

				<h2>Approved Comments</h2>
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Date&Time</th>
						<th>Name</th>
						
						<th>Comment</th>
						<th>Revert</th>
						<th>Action</th>
						<th>Details</th>
						
					</tr>
				</thead>
			


		
			<?php
			global $ConnectingDB;
			$sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
			while ($DataRows=$Execute->fetch()){
				$CommentId= $DataRows["id"];
				$DateTimeOfComment =  $DataRows["datetime"];
				$CommenterName = $DataRows["name"];
				$CommentContent = $DataRows["comment"];
				$CommentPostId = $DataRows["post_id"];
				$SrNo++;
			?>
	
				<tbody>
					<tr>
						<td><?php echo htmlentities($SrNo);?></td>
						<td><?php echo htmlentities($DateTimeOfComment);?></td>
						<td><?php echo htmlentities($CommenterName);?></td>
						
						<td><?php echo htmlentities($CommentContent);?></td>
						<td style="min-width: 140px;"><a class="btn btn-warning" href="DisApproveComments.php?id=<?php echo $CommentId?>">Dis-Approve</a></td>
						<td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId?>">Delete</a></td>
						<td style="min-width: 140px;"><a class="btn btn-primary" href="FullPost.php?id<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
					</tr>
				
				</tbody>
			<?php } ?>
			</table>
		</div>
	</div>
</section>



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