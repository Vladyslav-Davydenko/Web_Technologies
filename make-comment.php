<?php 
    if (isset($_GET['text-comment'], $_GET['title-comment'])) {
        $file = fopen("data/comments.csv", "a+");
        $comment_data = array($_GET['title-comment'], $_GET['text-comment'], "Vilsivul", "img/avatars/Visl.jpg", "1", );
        fputcsv($file, $comment_data, ";");
        header("Refresh:0; url=single_post.php?title=$comment_data[0]");
    }
?>