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
    <link rel="stylesheet" href="css/login-reg-makepost.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap"
        rel="stylesheet">
    <title>Login Form</title>
</head>

<body>
    <div class="reg-form">
        <div class="sign-box">
            <div class="login-header">
                <h2 class="reg-text-login">Login</h2>
                <a href="index.php">
                    <div><i class="fa fa-arrow-left fa-lg"></i></div>
                </a>
            </div>
            <form method="POST" action="#">

                <div class="input-box">
                    <input type="email" id="loginEmail" name="loginEmail" class="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <input type="password" id="loginPassword" name="loginPassword" class="password" required>
                    <label>Password</label>
                    <div class="password-checkbox">
                        <svg style="color: rgb(25, 38, 66);" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"></svg>
                    </div>
                </div>
                <button type="submit" id="loginSubmitButton" name="loginSubmitButton" href="profile.php"
                    class="submit-but">Log in</button>
                <div class="login-link"><a href="registration.php">Don't have an account?</a></div>

            </form>
        </div>

    </div>
</body>