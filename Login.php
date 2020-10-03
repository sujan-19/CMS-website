 <?php require_once("includes/DB.php");?>
 <?php require_once("includes/Functions.php");?>
 <?php require_once("includes/Sessions.php");?>

<?php 
if(isset($_SESSION["UserId"])){
	Redirected_to("Dashboard.php");
}

if(isset($_POST["Submit"])){
	$UserName = $_POST["Username"];
	$Password = $_POST["Password"];
	if(empty($UserName)||empty($Password)){
		$_SESSION["ErrorMessage"]="All field must be filled out";
		Redirect_to("Login.php");
	}else{
		$Found_Account=Login_Attempt($UserName,$Password);
		if($Found_Account){
			$_SESSION["UserId"]= $Found_Account["id"];
			$_SESSION["UserName"]=$Found_Account["username"];
			$_SESSION["AdminName"]=$Found_Account["aname"];
			$_SESSION["SuccessMessage"]= "Wellcome ".$_SESSION["AdminName"]. "!";
			if (isset($_SESSION["TrackingURL"])) {
				Redirect_to($_SESSION["TrackingURL"]);
				# code...
			}else{
			Redirect_to("Dashboard.php");
		}
		}else{
			$_SESSION["ErrorMessage"]="Incorrect Username/Password";
			Redirect_to("Login.php");
		}


	}
}

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Login</title>
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
			
				</div>
				
			</div>
		</div>
	</div>
</header>
<br>

<!-- header ends -->

<!-- Main area starts -->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="offset-sm-3 col-sm-6" style="min-height: 500px;" >
			<br><br><br>
			<?php 
				echo ErrorMessage();   
				echo SuccessMessage();

			 ?>
						
			<div class="card bg-secondary text-light">
				<div class="card-header">
					<h4>Wellcome Back</h4>
					</div>
					<div class="card-body bg-dark">
						
					
					<form action="Login.php" method="post" class="">
						<div class="form-group">
							<label for="username"><span class="FieldInfo">Username:</span></label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" name="Username" id="username" value="">
							</div>
						</div>

						<div class="form-group">
							<label for="password"><span class="FieldInfo">Password:</span></label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
								</div>
								<input type="password" class="form-control" name="Password" id="password" value="">
							</div>
						</div>
						<input type="submit" name="Submit" class="btn btn-info btn-block" value="Login"> 
					</form>
				</div>
			</div>
		</div>
	</div>
	
</section>

<!-- Main Area ends -->

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