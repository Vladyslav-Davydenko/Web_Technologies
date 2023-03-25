<?php

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
            if (stripos($post->title, $text) !== false){
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

function getSinglePost()
{

    $posts_list = array();

    if (($handle = fopen("data/posts.csv", "r")) !== FALSE) {
        $nrows = count(file("data/posts.csv"));
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $post = new Post($data[0], $data[1], (int)$data[2], $data[3], (int)$data[4], $data[5], $data[6]);
            $posts_list[] = $post;
        }
        fclose($handle);

        for ($i = 0; $i < $nrows; $i++) {
            if (strpos($posts_list[$i], $_GET['title']) !== FALSE) {
                $single_post = $posts_list[$i];
            } else {
                continue;
            }
        }
    }

    return $single_post;
}
