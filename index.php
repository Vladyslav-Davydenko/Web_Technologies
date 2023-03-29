<?php
require_once('lib/tpl.class.php');
require_once('base/PostClass.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/index_tpl.php");

$navBar = file_get_contents("includes/navigation.html");
$footer = file_get_contents("includes/footer.html");
$head = file_get_contents("includes/head.html");

$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
$t -> createPost("posts", getPosts());
$output = $t->render(); 

echo $output;

?>