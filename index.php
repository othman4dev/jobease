<?php 
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>

	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<header>


		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">
					<i class="fas fa-code"></i>
					<h1>JobEase &nbsp &nbsp</h1>
				</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="notes.php">Notifications</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								language
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">FR</a>
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</li>
						<span class="nav-item active">
							<a class="nav-link" href="#">EN</a>
						</span>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<section action="#" method="get" class="search">
		<h2>Find Your Dream Job</h2>
		<form class="form-inline" method="POST">
			<div class="form-group mb-2">
				<input type="text" name="keywords" id="search" placeholder="Keywords" onkeyup="ajaxSearch()">
			</div>
			<button type="submit" class="btn btn-primary mb-2">Search</button>
		</form>
	</section>

	<!--------------------------  card  --------------------->
	<section class="light">
		<h2 class="text-center py-3">Latest Job Listings</h2>
		<div class="container py-2" id="main-body">
			<?php
			$sql;
			if (isset($_GET['all'])) {
				$sql = "SELECT * FROM offers WHERE status = 'Active'";
			} else {
				$sql = "SELECT * FROM offers WHERE status = 'Active' LIMIT 2";
			}
			$result = mysqli_query($connection, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<article class="postcard light red">
					<a class="postcard__img_link" href="#">
						<img class="postcard__img" src="<?php echo 'dashboard/'. $row['target'] ?>"alt="Image Title" onerror="this.src = 'dashboard/img/default.jpg'"/>
					</a>
					<div class="postcard__text t-dark">
						<h3 class="postcard__title red"><a href="#"><?php echo $row['title']; ?></a></h3>
						<div class="postcard__subtitle small">
							<time datetime="2020-05-25">
								<i class="fas fa-calendar-alt mr-2"></i><?php echo date('Y-m-d', strtotime($row['created_at'])); ?>
							</time>
						</div>
						<div class="postcard__bar"></div>
						<div class="postcard__preview-txt"><?php echo $row['description']; ?></div>
						<ul class="postcard__tagbox">
							<li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $row['location']; ?></li>
							<li class="tag__item"><i class="fas fa-clock mr-2"></i><?php echo $row['salary']; ?>$</li>
							<li class="tag__item play red">
								<?php 
								$sqlcode2 = "SELECT * FROM postules WHERE user_id = ".$_SESSION['id']." AND offer_id = ".$row['id']."";
								$result2 = mysqli_query($connection, $sqlcode2);
								if (mysqli_num_rows($result2) > 0) {
									while ($row2 = mysqli_fetch_assoc($result2)) {
										echo "<a><i class='fas fa-play mr-2'><span style='color:red'>You already applied for this job</span></i>";
									}
								} else {
									echo "<a href='apply.php?id=".$row['id']."'><i class='fas fa-play mr-2'>Apply now</i>";
								}
								?></a>
							</li>
						</ul>
					</div>
				</article>
			<?php }
			?>
		</div>
		<div class="text-center" style="margin:15px;">
			<a href="index.php?all=1" class="btn btn-primary">See All Offers</a>
		</div>
	</section>
	
	<!-- Error Modal -->
	<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="errorModalLabel">Error</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?php echo urldecode($_GET['error']) ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="successModalLabel">Success</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><?php echo urldecode($_GET['good']) ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php 
	if (isset($_GET['error'])) {
		echo "<script>$('#errorModal').modal('show');</script>";
	} else if (isset($_GET['success'])) {
		echo "<script>$('#successModal').modal('show');</script>";
	}
?>
	<footer>
		<p>© 2023 JobEase </p>
	</footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
<?php 
	if (isset($_GET['error'])) {
		echo "<script>$('#errorModal').modal('show');</script>";
	}
	?>
<script>
	function ajaxSearch() {
		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				document.querySelector('#main-body').innerHTML = this.responseText;
				console.log(this.responseText);
			}
		};
		let Data = {
			"keywords": document.querySelector('#search').value
		};
		xhttp.open("POST", "search.php?keywords="+ document.querySelector('#search').value, true);
		xhttp.send();
	}
</script>