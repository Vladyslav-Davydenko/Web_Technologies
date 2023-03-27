<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap"
        rel="stylesheet">
    <title>Edit Profile</title>
</head>

<body>
    <div class="edit-profile">

        <div class="sign-box">
            <div class="register-header">
                <h2 class="reg-text-registr">Edit Profile</h2>
                <a href="index.php">
                    <div><i class="fa fa-arrow-left fa-lg"></i></div>
                </a>
            </div>
            <form method="POST" action="#">

                <div class="input-box">
                    <input type="text" class="name" id="name" name="name" required>
                    <label for="name">Username</label>
                </div>

                <div class="input-box">
                    <input type="email" id="email" name="email" class="email" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-box">
                    <input type="text" class="bio" id="bio" name="bio">
                    <label for="bio">Short Intro</label>
                </div>

                <div class="input-box">
                    <input type="file" class="profile_img" id="profile_img" name="profile_img">
                    <label for="profile_img">Avatar</label>
                </div>

                <div class="input-box">
                    <input type="text" class="web" id="web" name="web">
                    <label for="web">Web</label>
                </div>

                <div class="input-box">
                    <input type="text" class="instagram" id="instagram" name="instagram">
                    <label for="instagram">Instagram</label>
                </div>

                <div class="input-box">
                    <input type="text" class="facebook" id="facebook" name="facebook">
                    <label for="facebook">Facebook</label>
                </div>

                <div class="input-box">
                    <input type="text" class="twitter" id="twitter" name="twitter">
                    <label for="twitter">Twitter</label>
                </div>
                
                <button id="createAccountButton" name="createAccountButton" href="index.php" class="submit-but">Edit</button>

            </form>
        </div>

    </div>
</body>