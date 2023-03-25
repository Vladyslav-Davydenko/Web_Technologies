<?php

class Post
{
    public string $title;
    public string $description;
    public int $likes;
    public int $comments;  // added field for number of comments into a class Post
    public string $owner;
    public string $owner_image;
    public int $created;
    public string $image;

    public function __construct(string $title, string $description, int $likes, string $owner, int $created, string $image, string $owner_image, int $comments)
    {
        $this->title = $title;
        $this->description = $description;
        $this->likes = $likes;
        $this->owner = $owner;
        $this->created = $created;
        $this->image = $image;
        $this->owner_image = $owner_image;
        $this->comments = $comments;
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

function getPosts()
{
    $posts_list = array();

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], (int)$data[2], $data[3], (int)$data[4], $data[5], $data[6], (int)$data[7]);
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

function getSinglePost()
{

    $posts_list = array();

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], (int)$data[2], $data[3], (int)$data[4], $data[5], $data[6], (int)$data[7]);
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

?>