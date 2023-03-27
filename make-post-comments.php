<?php 
    if ($_GET && isset($_GET['text-comment'], $_GET['title-comment'])) {
        $file = fopen("data/comments.csv", "a+");
        $comment_data = array($_GET['title-comment'], $_GET['text-comment'], "Vilsivul", "img/avatars/Visl.jpg", "1", );
        fputcsv($file, $comment_data, ";");
        header("Refresh:0; url=single_post.php?title=$comment_data[0]");
    }

    if ($_POST && isset($_FILES['myfile'], $_POST['title-of-post'], $_POST['post-desc'])) {
        $file = fopen("data/posts.csv", "a+");

        $target_dir = "img/posts/";
        $target_file = $target_dir.$_FILES['myfile']['name'];

        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $target_file)) {
            $new_post_data = array($_POST['title-of-post'], $_POST['post-desc'], "0", "Vilsivul", "0", $target_file, "img/avatars/Visl.jpg");
            fputcsv($file, $new_post_data, ";");
            header("Refresh:0; url=profile.php?username=Vilsivul");
        }

    }
?>