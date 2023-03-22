<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/hamburger-menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Detailed info</title>
</head>
<body>

        <h1>Travel Memories</h1>

    <header>
        <nav>
            <?php include "includes/navigation.html" ?>
        </nav>
    </header>

    <div class="main-paige">

        <div class="single-post-kiril">

            <div class="post-header">

                <div class="post-meta">
                    <span class="author">Joe Biden</span><br>
                    <span class="date">18 January 2004</span>
                </div>

                <h2 class="post-title">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                </h2>

                <div class="post-image-single">
                    <img src="img/posts/beach.jpeg">
                </div>

            </div>
            <div class="post-body">
                <div class="entry-desc">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley 
                        of type and scrambled it to make a type specimen book. It has survived not only five 
                        centuries,but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem 
                        Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker  
                        including versions of Lorem Ipsum.
                    </p>
                </div>
            </div>
            <div class="post-image-reply-section">

                <div class="post-like">
                    <span class="number-of-likes">2</span>
                    <button class="post-like-button">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                    <span class="number-of-comments">2</span>
                    <a class="post-comment-button">
                        <i class="fa fa-comment"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="comment-section">
            <form class="form-for-comment" action="#" method="get">
                <div class="form-field-comment">
                  <input class="input-text-comment" type="textarea" cols="90" rows="15" name="text" placeholder="Enter your Comment" />
                </div>
                <input class="btn" type="submit" value="Send a Comment" />
            </form>
        </div>
        <div class="comment-post">
            <div class="comment-info">
                <div class="post-author-img">
                    <a href="profile.html"><img class="avatar-small" src="img/avatars/Visl.jpg"></a>
                </div>
                <div class="post-author-text">
                    <a href="profile.html"><h4>by Jone Doe</h4></a>
                </div>
            </div>
            <div class="comment">
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley 
                    of type and scrambled it to make a type specimen book. It has survived not only five 
                    centuries,but also
                </p>
            </div>
        </div>
        <div class="comment-post">
            <div class="comment-info">
                <div class="post-author-img">
                    <a href="profile.html"><img class="avatar-small" src="img/avatars/masha.jpg"></a>
                </div>
                <div class="post-author-text">
                    <a href="profile.html"><h4>by Jone Doe</h4></a>
                </div>
            </div>
            <div class="comment">
                <p>
                    It has survived not only five 
                    centuries,but also the leap into electronic types
                </p>
            </div>
        </div>
    </div>
    <?php include "includes/footer.html" ?>
</body>
</html>