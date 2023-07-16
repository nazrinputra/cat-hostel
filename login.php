<?php
include 'layout/guest/header_guest.php';

$error = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    // clean data 
    $username_login = stripslashes($_POST['username']);
    $password_login = stripslashes($_POST['password']);
    $username_login = mysqli_real_escape_string($conn, $username_login);
    $password_login = mysqli_real_escape_string($conn, $password_login);

    $sql = "SELECT * FROM user WHERE user_name='{$username_login}' AND user_password='{$password_login}'";
    $result = mysqli_query($conn, $sql);

    $row  = mysqli_fetch_array($result);

    if (is_array($row)) {
        if ($row['user_active']) {
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user_name"] = $row['user_name'];
            $_SESSION["user_email"] = $row['user_email'];
            $_SESSION["user_role"] = $row['user_role'];
            header("Location: index.php");
        } else {
            $error = "User account inactive!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="login.php" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" type="username" placeholder="Username" required />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-4 mx-2">
                                            <div>
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                    <div class="card-footer text-center py-3">
                                        <div class="mb-3 text-danger">
                                            <?php
                                            echo $error;
                                            ?>
                                        </div>
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>

        <?php
        include 'layout/guest/footer_guest.php';
        ?>