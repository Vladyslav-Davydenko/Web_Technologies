<?php 

class Post{
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
            $filteredPosts = array_filter($posts, function($obj) use ($text) {
                return stripos($obj->title, $text) !== false;
            });
        usort($filteredPosts, function ($a, $b) {
            return $b->likes - $a->likes;
        });
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

    $postActions = new PostActions;
    if(!empty($_GET['text'])){
        $filtered_courses = $postActions->filteringData($_GET['text'], $posts_list);
    } else{
        $filtered_courses = $posts_list;
    }

    return $filtered_courses;
}

?>