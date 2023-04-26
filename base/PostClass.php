<?php
session_start();
require_once('base/UserClass.php');

class Post
{
    public int $postID;
    public string $title;
    public string $description;
    public int $owner;
    public string $image;

    public function __construct(int $postID, string $title, string $description, int $owner, string $image)
    {
        $this->postID = $postID;
        $this->title = $title;
        $this->description = $description;
        $this->owner = $owner;
        $this->image = $image;
    }
}

function getPostsForUser() { 
    include('data/db_connection.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $posts_list = array();
    if ($_SESSION['id'] == $_GET['username'] || !isset($_GET['username'])){
        $id = $_SESSION["id"];
    } else{
        $id = $_GET['username'];
    }
      $id = $_SESSION["id"];
      $stmt = $conn->prepare("SELECT * FROM Post WHERE owner = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $postID = $row["postID"];
        $title = $row["title"];
        $description = isset($row["description"]) ? $row["description"] : "";
        $image = isset($row["image"]) ? $row["image"] : "img/posts/default.jpg";
        $owner = $id;

        $post = new Post($postID, $title, $description, $owner, $image);
        $posts_list[] = $post;
      }
      
    $stmt->close();
    return $posts_list;
    }


function getPosts() { 
    include('data/db_connection.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM Post");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $postID = $row["postID"];
        $title = $row["title"];
        $description = isset($row["description"]) ? $row["description"] : "";
        $image = isset($row["image"]) ? $row["image"] : "img/posts/default.jpg";
        $owner = $row["owner"];
        if(isset($_GET['text']) && strpos(strtolower($title), strtolower($_GET['text'])) !== false){
            $post = new Post($postID, $title, $description, $owner, $image);
            $posts_list[] = $post;
        }
        if(!isset($_GET['text'])){
            $post = new Post($postID, $title, $description, $owner, $image);
            $posts_list[] = $post;
        }
    }
    $stmt->close();
    return $posts_list;
}

function getSinglePost() {
    include('data/db_connection.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $_GET["id"];
    $stmt = $conn->prepare("SELECT * FROM Post WHERE postID = $id");
    $stmt->execute();
    $result = $stmt->get_result();
    $post_data = $result->fetch_assoc();
    $postID = $id;
    $title = $post_data["title"];
    $description = isset($post_data["description"]) ? $post_data["description"] : "";
    $image = isset($post_data["image"]) ? $post_data["image"] : "img/posts/default.jpg";
    $owner = $post_data["owner"];
    $post = new Post($postID, $title, $description, $owner, $image);
    return $post;
}

?>