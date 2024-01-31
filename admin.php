<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>CarDealerShip DB Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<center><img src="logo3.png" alt="Logo" width="250" height="75"></center><h2>Admin Page</h2>
			<p><?=$_SESSION['name']?>!</p>
		</div>
		<div>
			<button type="button" style="margin:auto;display:block" onclick="addNewEmployee()">New Employee</button>
     		<br>
     		<button type="button" style="margin:auto;display:block" onclick="dropEmployee()">Drop Employee</button>
			<br>
			<button type="button" style="margin:auto;display:block" onclick="sell()">Make a sell</button>
		</div>



		<script>
			function addNewEmployee() {
				window.open("newEmployee.php");
			}

			function dropEmployee() {
				window.open("dropemployee.php");
			}

			function transactionSearch() {
				window.open("transactionSearch.php");
			}

			function sell() {
				window.open("sell.php");
			}
		</script> 
	</body>
</html>