
 <?php require_once("includes/DB.php");?>
 <?php require_once("includes/Functions.php");?>
 <?php require_once("includes/Sessions.php");?>
  <?php 
 
 
 //echo  $_SESSION["TrackingURL"];

Confirm_Login(); ?>

 <?php
 $SearchQueryParameter = $_GET["id"];


					global $ConnectingDB;
					
					$sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter' ";
					$stmt = $ConnectingDB->query($sql);
					while($DataRows=$stmt->fetch()){
						$TitleToBeDeleted = $DataRows['title'];
						$CategoryToBeDeleted = $DataRows['category'];
						$ImageToBeDeleted = $DataRows['image'];
						$PostToBeDeleted = $DataRows['post'];
					}
					/*echo $ImageToBeUpdated;*/
  
  if(isset($_POST["Submit"])){

		//queryt to delete post in DB everything
		global $ConnectingDB;
		$sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";
	
		$Execute = $ConnectingDB->query($sql);

		

		if($Execute){
			$Target_Path_To_Delete_Image = "uploads/$ImageToBeDeleted";
			unlink($Target_Path_To_Delete_Image);
			$_SESSION["SuccessMessage"]="Post deleted successfuly";
			Redirect_to("Posts.php");
		}else{
			$_SESSION["ErrorMessage"]= "Something went wrong. Try again !";
 	        Redirect_to("Posts.php");

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
 	<title>Delete Post</title>
 </head>
 <body>

 <!--navbar</!-->

 <div style="height: 10px; background: #27aae1;"></div>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 	<div class="container" >
 		<a href="#" class="navbar-brand">NEUON AI NEW</a>
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
		<h1><i class="fas fa-edit" style="color: #27aae1"></i> Delete Post</h1>
	</div>
	</div>
</div>

</header>

<!-- HEADER END --> 


<!-- Main Area -->
<section>
	<div class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
				<?php 
					echo ErrorMessage();
					echo SuccessMessage();

				

				?>
				<form class="" action="DeletePost.php?id=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light mb-3">
						
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Post Title:</span></label>
								<input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted;?>">
							</div>

							<div class="form-group">
								<span class="FieldInfo">Existing Category: </span>
								<?php echo $CategoryToBeDeleted;?>
								<br>

								
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Image: </span>
								<img src="uploads/<?php echo $ImageToBeDeleted;?>" width="170px"; height="70px"; >
								<br>
								
							
							</div>

							<div class="form-group">
								<label for="Post"><span class="FieldInfo">Post</span></label>
								<textarea disabled class="form-control" name="PostDescription" id="Post" cols="80" rows="8">
									<?php echo $PostToBeDeleted;?>
								</textarea>
							</div>

							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-danger btn-block"><i class="fas fa-trash"></i>  Delete</button>
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