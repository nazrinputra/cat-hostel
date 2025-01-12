<?php
include 'layout/guest/header_guest.php';

$error = '';

if (isset($_POST['ic']) && isset($_POST['password'])) {
    // clean data 
    $ic_login = stripslashes($_POST['ic']);
    $password_login = stripslashes($_POST['password']);
    $ic_login = mysqli_real_escape_string($conn, $ic_login);
    $password_login = mysqli_real_escape_string($conn, $password_login);

    $sql = "SELECT * FROM user WHERE user_ic='{$ic_login}'";
    $result = mysqli_query($conn, $sql);

    $row  = mysqli_fetch_array($result);

    if (is_array($row)) {
        $password_db = $row['user_password'];
        if (password_verify($password_login, $password_db)) {
            if ($row['user_active']) {
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["user_name"] = $row['user_name'];
                $_SESSION["user_email"] = $row['user_email'];
                $_SESSION["user_ic"] = $row['user_ic'];
                $_SESSION["user_role"] = $row['user_role'];
                header("Location: /index.php");
            } else {
                $error = "User account inactive!";
            }
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Account does not exist!";
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
                                            <input class="form-control" id="ic" name="ic" type="ic" placeholder="IC" maxlength="12" required />
                                            <label for="ic">IC</label>
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
                                        <div class="small"><a href="/register.php">Need an account? Sign up!</a></div>
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