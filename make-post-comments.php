<?php 
require_once('data/db_connection.php');

$conn = mysqli_connect($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (($_SERVER['REQUEST_METHOD'] === 'GET') && isset($_GET['commentText']) && isset($_GET['commentPostID'])) {
    $commentText = $_GET['commentText'];
    $postID = $_GET['commentPostID'];
    $created = date('Y-m-d');
    if(!isset($_SESSION['id'])){
        echo "<script>window.location.href='login.php';</script>";
    }
    $ownerID = $_SESSION['id'];
    // Writing into DB
    $sql = "INSERT INTO Comment (postID, ownerID, commentText, created) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $postID, $ownerID, $commentText, $created);
    mysqli_stmt_execute($stmt);
    echo "<script>window.location.href='single_post.php?id=". $postID ."';</script>";
}
?>