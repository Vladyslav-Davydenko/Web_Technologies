<?php
require_once('lib/tpl.class.php');
require_once('PostClass.php');
require_once('UserClass.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/profile_tpl.php");

$navBar = file_get_contents("navigation.html");

$footer = file_get_contents("footer.html");

$t -> assign("TITLE", "Travel Memories");
$t -> assign("NAVBAR", $navBar);
$t -> assign("FOOTER", $footer);
$t -> createPostProfile("POSTS", getPosts());
$t -> createProfileSideBar("SIDEBAR", getUser());
$output = $t->render(); 

echo $output;

?>