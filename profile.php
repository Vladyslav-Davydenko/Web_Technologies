<?php
require_once('lib/tpl.class.php');
require_once('config/PostClass.php');
require_once('config/UserClass.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/profile_tpl.php");

$navBar = file_get_contents("includes/navigation.html");
$head = file_get_contents("includes/head.html");
$footer = file_get_contents("includes/footer.html");

$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
$t -> createPostProfile("posts", getPosts());
$t -> createProfileSideBar("sidebar", getUser());
$output = $t->render(); 

echo $output;

?>