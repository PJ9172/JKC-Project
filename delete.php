<?php
$servername = "localhost";
$username = "root";
$password = "";
$database= "mysql";
$conn = mysqli_connect($servername,$username,$password,$database);
// Check connection
if(!$conn){
    die("ERROR: Could not connect. "
        . mysqli_error($conn));
}
$id = $_GET["id"];
$sql = "DELETE FROM `teachers` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}