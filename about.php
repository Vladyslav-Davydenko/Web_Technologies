<?php
require_once('lib/tpl.class.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/about_tpl.php");

$navBar = file_get_contents("includes/navigation.html");
$footer = file_get_contents("includes/footer.html");
$head = file_get_contents("includes/head.html");

$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
$t -> createAboutPost("info");
$output = $t->render(); 

echo $output;

?>