<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/signin.css">
</head>

<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="../images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="your_name" placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="your_pass" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"
                                    required />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                    me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>

                    </div>
                </div>
                <?php
                if (isset($_POST["signin"])) {
                    $count = 0;
                    $res = mysqli_query($link, "select * from borrower where email = '$_POST[email]' && password='$_POST[pass]'");
                    $count = mysqli_num_rows($res);
                    if ($count == 0) {
                        ?>
                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                            You entered invalid<strong> email or password!!!</strong>
                        </div>
                        <?php
                    } else {
                        while($row=mysqli_fetch_array($res)){
                            $name=$row["name"];
                            $status=$row["status"];
                        }
                        if($status == "Activated"){
                            $_SESSION['semail'] = $_POST["email"];
                            $_SESSION['sname'] = $name;
                            ?>
                            <script>
                                window.location = "dashboard.php";
                            </script>
                            <?php
                        }
                        else{
                            ?>
                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                            Your account is still<strong> Deactivated!!! </strong>Please wait for activation...
                        </div>
                        <?php
                        }
                    }
                }
                ?>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>