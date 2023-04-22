<?php
if (isset($_POST['email']) && isset($_POST['password'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if ($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
    } else {
        $errors[] = "Email address is required";
    }

    if ($password) {
        if (strlen($password) < 4) {
            $errors[] = 'Password is too short ;(';
        }
    } else {
        $errors[] = 'Password is required';
    }

    if (empty($errors)) {
        $data = array(
            $_POST['email'],
            $_POST['password']
        );

        $dataFile = fopen('./data/registration_info.csv', 'r');
        while (!feof($dataFile)) {
            if (strpos($dataFile, $_POST['email'], )) {
                echo 'you have an account';
            }

        }

    } else {
        echo "<p>Some information was not entered correctly!</p>";
        echo "<p>The following errors occurred:</p>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>{$error}</li>";
        }
        echo "</ul>";
    }
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
            <form method="POST" action="#">

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