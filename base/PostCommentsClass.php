<?php 

class PostComments 
{
        public int $postID;
        public int $ownerID;
        public string $commentText;
        public string $created;

    public function __construct(int $postID, int $ownerID, string $commentText, string $created) 
    {
        $this->postID = $postID;
        $this->ownerID = $ownerID;
        $this->commentText = $commentText;
        $this->created = $created;
    }
}

function getSinglePostComments() 
{
    $postCommentsList = array();
    include('data/db_connection.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
      $id = $_GET["id"];
      $stmt = $conn->prepare("SELECT * FROM Comment WHERE postID = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $postID = $row["postID"];
        $ownerID = $row["ownerID"];
        $commentText = $row["commentText"];
        $created = $row["created"];
        $comment = new PostComments($postID, $ownerID, $commentText, $created);
        $postCommentsList[] = $comment;
      }
    $stmt->close();
    return $postCommentsList;
}

function countSinglePostComments() 
{

    $commentsArray = getSinglePostComments();
    $counterForComments = count($commentsArray);

    return $counterForComments;
}

?>