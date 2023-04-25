<?php
session_start();
require_once('base/UserClass.php');

class Post
{
    public int $postID;
    public string $title;
    public string $description;
    public int $likes;
    public int $owner;
    public string $image;

    public function __construct(int $postID, string $title, string $description, int $likes, int $owner, string $image)
    {
        $this->postID = $postID;
        $this->title = $title;
        $this->description = $description;
        $this->likes = $likes;
        $this->owner = $owner;
        $this->image = $image;
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

    return $posts_list;
}

function getPostsForUser($conn) { // for profile.php
    $posts_list = array();
    if ($_SESSION['id'] == $_GET['username'] || !isset($_GET['username'])){
        $id = $_SESSION["id"];
    } else{
        $id = $_GET['username'];
    }
    $query = $conn->prepare("SELECT * FROM Post WHERE owner = $id");
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $post_data) {
        $postID = $post_data["postID"];
        $query = $conn->prepare("SELECT COUNT(*) AS num_likes FROM Likes WHERE postID = $postID");
        $query->execute();
        $likes = $query->fetchColumn();
        $title = $post_data["title"];
        $description = isset($post_data["description"]) ? $post_data["description"] : "";
        $image = isset($post_data["image"]) ? $post_data["image"] : "img/posts/default.jpg";
        $owner = $id;

        $post = new Post($postID, $title, $description, $likes, $owner, $image);
        $posts_list[] = $post;
    }
    return $posts_list;
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

    return $posts_list;
}

?>