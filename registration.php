<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    $pattern = "/^([A-Za-z' _]+)$/";
    if ($name) {
        if (!preg_match($pattern, $name)) {
            $errors[] = "First Name contains wrong symbol.";
        }
    } else {
        $errors[] = "First name is required";
    }

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
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );

        $dataFile = fopen('./data/registration_info.csv', 'a');
        fputcsv($dataFile, $data, ';');
        fclose($dataFile);

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
    <title>Registration Form</title>
</head>

<body>
    <div class="reg-form">

        <div class="sign-box">
            <div class="register-header">
                <h2 class="reg-text-registr">Registration</h2>
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
                    <input type="password" id="password" name="password" class="password" required>
                    <label for="password">Password</label>
                    <div class="password-checkbox">
                        <svg style="color: rgb(25, 38, 66);" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"></svg>
                    </div>
                </div>
                <button id="createAccountButton" name="createAccountButton" href="index.php" class="submit-but">Create
                    account</button>
                <div class="login-link"><a href="login.php">Already have an account?</a></div>

            </form>
        </div>

    </div>
</body>