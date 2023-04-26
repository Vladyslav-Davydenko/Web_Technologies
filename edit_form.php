<?php 
  require_once('data/db_connection.php');
  require_once('base/UserClass.php');

  $conn = mysqli_connect($server, $user, $password, $database);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["editAccountButton"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $bio = isset($_POST['bio']) ? $_POST['bio'] : "";
    $avatar = "img/avatars/default.png";
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
      $uploaded_file = $_FILES['avatar']['tmp_name'];
      //$destination = 'img/avatars/'. $email. '_avatar.jpg';
      $destination = 'img/avatars/'. $_SESSION["id"] .'.jpg';

      if (move_uploaded_file($uploaded_file, $destination)) {
        $avatar = $destination;
      }  
  }
    $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : "";
    $instagram = isset($_POST['instagram']) ? $_POST['instagram'] : "";
    $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : "";
    $social = isset($_POST['web']) ? $_POST['web'] : "";
    $error = '';

    //E-mail Validation
    $email = trim($email);
    if (empty($email)) {
        $error = 'E-mail is empty';
    } else {
        if (!preg_match('/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._%+-]+@(?![_.])[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}+(?<![_.])$/i', $email)){
            $error = 'Invalid E-mail';
        }
    }

    // Username Validation
    $username = trim($username);
    if (empty($username)) {
        $error = 'Username field is Empty';
    } else {
        if(!preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $username)){
            $error = 'Username is Invalid';
        }
    }
    // Writing into DB
    if(empty($error)){

      $userId = $_SESSION["id"];
      $sql = "UPDATE User SET username=?, email=?, bio=?, avatar=?, social=?, instagram=?, facebook=?, twitter=? WHERE ID=?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssssssssi", $username, $email, $bio, $avatar, $social, $instagram, $facebook, $twitter, $userId);
      $result = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      echo "<script>window.location.href='profile.php';</script>";
      
    }    
    else{
        echo "<script type='text/javascript'>alert('$error');</script>";
        echo "<script>window.location.href='edit_form.php';</script>";

    } 
    // Close the database connection    
}
  
  error_reporting(0);
  session_start();
  $script = "";
  if(isset($_SESSION["id"])){
    $userId = $_SESSION["id"];
    $sql = "SELECT * FROM User WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
      $user = getUser($conn);
      $script = '<script>
      const username = document.querySelector("#username");
      const email = document.querySelector("#email");
      const bio = document.querySelector("#bio");
      // const avatar = document.querySelector("#avatar");
      const web = document.querySelector("#web");
      const instagram = document.querySelector("#instagram");
      const facebook = document.querySelector("#facebook");
      const twitter = document.querySelector("#twitter");
      username.value = "' . $user->username. '";
      email.value = "' . $user->email. '";
      bio.value = "' . $user->bio. '";
      // avatar.value = "' . $user->avatar. '";
      web.value = "' . $user->social. '";
      instagram.value = "' . $user->instagram. '";
      facebook.value = "' . $user->facebook. '";
      twitter.value = "' . $user->twitter. '";
      </script>';

    } else {
    // User does not exist or the password is incorrect
    echo "<script type='text/javascript'>alert('Some problems with Session, can not find user');</>";
    } 
  }
  else{
    echo "<script type='text/javascript'>alert('Something went wrong');</script>";
  }
?>

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
        <form method="POST" action="#" enctype="multipart/form-data">
          <div class="input-box">
            <input
              type="text"
              class="name"
              id="username"
              name="username"
              value=""
              placeholder="Username"
              required
            />
          </div>

          <div class="input-box">
            <input
              type="email"
              id="email"
              name="email"
              value=""
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
              value=""
              placeholder="Bio"
            />
          </div>

          <div class="input-box">
            <label
              for="avatar"
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
              id="avatar"
              name="avatar"
              value=""
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="web"
              id="web"
              name="web"
              value=""
              placeholder="Web"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="instagram"
              id="instagram"
              name="instagram"
              value=""
              placeholder="Instagram"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="facebook"
              id="facebook"
              name="facebook"
              value=""
              placeholder="Facebook"
            />
          </div>

          <div class="input-box">
            <input
              type="text"
              class="twitter"
              id="twitter"
              name="twitter"
              value=""
              placeholder="Twitter"
            />
          </div>

          <button
            id="editAccountButton"
            name="editAccountButton"
            class="submit-but"
          >
            Edit
          </button>
        </form>
        <a href="profile.php"><button type="button" class="submit-but">Back Home</button></a>
      </div>
    </div>
    <?php echo $script?>
  </body>
</html>
