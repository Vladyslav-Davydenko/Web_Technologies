<?php
require_once('lib/tpl.class.php');

const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH. "/about_tpl.php");

$navBar = file_get_contents("includes/navigation.html");
$footer = file_get_contents("includes/footer.html");
$head = file_get_contents("includes/head.html");
$info = '<div class="main-about">
<div class="about-post">
    <h3>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Dolorem perspiciatis totam libero id iure aut nisi eaque quasi explicabo ipsam iusto assumenda porro, 
        quibusdam quas beatae in doloribus. Sed, iste!
    </h3>
</div>
<div class="workers">
    <div class="about-post">
        <img class="about-img" src="img/avatars/kiril.jpg">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Dolorem perspiciatis totam libero id iure aut nisi eaque quasi explicabo ipsam iusto assumenda porro, 
            quibusdam quas beatae in doloribus. Sed, iste!
        </p>
    </div>
    <div class="about-post">
        <img class="about-img" src="img/avatars/Visl.jpg">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Dolorem perspiciatis totam libero id iure aut nisi eaque quasi explicabo ipsam iusto assumenda porro, 
            quibusdam quas beatae in doloribus. Sed, iste!
        </p>
    </div>
    <div class="about-post">
        <img class="about-img" src="img/avatars/masha.jpg">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Dolorem perspiciatis totam libero id iure aut nisi eaque quasi explicabo ipsam iusto assumenda porro, 
            quibusdam quas beatae in doloribus. Sed, iste!
        </p>
    </div>
</div>
</div>';

$t -> assign("title", "Travel Memories");
$t -> assign("navbar", $navBar);
$t -> assign("footer", $footer);
$t -> assign("head", $head);
$t -> assign("info", $info);
$output = $t->render(); 

echo $output;

?>