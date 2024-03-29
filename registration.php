<?php
    require_once('data/db_connection.php');

    $conn = mysqli_connect($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    error_reporting(0);
    session_start();

    if(isset($_SESSION["id"])){
        header('Location: index.php');
    }
    
    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["createAccountButton"])) {
        $email = $_POST['email'];
        $username = $_POST['name'];
        $password = $_POST['password'];
        $error = '';

        // Password Validation
        $password = trim($password);
        if (empty($password)) {
            $error = 'Password Field is Empty';
        } else {
            if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)){
                $error = 'Password is Invalid';
            }
        }

        //E-mail Validation
        $email = trim($email);
        if (empty($email) || empty($email)) {
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
            if(!preg_match("/^[A-Za-z][A-Za-z0-9_]{4,15}$/", $username)){
                $error = 'Username is Invalid';
            }
        }

        // Writing into DB
        if(empty($error)){
            $sql1 = "SELECT * FROM User WHERE email = '$email'";
            $check = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($check) > 0) {
                echo "<script type='text/javascript'>alert('User already exist with such email');</script>";
                header('Location: login.php');
            }
            else{
                $sql = "INSERT INTO User (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
                mysqli_stmt_execute($stmt);
                $user_id = mysqli_insert_id($conn);
                $_SESSION['id'] = $user_id;
                header('Location: index.php');
            }
        }    
        else{
            echo "<script type='text/javascript'>alert('$error');</script>";
            header('Location: registration.php');

        } 
        // Close the database connection
        mysqli_close($conn);     
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
            <a href="index.php">
                <div class="back-to-home">
                    <i class="fa fa-arrow-left fa-lg"></i>
                </div>
            </a>
            <div class="register-header">
                <h2 class="reg-text-registr">Registration</h2>
            </div>
            <form method="POST">

                <div class="input-box">
                    <input type="text" class="name" id="name" name="name" placeholder="Username" required>
                </div>

                <div class="input-box">
                    <input type="email" id="email" name="email" class="email" placeholder="Email" required>
                </div>

                <div class="input-box">
                    <input type="password" id="password" name="password" class="password" placeholder="Password"
                        required>
                    <div class="password-checkbox">
                        <img class="eye" src="img/icons/hide.png" alt="eye" id="close-eye">
                    </div>
                </div>
                <button id="createAccountButton" name="createAccountButton" href="index.php" class="submit-but">Create
                    account</button>
                <div class="question-link"><a href="login.php">Already have an account?</a></div>

            </form>
        </div>

    </div>
    <script>
        let eyeIcon = document.getElementById("close-eye")
        let password = document.getElementById("password")

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