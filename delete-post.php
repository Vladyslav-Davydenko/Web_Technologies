<?php 
include('data/db_connection.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
	$conn = mysqli_connect($server, $user, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$id = $_GET['id'];
	$sql = "DELETE FROM Post WHERE postID = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt); 
}
header('Location: profile.php');


?>