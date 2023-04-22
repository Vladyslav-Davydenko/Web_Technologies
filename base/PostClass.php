<?php

include_once "data/db_connection.php";
$link = mysqli_connect($server, $user, $password, $database);

class Post
{
    public string $title;
    public string $description;
    public int $likes;
    public string $owner;
    public string $owner_image;
    public int $created;
    public string $image;

    public function __construct(string $title, string $description, int $likes, string $owner, int $created, string $image, string $owner_image)
    {
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

    $query = "select P.*, U.ID, U.username, U.avatar from Post P inner join User U on P.owner = U.ID;";
    $query1 = "SELECT COUNT(*) AS num_likes FROM Likes WHERE user_id = 'your_user_id';";
    $result = mysqli_query($link, $query);
    $result1 = mysqli_query($link, $query1);
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $post = new Post($row["title"], $row["description"], (int)$row[2], (int)$row["owner"], (int)$row["created"], $row["image"], $row["avatar"]);
        $posts_list[] = $post;
    }

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], (int)$data[2], $data[3], (int)$data[4], $data[5], $data[6]);
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

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], (int)$data[2], $data[3], (int)$data[4], $data[5], $data[6]);
            $posts_list[] = $post;
        }
        fclose($handle);
    }

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

    return $r;
}

mysqli_close($link);
?>