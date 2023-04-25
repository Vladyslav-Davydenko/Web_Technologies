<?php
require_once('lib/tpl.class.php');
require_once('base/PostClass.php');
require_once('base/UserClass.php');
require_once('data/db_connection.php');

$conn = mysqli_connect($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/profile_tpl.php");
echo "Hi";
$navBar = file_get_contents("includes/navigation.html");
$head = file_get_contents("includes/head.html");
$footer = file_get_contents("includes/footer.html");
echo "<script>console.log('Eblan0000')</script>";
$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
print_r(getPostsForUser($conn));
$t -> createProfileSideBar("sidebar", getUser($conn));
$t -> createPostProfile("posts", getPostsForUser($conn));
$t -> logInlogOutScript("script");
$output = $t->render(); 

echo $output;

?>