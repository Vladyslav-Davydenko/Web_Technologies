<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap"
      rel="stylesheet"
    />
    <title>Edit Profile</title>
  </head>

  <body>
    <div class="edit-profile">
      <div class="sign-box">
        <div class="register-header">
        <a href="index.php">
          </a>
          <h2 class="reg-text-registr">Edit Profile</h2>
        </div>
        <form method="POST" action="#">
          <div class="input-box">
            <input
              type="text"
              class="name"
              id="name"
              name="name"
              placeholder="Username"
              required
            />
          </div>

          <div class="input-box">
            <input
              type="email"
              id="email"
              name="email"
              class="email"
              placeholder="Email"
              required
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="bio"
              id="bio"
              name="bio"
              placeholder="Bio"
            />
          </div>

          <div class="input-box">
            <label
              for="profile_img"
              style="
                font-family: 'Libre-Baskerville-Italic';
                font-size: 20px;
                border: 2px solid black;
                border-width: 0px 0px 2px 0px;
                border-color: #800f2f;
                color: #30343fbf; 
              "
              >Avatar</label
            >
            <input
              type="file"
              class="profile_img"
              id="profile_img"
              name="profile_img"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="web"
              id="web"
              name="web"
              placeholder="Web"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="instagram"
              id="instagram"
              name="instagram"
              placeholder="Instagram"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="facebook"
              id="facebook"
              name="facebook"
              placeholder="Facebook"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="twitter"
              id="twitter"
              name="twitter"
              placeholder="Twitter"
            />
          </div>

          <button
            id="createAccountButton"
            name="createAccountButton"
            href="index.php"
            class="submit-but"
          >
            Edit
          </button>
        </form>
        <a href="profile.php"><button type="button" class="submit-but">Back Home</button></a>
      </div>
    </div>
  </body>
</html>
