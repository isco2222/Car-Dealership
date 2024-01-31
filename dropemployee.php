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
    if (isset($_POST['searchid'])){

        $searchid = mysqli_real_escape_string($db, $_POST["searchid"]);

        $sql = "DELETE FROM employee WHERE EmployeeID = '$searchid' ";

        if (mysqli_query($db, $sql)){
            echo "<script>
                alert('New employee droppted');
                </script>";
                header("location:administration.php");
        } else {
            echo "<script>
                alert('Employee does not exits');
                window.open(administration.php);
                </script>";
        }
    }
} 
?>

<html>
   <head>
      <title>Drop Employee</title>
      
      <style type = "text/css">
    img {
        display: block;
        margin: 0 auto;
    }
    
        h1,h2 {
        text-align: center;
    }
</style>
      
<img src="logo3.png" alt="Logo" width="500" height="150">
      
   </head>

    <h1>CarDealerShip Management</h1>
    <h2>Drop employee file</h2>
    
    
<body>
<form action="dropemployee.php" method="post">
  Enter EmployeeID:<br>
  <input type="text" name="searchid" placeholder="EmployeeID" required>
  <input type="submit" name ="submit_button">
</form>

</body>
</html>