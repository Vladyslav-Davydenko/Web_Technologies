<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/single_post.css">
    <link rel="stylesheet" href="css/hamburger-menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Detailed info</title>
</head>

<body>

    <div class="main-name">
        <h1>Travel Memories</h1>
    </div>

    <header>
        <nav>
            <?php include "navigation.php" ?>
        </nav>
    </header>

    <!--<a href="https://www.flaticon.com/ru/free-icons/" title="путешествовать иконки">Путешествовать иконки от Freepik - Flaticon</a>-->

    <div class="main-page">

        <div class="single-post">

            <div class="post-header">

                <div class="post-meta">
                    <span class="author">{AUTHOR}</span><br>
                    <span class="date">18 January 2004</span>
                </div>

                <h2 class="post-title">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                </h2>

                <div class="post-image">
                    <img src="img/posts/beach.jpeg">
                </div>

            </div>
            <div class="post-body">
                <div class="entry-desc">
                    <p>{TEXT}</p>
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
            <form class="form" action="#" method="get">
                <div class="form-field">
                    <input class="input-text-comment" type="textarea" cols="90" rows="15" name="text"
                        placeholder="Enter your Comment" />
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
                    <a href="profile.html">
                        <h4>{USERNAME}</h4>
                    </a>
                </div>
            </div>
            <div class="comment">
                <p>{COMMENT}</p>
            </div>
        </div>
        <div class="comment-post">
            <div class="comment-info">
                <div class="post-author-img">
                    <a href="profile.html"><img class="avatar-small" src="img/avatars/masha.jpg"></a>
                </div>
                <div class="post-author-text">
                    <a href="profile.html">
                        <h4>{USERNAME}</h4>
                    </a>
                </div>
            </div>
            <div class="comment">
                <p>{COMMENT}</p>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>