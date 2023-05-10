<?php 
require_once('data/db_connection.php');

$conn = mysqli_connect($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if(isset($_SESSION['id'])){
    if (($_SERVER['REQUEST_METHOD'] === 'GET') && isset($_GET['commentText']) && isset($_GET['commentPostID'])) {
        $commentText = $_GET['commentText'];
        $postID = $_GET['commentPostID'];
        $ownerID = $_SESSION['id'];
        $created = date('Y-m-d');
        // Writing into DB
        $sql = "INSERT INTO Comment (postID, ownerID, commentText, created) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiss", $postID, $ownerID, $commentText, $created);
        mysqli_stmt_execute($stmt);
        header('Location: single_post.php?id=' . $postID);
    }
}
else{
    header('Location: login.php');
}

?>