<?php
if (isset($_POST['myfile'])) {

    $myfile = $_POST['myfile'];
    $location = $_POST['title-of-post'];
    $description = $_POST['post-desc'];
    $errors[] = "";

    if (file_exists($myfile)) {

    } else {
        $error[] = "File is required";
    }

    if (empty($errors)) {
        $data = array(
            $_POST['myfile'],
            $_POST['title-of-post'],
            $_POST['post-desc']
        );

        $dataFile = fopen('./data/posts.csv', 'a');
        fputcsv($dataFile, $data, ';');
        fclose($dataFile);

    }

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
            <form action="make-post-comments.php" method="POST" enctype="multipart/form-data">
                <div class="box" id="image-preview">
                    <h2 class="select-photo" id="h2">Select a photo</h2>
                    <input type="file" id="file-input" name="myfile" required />
                </div>
                <div class="input-box">
                    <input type="text" name="title-of-post" id="title-of-post" placeholder="Add your Location">
                </div>
                <div class="input-box">
                    <input type="text" name="post-desc" id="post-desc" placeholder="Add description">
                </div>
                <button type="submit" class="submit-but">Add to Profile</button>
            </form>
            <a href="profile.php"><button type="button" class="submit-but">Back Home</button></a>
        </div>
    </div>
    <script src="./make-post.js"></script>
</body>