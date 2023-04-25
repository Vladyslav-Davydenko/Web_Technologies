<?php

session_start();
include_once "data/db_connection.php";
$link = mysqli_connect($server, $user, $password, $database);

class Post
{
    public int $postID;
    public string $title;
    public string $description;
    public int $likes;
    public string $owner;
    public string $owner_image;
    public int $created;
    public string $image;

    public function __construct(int $postID, string $title, string $description, int $likes, string $owner, int $created, string $image, string $owner_image)
    {
        $this->postID = $postID;
        $this->title = $title;
        $this->description = $description;
        $this->likes = $likes;
        $this->owner = $owner;
        $this->created = $created;
        $this->image = $image;
        $this->owner_image = $owner_image;
    }
}

class PostActions
{
    function filteringData($text, $posts)
    {
        $filteredPosts = array();
        foreach($posts as $post){
            if ((stripos($post->postID, $text) !== false) || (stripos($post->owner, $text) !== false)){
                $filteredPosts[] = $post;
            } 
        }
        return $filteredPosts;
    }
}

function getPosts($link) { // for index.php
    $posts_list = array();

    $query = mysqli_prepare($link, "SELECT P.postID, P.title, P.image, P.description, P.created, P.owner, U.ID, U.username, U.avatar FROM Post P INNER JOIN User U ON P.owner = U.ID;");
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $postID, $title, $image, $description, $created, $owner, $ID, $username, $avatar);

    while(mysqli_stmt_fetch($query)) {
        $queryLikes = mysqli_prepare($link, "SELECT COUNT(*) AS num_likes FROM Likes WHERE ownerID = '?' and postID = '?';");
        mysqli_stmt_bind_param($queryLikes, "ii", $ID, $postID);
        mysqli_stmt_execute($queryLikes);
        mysqli_stmt_bind_result($queryLikes, $likes);

        mysqli_stmt_fetch($queryLikes);
        $post = new Post($postID, $title, $description, (int)$likes, $username, (int)$created, $image, $avatar);
        $posts_list[] = $post;
    }

    mysqli_stmt_close($query);
    mysqli_stmt_close($queryLikes);
    mysqli_close($link);

    usort($posts_list, function ($a, $b) {
        return $a->created - $b->created;
    });

    $postActions = new PostActions;
    if (!empty($_SESSION['id'])) {
        $filtered_courses = $postActions->filteringData($_SESSION['id'], $posts_list);
    } else {
        $filtered_courses = $posts_list;
    }

    return $filtered_courses;
}

function getPostsForUser($link) { // for profile.php
    $posts_list = array();
    /*Check if it works for profile.php*/
    if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
        $ID = $_SESSION['id'];
        session_start();

        $query = mysqli_prepare($link, "SELECT P.postID, P.title, P.image, P.description, P.created, P.owner, U.ID, U.username, U.avatar FROM Post P INNER JOIN User U ON P.? = U.?;");
        mysqli_stmt_bind_param($query, 'ii', $ID, $ID);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $postID, $title, $image, $description, $created, $owner, $ID, $username, $avatar);

        while(mysqli_stmt_fetch($query)) {
            $queryLikes = mysqli_prepare($link, "SELECT COUNT(*) AS num_likes FROM Likes WHERE ownerID = '?' and postID = '?';");
            mysqli_stmt_bind_param($queryLikes, "ii", $ID, $postID);
            mysqli_stmt_execute($queryLikes);
            mysqli_stmt_bind_result($queryLikes, $likes);

            mysqli_stmt_fetch($queryLikes);
            $post = new Post($postID, $title, $description, (int)$likes, $username, (int)$created, $image, $avatar);
            $posts_list[] = $post;
        }

        mysqli_stmt_close($query);
        mysqli_stmt_close($queryLikes);
        mysqli_close($link);
    }

    // if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
    //     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    //         $post = new Post($data[0], $data[1], $data[2], (int)$data[3], $data[4], (int)$data[5], $data[6], $data[7]);
    //         $posts_list[] = $post;
    //     }
    //     fclose($handle);
    // }

    usort($posts_list, function ($a, $b) {
        return $a->created - $b->created;
    });

    $postActions = new PostActions;
    if (!empty($_SESSION['id'])) {
        $filtered_courses = $postActions->filteringData($_SESSION['id'], $posts_list);
    } else {
        $filtered_courses = $posts_list;
    }

    return $filtered_courses;
}

function getSinglePost($link) {
    $posts_list = array();

    $query = mysqli_prepare($link, "SELECT P.postID, P.title, P.image, P.description, P.created, P.owner, 
    U.ID, U.username, U.avatar FROM Post P INNER JOIN User U ON P.owner = U.ID AND P.postID = ?;");
    mysqli_stmt_bind_param($query, 'i', $_GET['id']);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $postID, $title, $image, $description, $created, $owner, $ID, $username, $avatar);
    while(mysqli_stmt_fetch($query)) {
        $query1 = mysqli_prepare($link, "SELECT COUNT(*) AS num_likes FROM Likes WHERE ownerID = '?' and postID = '?';");
            mysqli_stmt_bind_param($query1, "ii", (int)$owner, $postID);
            mysqli_stmt_execute($query1);
            mysqli_stmt_bind_result($query1, $likes);
            while(mysqli_stmt_fetch($query1)) {
                $post = new Post($postID, $title, $description, (int)$likes, $username, (int)$created, $image, $avatar);
                $posts_list[] = $post;
            }
    }       
    mysqli_stmt_close($query1);
    mysqli_close($link);

    // if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
    //     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    //         $post = new Post($data[0], $data[1], $data[2], (int)$data[3], $data[4], (int)$data[5], $data[6], $data[7]);
    //         $posts_list[] = $post;
    //     }
    //     fclose($handle);
    // }

    $ID = '';
    if(!empty($_GET['id'])) {
        $ID = $_GET['id'];
    }
    $r = array();
    foreach ($posts_list as $post) {
        if (stripos($post->postID, $ID) !== FALSE) {
            $r[] = $post;
        }
    }

    // $title = '';
    // if (!empty($_GET['title'])){
    //     $title = $_GET['title'];
    // }
    // $r = array();
    // foreach ($posts_list as $post) {
    //     if (stripos($post->title, $title) !== FALSE) {
    //         $r[] = $post;
    //     }
    // }

    mysqli_close($link);
    return $r;
}

?>