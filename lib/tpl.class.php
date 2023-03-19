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
    function createPost($searchFor, $replaceWith){
        $singlePost = '<div class="main-page">
        <div class="posts-home">';
        if (!empty($searchFor)) {
            if (!empty($replaceWith)) {
                $rows = count($replaceWith);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) { 
                        $singlePost .= ' <div class="single-post">
                        <a href="single_post.html"><img src="'.$replaceWith[$i]->image.'"></a>
                        <div class="post-text">
                            <div class="post-author">
                                <div class="post-author-img">
                                    <a href="profile.html"><img class="avatar-small" src="'.$replaceWith[$i]->owner_image.'"></a>
                                </div>
                                <div class="post-author-text">
                                    <a href="profile.html">
                                        <h4>'. $replaceWith[$i]->owner.'</h4>
                                    </a>
                                </div>
                            </div>
                            <h3>'. $replaceWith[$i]->title.'</h3>
                            <div class="detail-info-post">
                                <p>'. $replaceWith[$i]->description.'
                                </p>
                            </div>
                            <div class="posted">
                                <h4>'. $replaceWith[$i]->created.' minutes ago</h4>
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
?>