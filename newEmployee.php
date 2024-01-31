<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'dealership';
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


if (isset($_POST['submit_button'])){
    if (isset($_POST['password']) && isset($_POST["name"]) && isset($_POST["gender"]) && isset($_POST["address"]) 
    && isset($_POST["phoneNO"]) && isset($_POST["position"]) && isset($_POST["salary"]) && isset($_POST["email"])){

        $password = mysqli_real_escape_string($db, $_POST["password"]);
        $name = mysqli_real_escape_string($db, $_POST["name"]);
        $gender = mysqli_real_escape_string($db, $_POST["gender"]);
        $address = mysqli_real_escape_string($db, $_POST["address"]);
        $phoneNO = mysqli_real_escape_string($db, $_POST["phoneNO"]);
        $position = mysqli_real_escape_string($db, $_POST["position"]);
        $salary = mysqli_real_escape_string($db, $_POST["salary"]);
        $email = mysqli_real_escape_string($db, $_POST["email"]);

        $sql = "INSERT INTO employee (Password, EmployeeName, Gender, Address, PhoneNumber, Position, Salary, Email)
                VALUES ('$password', '$name', '$gender', '$address', '$phoneNO', '$position', '$salary', '$email')";

        if (mysqli_query($db, $sql)){
            echo "<script>
                alert('New employee added');
                </script>";
                header("location:admin.php");
        } else {
            echo "<script>
                alert('Employee already exits');
                window.open(admin.php);
                </script>";
        }
    }
} 
?>

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
            <form action="newEmployee.php" method="post">
            Enter new hire information:<br>
            <input type="password" name="password" placeholder="********" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="radio" name="gender" value="Female" required>Female
            <input type="radio" name="gender" value="Male" required>Male
            <input type="text" name= "address" placeholder="Address" required>
            <input type="tel" name="phoneNO" placeholder="Phone Number" required>
            <input type="radio" name="position" value="CEO" required>CEO
            <input type="radio" name="position" value="Manager" required>Manager
            <input type="radio" name="position" value="Salesman" required>Salesman
            <input type="radio" name="position" value="Assistanr" required>Assistanr
            <input type="text" name="salary" placeholder="Salary" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="submit" name ="submit_button">
            </form>
        </div>

</body>
</html>