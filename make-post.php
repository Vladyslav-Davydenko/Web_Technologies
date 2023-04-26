<?php
include('data/db_connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect($server, $user, $password, $database);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
    $title = $_POST["title-of-post"];
    $description = $_POST["post-desc"];
    $image = "img/posts/default.jpg";
    if (isset($_FILES['file-input']) && $_FILES['file-input']['error'] == UPLOAD_ERR_OK) {
      $uploaded_file = $_FILES['file-input']['tmp_name'];
      $destination = 'img/posts/'. mysqli_insert_id($conn) .'.jpg';

      if (move_uploaded_file($uploaded_file, $destination)) {
        $image = $destination;
      }  
  }

    $user = $_SESSION["id"];
    // Writing into DB
    $sql = "INSERT INTO Post (title, image, description, owner) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $image, $description, $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>window.location.href='profile.php';</script>";

   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap"
        rel="stylesheet">
    <title>Make post</title>
</head>

<body>
    <div class="conteiner">
        <button type="submit" class="butt">Create New Post</button>
        <div class="pop">
            <form method="POST" enctype="multipart/form-data">
                <div class="box" id="image-preview">
                    <h2 class="select-photo" id="h2">Select a photo</h2>
                    <input type="file" id="file-input" name="myfile" accept="image/png, image/jpg, image/jpeg"/>
                </div>
                <div class="input-box">
                    <input type="text" name="title-of-post" id="title-of-post" placeholder="Add your Location">
                </div>
                <div class="input-box">
                    <input type="text" name="post-desc" id="post-desc" placeholder="Add description">
                </div>
                <button type="submit" class="submit-but" id="addToProfile">Add to Profile</button>
            </form>
            <a href="profile.php"><button type="button" class="submit-but">Back Home</button></a>
        </div>
    </div>
    <script src="scripts/make-post.js"></script>
</body>