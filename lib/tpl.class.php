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
        $singlePost = '<div class="main-page">
        <div class="posts-home">';
        if (!empty($searchFor)) {
            if (!empty($replaceWith)) {
                $rows = count($replaceWith);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $singlePost .= ' <div class="single-post">
                        <a href="single_post.php?title=' . $replaceWith[$i]->title . '"><img src="' . $replaceWith[$i]->image . '"></a>
                        <div class="post-text">
                            <div class="post-author">
                                <div class="post-author-img">
                                    <a href="profile.php?username=' . $replaceWith[$i]->owner . '"><img class="avatar-small" src="' . $replaceWith[$i]->owner_image . '"></a>
                                </div>
                                <div class="post-author-text">
                                    <a href="profile.php?username=' . $replaceWith[$i]->owner . '">
                                        <h4>' . $replaceWith[$i]->owner . '</h4>
                                    </a>
                                </div>
                            </div>
                            <h3>' . $replaceWith[$i]->title . '</h3>
                            <div class="detail-info-post">
                                <p>' . $replaceWith[$i]->description . '
                                </p>
                            </div>
                            <div class="posted">
                                <h4>' . $replaceWith[$i]->created . ' minutes ago</h4>
                            </div>
                        </div>
                    </div>';
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
                        if (empty($_GET['username'])) {
                            $username = "Vilsivul";
                        } else {
                            $username = $_GET['username'];
                        }
                        if ($replaceWith[$i]->owner == $username) {
                            $profilePost .= '<div class="single-post">
                            <a href="single_post.php?title='.$replaceWith[$i]->title.'"><img src="' . $replaceWith[$i]->image . '"></a>
                            <div class="post-text">
                                <span class="btn-edit"><a href="#"><i class="fa fa-edit"></i></a></span>
                                <h3>' . $replaceWith[$i]->title . '</h3>
                                <p>
                                ' . $replaceWith[$i]->description . '
                                </p>
                                <div class="posted">
                                    <h4>' . $replaceWith[$i]->created . ' minutes ago</h4>
                                </div>
                            </div>
                        </div>';
                        }
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
                    <img class="avatar" src="' . $replaceWith->owner_image . '">
                    <h3>' . $replaceWith->username . '</h3>
                    <p class="profile-text">' . $replaceWith->bio . '</p>
                    <ul class="prof-social">
                        <li>
                        <a title="Blog" href="#" target="_blank"><i class="fa fa-globe"></i></a>
                        </li>
                        <li>
                            <a title="Twitter" href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a title="Facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a title="Instagram" href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="create-btn">
                    <a href="make-post.html">
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
        }
        $this->assign($searchFor, $infoAbout);
    }

    function createSinglePost($searchFor, $replaceWith, $counterOfComments) {
        $singlePost = '';
        if(!empty($searchFor)) {
            if(!empty($replaceWith)) {
                $singlePost .= '<div class="single-post-kiril">
                <div class="post-header">
                    <div class="post-meta"><span class="author">'.$replaceWith[0]->owner.'</span><br>
                <span class="date">'.$replaceWith[0]->created.' minutes ago</span>
                </div>
                    <h2 class="post-title">'.$replaceWith[0]->title.'</h2>
                    <div class="post-image-single">
                        <img src="'.$replaceWith[0]->image.'">
                    </div>
                </div>
                <div class="post-body">
                    <div class="entry-desc">
                        <p>'.$replaceWith[0]->description.'</p>
                    </div>
                </div>
                <div class="post-image-reply-section">
                        <div class="post-like">
                        <span class="number-of-likes">'.$replaceWith[0]->likes.'</span>
                        <button class="post-like-button"><i class="fa fa-heart" aria-hidden="true"></i></button>
                        <span class="number-of-comments">'.$counterOfComments.'</span>
                        <a class="post-comment-button"><i class="fa fa-comment"></i></a>
                    </div>
                </div>
            </div>
            <div class="comment-section">
                <form class="form-for-comment" action="make-comment.php" method="get">
                    <div class="form-field-comment">
                        <input type="textarea" cols="90" rows="15" name="text-comment" class="input-text-comment" placeholder="Enter your Comment">
                        <input type="hidden" name="title-comment" value="'.$replaceWith[0]->title.'">
                    </div>
                    <input class="btn" type="submit" value="Send a Comment" />
                </form>
            </div>';
            }
        }
        $this -> assign($searchFor, $singlePost);
    }
    
    function createPostComments($searchFor, $replaceWith) {
        $commentInfo = '';
        if(!empty($searchFor)) {
            if(!empty($replaceWith)) {
                    foreach($replaceWith as $comment) {
                        if (!empty($_GET['title'])) {
                            $title = $_GET['title'];
                        } else {
                            $title = "German";
                        }
                        if ($comment->title == $title) {
                            $commentInfo .= '<div class="comment-post"> 
                            <div class="comment-info"> 
                                <div class="post-author-img"> 
                                    <a href="profile.php?username='.$comment->comment_owner.'"><img class="avatar-small" src="'.$comment->comment_owner_image.'"></a> 
                                </div> 
                            <div class="post-author-text"> 
                                <a href="profile.php?username='.$comment->comment_owner.'"><h4>by '.$comment->comment_owner.'</h4></a> 
                            </div>
                        </div>
                        <div class="comment"> 
                            <p>'.$comment->comment_desc.'</p> 
                        </div>
                        <div class="created"><h4>'.$comment->comment_created.' minutes ago</h4></div> 
                    </div>'; 
                        }
                    }
                }
            }
        $this->assign($searchFor, $commentInfo);
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
