<?php
    require_once('data/db_connection.php');

    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    error_reporting(0);
    session_start();
    // TODO: check if session is the right one
    if(isset($_SESSION["id"])){
        header('Location: index.php');
    }
    if ((($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["loginSubmitButton"]))) {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
        

        // Writing into DB
        $sql = "SELECT * FROM User WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
        // User exists and the password is correct
        $row = mysqli_fetch_assoc($result) ;
        $_SESSION['id'] = $row['ID'];
        header('Location: index.php');
        } else {
        // User does not exist or the password is incorrect
        echo "<script type='text/javascript'>alert('User does not exist or password is incorrect');</script>";
        header('Location: index.php');
        } 
        
    // Close the database connection  
    }
?>

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
    <title>Login Form</title>
</head>

<body>
    <div class="log-form">
        <div class="sign-box">
            <a href="index.php">
                <div class="back-to-home">
                    <i class="fa fa-arrow-left fa-lg"></i>
                </div>
            </a>
            <div class="login-header">
                <h2 class="reg-text-login">Login</h2>

            </div>
            <form method="POST">

                <div class="input-box">
                    <input type="email" id="loginEmail" name="loginEmail" class="email" placeholder="Email" required>
                </div>

                <div class="input-box">
                    <input type="password" id="loginPassword" name="loginPassword" class="password"
                        placeholder="Password" required>
                    <div class="password-checkbox">
                        <img class="eye" src="img/icons/hide.png" alt="eye" id="close-eye">
                    </div>
                </div>
                <button type="submit" id="loginSubmitButton" name="loginSubmitButton" href="profile.php"
                    class="submit-but">Log in</button>
                <div class="question-link"><a href="registration.php">Don't have an account?</a></div>

            </form>
        </div>

    </div>
    <script>
        let eyeIcon = document.getElementById("close-eye")
        let password = document.getElementById("loginPassword")

        eyeIcon.onclick = function () {
            if (password.type == "password") {
                password.type = "text"
                eyeIcon.src = "img/icons/view.png"
            } else {
                password.type = "password"
                eyeIcon.src = "img/icons/hide.png"

            }
        }

    </script>
</body>