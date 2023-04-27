<?php


class Template
{
    public $assignedValues = array();
    public $tpl;

    function __construct($filename = "")
    {
        if (!empty($filename)) {
            if (file_exists($filename)) {
                $this->tpl = file_get_contents($filename);
            } else {
                exit("ERROR: template file not found!");
            }
        }
    }

    function assign($searchFor, $replaceWith)
    {
        if (!empty($searchFor)) {
            $this->assignedValues[strtoupper($searchFor)] = $replaceWith;
        }
    }
    function createPost($searchFor, $replaceWith)
    {
        include('data/db_connection.php');
        $conn = mysqli_connect($server, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $singlePost = '<div class="main-page">
        <div class="posts-home">';
        if (!empty($searchFor)) {
            if (!empty($replaceWith)) {
                $rows = count($replaceWith);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $id = $replaceWith[$i]->owner;
                        $stmt = $conn->prepare("SELECT * FROM User WHERE ID = $id");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user_data = $result->fetch_assoc();
                        $singlePost .= ' <div class="single-post">
                        <a href="single_post.php?id=' . $replaceWith[$i]->postID . '"><img src="' . $replaceWith[$i]->image . '"></a>
                        <div class="post-text">
                            <div class="post-author">
                                <div class="post-author-img">
                                    <a href="profile.php?username=' . $user_data["ID"] . '"><img class="avatar-small" src="' . $user_data["avatar"] . '"></a>
                                </div>
                                <div class="post-author-text">
                                    <a href="profile.php?username=' . $user_data["ID"] . '">
                                        <h4>' . $user_data["username"] . '</h4>
                                    </a>
                                </div>
                            </div>
                            <h3>' . $replaceWith[$i]->title . '</h3>
                            <div class="detail-info-post">
                                <p>' . $replaceWith[$i]->description . '
                                </p>
                            </div>
                            <h4>'.$replaceWith[$i]->created.'</h4>
                        </div>
                    </div>';
                    $stmt->close();
                    }
                }
            }
        }
        $singlePost .= '</div>
            </div>';
        $this->assign($searchFor, $singlePost);
    }

    function createPostProfile($searchFor, $replaceWith)
    {
        $profilePost = '';
        if (!empty($searchFor)) {
            if (!empty($replaceWith)) {
                $rows = count($replaceWith);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $profilePost .= '<div class="single-post">
                        <a href="single_post.php?id='.$replaceWith[$i]->postID.'"><img src="' . $replaceWith[$i]->image . '"></a>
                        <div class="post-text">
                        <form action="submit.php" method="post">
                            <h3>' . $replaceWith[$i]->title . '</h3>
                            <p>
                            ' . $replaceWith[$i]->description . '
                            </p>
                            <h4>'.$replaceWith[$i]->created.'</h4>
                        </div>
                    </div>';
                    }
                }
            }
        }
        $this->assign($searchFor, $profilePost);
    }

    function createProfileSideBar($searchFor, $replaceWith)
    {
        $sidebar = '';
        if (!empty($searchFor)) {
            if (!empty($replaceWith)) {
                $sidebar .= '
                <div class="profile-side-bar">
                    <img class="avatar" src="' . $replaceWith->avatar . '">
                    <h3>' . $replaceWith->username . '</h3>
                    <p class="profile-text">' . $replaceWith->bio . '</p>
                    <ul class="prof-social">';
                    if($replaceWith->social != ""){
                        $sidebar .= '<li>
                        <a title="Blog" href="' . $replaceWith->social . '" target="_blank"><i class="fa fa-globe"></i></a>
                        </li>';
                    }
                    if($replaceWith->twitter != ""){
                        $sidebar .= '<li>
                        <a title="Twitter" href="' . $replaceWith->twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>';
                    }
                    if($replaceWith->facebook != ""){
                        $sidebar .= '<li>
                        <a title="Facebook" href="' . $replaceWith->facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>';
                    }
                    if($replaceWith->instagram != ""){
                        $sidebar .= '<li>
                        <a title="Instagram" href="' . $replaceWith->instagram . '" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>';
                    }       
                    
                $sidebar .= '</ul>
                </div>
                <div class="create-btn">
                    <a href="make-post.php">
                    <input class="btn" type="submit" value="&#43 Add New Post" />
                    </a>
                </div>
                <div class="create-btn">
                    <a href="edit_form.php">
                    <input class="btn" type="submit" value="Edit Your Profile" />
                    </a>
                </div>';
            }
            $this->assign($searchFor, $sidebar);
        }
    }


    function createAboutPost($searchFor)
    {
        $infoAbout = '';
        if (!empty($searchFor)) {
            $infoAbout .= '
                <div class="main-about">
                <div class="about-post">
                    <h3>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolorem perspiciatis totam libero id iure aut nisi eaque quasi explicabo ipsam iusto assumenda porro, 
                        quibusdam quas beatae in doloribus. Sed, iste!
                    </h3>
                </div>
                <div class="workers">
                    <div class="about-post">
                        <img class="about-img" src="img/avatars/kirill.jpg">
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
        }
        $this->assign($searchFor, $infoAbout);
    }

    function createSinglePost($searchFor, $replaceWith) {
        include('data/db_connection.php');
        $conn = mysqli_connect($server, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $singlePost = '';
        if(!empty($searchFor)) {
            if(!empty($replaceWith)) {
                $id = $replaceWith->owner;
                $stmt = $conn->prepare("SELECT * FROM User WHERE ID = $id");
                $stmt->execute();
                $result = $stmt->get_result();
                $user_data = $result->fetch_assoc();

                $statement = $conn->prepare("SELECT COUNT(*) AS numComments FROM Comment WHERE postID = ?;");
                $statement->bind_param("i", $replaceWith->postID);
                $statement->execute();
                $output = $statement->get_result();
                $counterComments = $output->fetch_assoc();

                $singlePost .= '<div class="single-post-kiril">
                <div class="post-header">
                    <div class="post-meta"><span class="author">'.$user_data["username"].'</span><br>
                    <div class="post-meta"><span class="author">'.$replaceWith->created.'</span><br>
                </div>
                    <h2 class="post-title">'.$replaceWith->title.'</h2>
                    <div class="post-image-single">
                        <img src="'.$replaceWith->image.'">
                    </div>
                </div>
                <div class="post-body">
                    <div class="entry-desc">
                        <p>'.$replaceWith->description.'</p>
                    </div>
                </div>
                <div class="post-image-reply-section">
                        <div class="post-like">
                        <span class="number-of-likes"></span>
                        <button class="post-like-button"><i class="fa fa-heart" aria-hidden="true"></i></button>
                        <span class="number-of-comments">'.$counterComments["numComments"].'</span>
                        <a class="post-comment-button"><i class="fa fa-comment"></i></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="comment-section">
                <form class="form-for-comment" method="get" action="make-post-comments.php" id="createPostComment">
                    <div class="form-field-comment">
                        <input type="textarea" cols="90" rows="15" id="commentText" name="commentText" class="input-text-comment" placeholder="Enter your Comment">
                        <input type="hidden" name="commentPostID" id="commentPostID" value="'.$replaceWith->postID.'">
                    </div>
                    <input class="btn" type="submit" value="Send a Comment" />
                </form>
            </div>';
            }
        }
        mysqli_close($conn);
        $this -> assign($searchFor, $singlePost);
    }
    
    function createPostComments($searchFor, $replaceWith) {
        include('data/db_connection.php');
        $conn = mysqli_connect($server, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $commentInfo = '';
        if(!empty($searchFor)) {
            if(!empty($replaceWith)) {
                    foreach($replaceWith as $comment) {
                        if (!empty($_GET['id'])) {
                            $id = $_GET['id'];
                        } else {
                            echo "<script>window.location.href='index.php';</script>";
                        }
                        $ownerID = $comment->ownerID;
                        $stmt = $conn->prepare("SELECT * FROM User WHERE ID = $ownerID");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user_data = $result->fetch_assoc();
                        if ($comment->postID == $id) {
                            $commentInfo .= '<div class="comment-post"> 
                            <div class="comment-info"> 
                                <div class="post-author-img"> 
                                    <a href="profile.php?username='.$user_data["ID"].'"><img class="avatar-small" src="'.$user_data["avatar"].'"></a> 
                                </div> 
                            <div class="post-author-text"> 
                                <a href="profile.php?username='.$user_data["ID"].'"><h4>by '.$user_data["username"].'</h4></a> 
                            </div>
                        </div>
                        <div class="comment"> 
                            <p>'.$comment->commentText.'</p> 
                        </div>
                        <h4>'.$comment->created.'</h4>
                    </div>'; 
                        }
                    }
                }
            }
        $this->assign($searchFor, $commentInfo);
    }

    function logInlogOutScript($searchFor){
        $script = '<script type="text/javascript">
        const loginBtnHamb = document.querySelector("#loginHamb");
        const logoutBtnHamb = document.querySelector("#logoutHamb");
        const loginBtn = document.querySelector("#login");
        const logoutBtn = document.querySelector("#logout");
        const profileBtn = document.querySelector("#profileBtn");
        const profileBtnHamb = document.querySelector("#profileHamb");
        const searchBtn = document.querySelector("#searchBtn");
        searchBtn.disabled = false;
        if (window.location.pathname !== "/index.php") {
            searchBtn.disabled = true;
          }';
        if(!empty($searchFor)) {
            if (isset($_SESSION["id"])){
                $script .= 'loginBtn.style.display = "none";
                logoutBtn.style.display = "block";
                loginBtnHamb.style.display = "none";
                logoutBtnHamb.style.display = "block";
                
                logoutBtn.addEventListener("click", () => {
                    fetch("./logout.php")
                        .then(response => {
                            window.location.href="login.php";
                        })
                        .catch(error => {
                            console.error("Something went wrong")
                        });
                });
                logoutBtnHamb.addEventListener("click", () => {
                    fetch("./logout.php")
                        .then(response => {
                            window.location.href="login.php";
                        })
                        .catch(error => {
                            console.error("Something went wrong")
                        });
                });
                profileBtn.addEventListener("click", () => {
                    window.location.href="profile.php";
                });
                profileBtnHamb.addEventListener("click", () => {
                    window.location.href="profile.php";
                });';
            }else{
                $script .= '
                loginBtnHamb.style.display = "block";
                logoutBtnHamb.style.display = "none";
                loginBtn.style.display = "block";
                logoutBtn.style.display = "none";
                
                profileBtn.addEventListener("click", () => {
                    window.location.href="login.php";
                });
                profileBtnHamb.addEventListener("click", () => {
                    window.location.href="login.php";
                });
                ';
            }
        }
        $script .= "</script>";
        $this->assign($searchFor, $script);
    }

    function render()
    {
        if (count($this->assignedValues) > 0) {
            foreach ($this->assignedValues as $key => $value) {
                $this->tpl = preg_replace("/\{{" . $key . "\}}/", $value, $this->tpl);
            }
        }
        return $this->tpl;
    }
}
