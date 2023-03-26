<?php 

class PostComments 
{
        public string $title;
        public string $comment_desc;
        public string $comment_owner;
        public string $comment_owner_image;
        public int $comment_created;
    

    public function __construct(string $title, string $comment_desc, string $comment_owner, string $comment_owner_image, int $comment_created) 
    {
        $this->title = $title;
        $this->comment_desc = $comment_desc;
        $this->comment_owner = $comment_owner;
        $this->comment_owner_image = $comment_owner_image;
        $this->comment_created = $comment_created;
    }
}

class PostCommentsActions
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

function getSinglePostComments() 
{
    $postCommentsList = array();

    if (($handle = fopen("data/comments.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $postComments = new PostComments($data[0], $data[1], $data[2], $data[3], (int)$data[4]);
            $postCommentsList[] = $postComments;
        }
        fclose($handle);
    }

    $r = array();
    foreach($postCommentsList as $postComments) {
        if (stripos($postComments->title, $_GET['title']) !== FALSE) {
            $r[] = $postComments;
        }
    }

    usort($r, function ($a, $b) {
        return $a->comment_created - $b->comment_created;
    });

    return $r;
}

function countSinglePostComments() 
{

    $commentsArray = getSinglePostComments();
    $counterForComments = count($commentsArray);

    return $counterForComments;
}

?>