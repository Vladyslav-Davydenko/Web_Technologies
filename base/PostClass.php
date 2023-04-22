<?php

include_once "data/db_connection.php";
$link = mysqli_connect($server, $user, $password, $database);

class Post
{
    public int $ID;
    public string $title;
    public string $description;
    public int $likes;
    public string $owner;
    public string $owner_image;
    public int $created;
    public string $image;

    public function __construct(int $ID, string $title, string $description, int $likes, string $owner, int $created, string $image, string $owner_image)
    {
        $this->ID = $ID;
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
            if ((stripos($post->title, $text) !== false) || (stripos($post->owner, $text) !== false)){
                $filteredPosts[] = $post;
            } 
        }
        return $filteredPosts;
    }
}

function getPosts($link)
{
    $posts_list = array();

    // $query = "select P.*, U.ID, U.username, U.avatar from Post P inner join User U on P.owner = U.ID;";
    
    // $result = mysqli_query($link, $query);
    
    // if(mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //         $query1 = mysqli_prepare($link, "SELECT COUNT(*) AS num_likes FROM Likes WHERE ownerID = '?' and postID = '?';");
    //         mysqli_stmt_bind_param($query1, "ii", $row["postID"], (int)$row["owner"]);
    //         mysqli_stmt_execute($query1);
    //         mysqli_stmt_bind_result($query1, $likes);
    //         echo $likes;
    //         while(mysqli_stmt_fetch($query1)) {
    //             $post = new Post($row["postID"], $row["title"], $row["description"], (int)$likes, (int)$row["owner"], (int)$row["created"], $row["image"], $row["avatar"]);
    //             $posts_list[] = $post;
    //         }
    //     }        
    //     mysqli_stmt_close($query1);
    //     mysqli_close($link);
    // }

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], $data[2], (int)$data[3], $data[4], (int)$data[5], $data[6], $data[7]);
            $posts_list[] = $post;
        }
        fclose($handle);
    }
    usort($posts_list, function ($a, $b) {
        return $a->created - $b->created;
    });
    $postActions = new PostActions;
    if (!empty($_GET['text'])) {
        $filtered_courses = $postActions->filteringData($_GET['text'], $posts_list);
    } else {
        $filtered_courses = $posts_list;
    }

    return $filtered_courses;
}

function getSinglePost($link)
{

    $posts_list = array();

    // $query = "select P.*, U.ID, U.username, U.avatar from Post P inner join User U on P.owner = U.ID;";
    
    // $result = mysqli_query($link, $query);
    
    // if(mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //         $query1 = mysqli_prepare($link, "SELECT COUNT(*) AS num_likes FROM Likes WHERE ownerID = '?' and postID = '?';");
    //         mysqli_stmt_bind_param($query1, "ii", $row["postID"], (int)$row["owner"]);
    //         mysqli_stmt_execute($query1);
    //         mysqli_stmt_bind_result($query1, $likes);
    //         echo $likes;
    //         while(mysqli_stmt_fetch($query1)) {
    //             $post = new Post($row["postID"], $row["title"], $row["description"], (int)$likes, (int)$row["owner"], (int)$row["created"], $row["image"], $row["avatar"]);
    //             $posts_list[] = $post;
    //         }
    //     }        
    //     mysqli_stmt_close($query1);
    //     mysqli_close($link);
    // }

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], $data[2], (int)$data[3], $data[4], (int)$data[5], $data[6], $data[7]);
            $posts_list[] = $post;
        }
        fclose($handle);
    }

    // $ID = '';
    // if(!empty($_GET['ID'])) {
    //     $ID = $_GET['ID'];
    // }
    // $r = array();
    // foreach ($posts_list as $post) {
    //     if (stripos($post->ID, $ID) !== FALSE) {
    //         $r[] = $post;
    //     }
    // }

    $title = '';
    if (!empty($_GET['title'])){
        $title = $_GET['title'];
    }
    $r = array();
    foreach ($posts_list as $post) {
        if (stripos($post->title, $title) !== FALSE) {
            $r[] = $post;
        }
    }
    mysqli_close($link);
    return $r;
}

mysqli_close($link);
?>