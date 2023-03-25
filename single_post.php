<?php
require_once('lib/tpl.class.php');
require_once('config/PostClass.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/single_post_tpl.php");

$navBar = file_get_contents("includes/navigation.html");
$footer = file_get_contents("includes/footer.html");
$head = file_get_contents("includes/head.html");

$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
$t -> createSinglePost("single", getSinglePost());
$t -> createPostComments("comments", getSinglePost());
$output = $t->render(); 

echo $output;

?>