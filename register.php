<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include 'layout/guest/header_guest.php';

$error = '';

if (isset($_POST['register-button'])) {
    // clean data 
    $user_name_register = stripslashes($_POST['username']);
    $user_email_register = stripslashes($_POST['email']);
    $user_password_register = stripslashes($_POST['password']);
    $user_contact_register = stripslashes($_POST['contact']);
    $user_gender_register = stripslashes($_POST['gender']);
    $user_role_register = stripslashes($_POST['role']);

    $user_name_register = mysqli_real_escape_string($conn, $user_name_register);
    $user_email_register = mysqli_real_escape_string($conn, $user_email_register);
    $user_password_register = mysqli_real_escape_string($conn, $user_password_register);
    $user_contact_register = mysqli_real_escape_string($conn, $user_contact_register);
    $user_gender_register = mysqli_real_escape_string($conn, $user_gender_register);
    $user_role_register = mysqli_real_escape_string($conn, $user_role_register);

    $user_password_hash = password_hash($user_password_register, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user WHERE user_email='{$user_email_register}'";
    $result = mysqli_query($conn, $sql);
    $row  = mysqli_fetch_array($result);
    if (is_array($row)) {
        $error = "Email already exist!";
    } else {
        $body = "Congratulations " . ucwords($user_name_register) . "! You are successfully registered to the system.";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = 'putranaz94@gmail.com'; // Replace with your email
        $mail->Password = 'meegsmqkoxhufhew'; // Replace with your app password
        $mail->setFrom('cat-hostel@example.com', 'Cat Hostel');
        $mail->addReplyTo('do-not-reply@example.com', 'Cat Hostel');
        $mail->addAddress($user_email_register);
        $mail->Subject = 'Cat Hostel Registration';
        $mail->msgHTML($body);
        $mail->AltBody = 'Congratulations! Welcome to Cat Hostel';

        if (!$mail->Send()) {
            echo '<script>alert("Error: ' . $mail->ErrorInfo . '");window.location.href="/8ag1/register.php";</script>';
        } else {
            $sql = "INSERT into `user` (user_name, user_password, user_email, user_contact, user_gender, user_role, user_active) VALUES ('{$user_name_register}', '{$user_password_hash}', '{$user_email_register}', '{$user_contact_register}', '{$user_gender_register}', '{$user_role_register}', false)";
            $sqlQuery = mysqli_query($conn, $sql);

            if (!$sqlQuery) {
                die("Database connection not established. " . mysqli_error($conn));
            }

            $error = '';
            echo '<script>alert("Your account has been registered. Please proceed to login page.");window.location.href="/8ag1/index.php";</script>';
        }
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
    <title>Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Welcome to Cat Hostel</h3>
                                </div>
                                <div class="card-body">
                                    <form action="register.php" method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="username" name="username" type="text" placeholder="Username" required />
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email" required />
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="contact" name="contact" type="text" placeholder="Contact" required />
                                                    <label for="contact">Contact</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <select class="form-select form-floating mb-3 py-3" name="gender" aria-label="Select gender" required>
                                                    <option disabled>Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-select form-floating mb-3 py-3" name="role" aria-label="Select role" required>
                                                    <option disabled>Role</option>
                                                    <option value="Customer">Customer</option>
                                                    <option value="Staff">Staff</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-4 mx-2">
                                            <button class="btn btn-primary btn-lg" type="submit" name="register-button">Register</button>
                                        </div>
                                    </form>
                                    <div class="card-footer text-center py-3">
                                        <div class="mb-3 text-danger">
                                            <?php
                                            echo $error;
                                            ?>
                                        </div>
                                        <div class="small"><a href="/8ag1/login.php">Has an account? Login here</a></div>
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