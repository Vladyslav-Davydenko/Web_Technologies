<?php
require_once('lib/tpl.class.php');
require_once('PostClass.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/index_tpl.php");

$navBar = file_get_contents("navigation.html");

$footer = file_get_contents("footer.html");

$t -> assign("TITLE", "Travel Memories");
$t -> assign("NAVBAR", $navBar);
$t -> assign("FOOTER", $footer);
$t -> createPost("POSTS", getPosts());
$output = $t->render(); 

echo $output;

?>