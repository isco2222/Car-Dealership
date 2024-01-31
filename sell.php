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
    if (isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phoneNO"]) && isset($_POST["email"]) && isset($_POST["vin"])
    && isset($_POST["date"]) && isset($_POST["price"])){

        $name = mysqli_real_escape_string($db, $_POST["name"]);
        $address = mysqli_real_escape_string($db, $_POST["address"]);
        $phoneNO = mysqli_real_escape_string($db, $_POST["phoneNO"]);
        $email = mysqli_real_escape_string($db, $_POST["email"]);
        $vin = mysqli_real_escape_string($db, $_POST["vin"]);
        $date = mysqli_real_escape_string($db, $_POST["date"]);
        $price = mysqli_real_escape_string($db, $_POST["price"]);

        ///////////////////////////////////////////////////////////////////////
        $sql = "INSERT INTO customer (CustomerName, Address, PhoneNumber, Email)
                        VALUES ('$name', '$address', '$phoneNO', '$email')";
        if (mysqli_query($db, $sql)){
            echo "<script>
                alert('New customer added');
                </script>";
                //header("location:admin.php");
        } else {
            echo "<script>
                alert('Somethong went wrong');
                window.open(admin.php);
                </script>";
        }
        /////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////
        $soldd = $db->prepare('SELECT Make, Model, theYear, Miles FROM carinventory WHERE VIN = ?');
        $soldd->bind_param('s', $_POST["vin"]);
        $soldd->execute();
        $soldd->bind_result($make, $model, $year, $miles);
        $soldd->fetch();
        $soldd->close();

        $sql1 = "INSERT INTO sold VALUES ('$make', '$model', '$year', '$vin', '$miles')";
        if (mysqli_query($db, $sql1)){
            echo "<script>
                alert('Car sold');
                </script>";
                //header("location:admin.php");
        } else {
            echo "<script>
                alert('Somethong went wrong');
                window.open(admin.php);
                </script>";
        }
        /////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////
        $cust = $db->prepare('SELECT CustomerID FROM customer WHERE Email = ?');
        $cust->bind_param('i', $_POST["email"]);
        $cust->execute();
        $cust->bind_result($customerid);
        $cust->fetch();
        $cust->close();
        //$sell = ('Sold');
        $id = $_SESSION['id'];

        $sql2 = "INSERT INTO transactions (CustomerID, EmployeeID, VIN, Thedate, SoB, Price)
                        VALUES ('$customerid', '$id', '$vin', '$date', 'Sold', '$price')";

        if (mysqli_query($db, $sql2)){
            echo "<script>
                alert('New transaction added');
                </script>";
                //header("location:admin.php");
        } else {
            echo "<script>
                alert('Somethong went wrong');
                window.open(admin.php);
                </script>";
        }
        ////////////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////////
        $sql3 = "DELETE FROM carinventory WHERE VIN = '$vin' ";

        if (mysqli_query($db, $sql3)){
            echo "<script>
                alert('New employee droppted');
                </script>";
                header("location:admin.php");
        } else {
            echo "<script>
                alert('Employee does not exits');
                window.open(admin.php);
                </script>";
        }
        /////////////////////////////////////////////////////////////////////////////
    }
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
            <form action="sell.php" method="post">
                Enter sell information:<br>
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name= "address" placeholder="Address" required>
                <input type="tel" name="phoneNO" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="vin" placeholder="VIN" required>
                <input type="date" name="date" placeholder="Date" required>
                <input type="text" name="price" placeholder="Final Price" required>
                <input type="submit" name ="submit_button">
            </form>
        </div>

    </body>
</html>

