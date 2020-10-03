
 <?php require_once("includes/DB.php");?>
 <?php require_once("includes/Functions.php");?>
 <?php require_once("includes/Sessions.php");?>

<?php 
 $_SESSION["TrackingURL"]= $_SERVER["PHP_SELF"];
 
 //echo  $_SESSION["TrackingURL"];

Confirm_Login(); ?>

 <?php
 // fetching the existing admin data start
 $AdminId = $_SESSION["UserId"];
 global $ConnectingDB;
 $sql = "SELECT * FROM admins WHERE id='$AdminId'";
 $stmt = $ConnectingDB->query($sql);
 while($DataRows = $stmt->fetch()){
 	$ExistingName = $DataRows['aname'];
 	$ExistingUsername = $DataRows['username'];
 	$ExistingHeadline = $DataRows['aheadline'];
 	$ExistingBio = $DataRows['abio'];
 	$ExistingImage = $DataRows['aimage'];

 }
  // fetching the existing admin data ends
 

  if(isset($_POST["Submit"])){
  $AName = $_POST["Name"];
  $AHeadline = $_POST["Headline"];
  $ABio = $_POST["Bio"];
  $Image = $_FILES["Image"]["name"];
  $Target = "images/".basename($_FILES["Image"]["name"]);

	if(strlen($AHeadline)>30){
	$_SESSION["ErrorMessage"]= "Headline should be less than 30 characters";
 	Redirect_to("MyProfile.php");
	}elseif(strlen($Abio)>500){
	$_SESSION["ErrorMessage"]= "Bio should be less than 555 character";
 	Redirect_to("MyProfile.php");
	}else{
		//queryt to update Admin data in DB everything is fine
		global $ConnectingDB;
		if(!empty($_FILES["Image"]["name"])){
			$sql = "UPDATE admins SET aname='$AName', aheadline='$AHeadline', abio='$ABio', aimage='$Image' WHERE id='$AdminId'";
		}else{
			$sql = "UPDATE admins SET aname='$AName', aheadline='$AHeadline', abio='$ABio' WHERE id='$AdminId'";
		}
		
	
		$Execute = $ConnectingDB->query($sql);

		move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);


		if($Execute){
			$_SESSION["SuccessMessage"]="Details updated successfuly";
			Redirect_to("MyProfile.php");
		}else{
			$_SESSION["ErrorMessage"]= "Something went wrong. Try again !";
 	        Redirect_to("MyProfile.php");

		}

	}
}
  ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width= , initial-scale=1.0">
 	<meta http-equiv="X-UA-Compatible" content="ie=edge">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 	<link rel="stylesheet" href="CSS/styles.css">
 	<title>My Profile</title>
 </head>
 <body>

 <!--navbar</!-->

 <div style="height: 10px; background: #27aae1;"></div>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 	<div class="container" >
 		<a href="#" class="navbar-brand">NEUON AI</a>
 		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
 			<span class="navbar-toggler-icon"></span>
 		</button>
 		<div class="collapse navbar-collapse" id="navbarcollapseCMS">
 		<ul class="navbar-nav mr-auto">
 			<li class="nav-item">
 				<a href="MyProfile.php" class="nav-link "><i class="fas fa-user text-success"></i> My Profile</a>
 			</li>
 			<li class="nav-item">
 				<a href="Dashboard.php" class="nav-link ">Dashboard</a>
 			</li>
 			<li class="nav-item">
 				<a href="Posts.php" class="nav-link ">Posts</a>
 			</li>
 			<li class="nav-item">
 				<a href="Categories.php" class="nav-link ">Categories</a>
 			</li>
 			<li class="nav-item">
 				<a href="Admins.php" class="nav-link ">Manage Admins</a>
 			</li>
 			<li class="nav-item">
 				<a href="Comments.php" class="nav-link ">Comments</a>
 			</li>
 			<li class="nav-item">
 				<a href="Blog.php?page=1 " class="nav-link ">Live Blogs</a>
 			</li>
 		</ul>
 		<ul>
 			<li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i>Logout</a></li>
 		</ul>


 		
 		</div>
 	</div>
 </nav>
 <div style="height: 10px; background: #27aae1;"></div>
<!-- NAVABR END -->

<!-- HEADER -->
<header class="bg-dark text-white py-3">
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1><i class="fas fa-user text-success mr-2" style="color: #27aae1"></i>@<?php echo $ExistingUsername;?></h1>
		<small><?php echo $ExistingHeadline?></small>
	</div>
	</div>
</div>

</header>

<!-- HEADER END --> 


<!-- Main Area -->
<section>
	<div class="container py-2 mb-4">
		<div class="row">
			<!-- left area -->
			<div class="col-md-3">
				<div class="card">
					<div class="card-header bg-dark text-light">
						<h3><?php echo $ExistingName;?></h3>
						
					</div>
					<div class="card-body">
						<img src="images/<?php echo $ExistingImage;?>" class="block img-fluid mb-3" alt="">
						<div class=""> 
							<?php echo $ExistingBio;?>
						</div>
					</div>
				</div>
			</div>
			<!-- right area -->
			<div class="col-lg-9" style="min-height: 400px;">
				<?php 
					echo ErrorMessage();
					echo SuccessMessage();

				?>
				<form class="" action="MyProfile.php" method="post" enctype="multipart/form-data">
					<div class="card bg-dark text-light">
						<div class="card-header bg-secondary text-light ">
							<h4>Edit Profile</h4>
						</div>
						
						<div class="card-body ">
							<div class="form-group">
								
								<input class="form-control" type="text" name="Name" id="title" placeholder="Your name" value="">
								
							</div>

							<div class="form-group">
								
								<input class="form-control" type="text" name="Headline" id="title" placeholder="Headline" >
								<small class="text-muted">Add a Professional headline like, 'Enginner' at XYZ or 'Architect'</small>
									<span class="text-danger">Not more than 30 characters</span>
							</div>

								<div class="form-group">
								
								<textarea placeholder="Bio" class="form-control" name="Bio" id="Post" cols="80" rows="8"></textarea>
							</div>

						
							<div class="form-group">
								
								<div class="custom-file">
								<input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
								<label for="imageSelect" class="custom-file-label">Select Image </label>
								</div>
							</div>

						

							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-success btn-block"><i class="fas fa-check"></i>  Publish</button>
								</div>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</section>


<!-- Main area Ends -->

<!-- FOOTER -->

<footer class="bg-dark text-white">
	<div class="container">
		<div class="row">
			<div class="col">
			<p class="lead text-center">Theme By | Neuon AI | <span id="year"></span> &copy; ----All right reserved.</p>
			<p class="text-center small"><a style="color: white; text-decoration: none;cursor: pointer;" href="https://neuon.ai/" target="_blank">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque dolor commodi, error molestiae consectetur <br>&trade; neuon.ai &trade; UNIMAS</a></p>
			</div>
		</div>
	</div>
</footer>
 <div style="height: 10px; background: #27aae1;"></div>





 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
	$('#year').text(new Date().getFullYear());
</script>
 	
 </body>
 </html>