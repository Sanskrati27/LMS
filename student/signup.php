<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/signin.css">
</head>

<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-format-list-bulleted"></i></label>
                                <input type="number" name="lid" id="lid" placeholder="Library Id" required />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                    statements in <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
                <?php
                if (isset($_POST["signup"])) {
                    $sql_u = "SELECT * FROM borrower WHERE email='$_POST[email]'";
                    $sql_e = "SELECT * FROM borrower WHERE lid='$_POST[lid]'";

                    $res_u = mysqli_query($link, $sql_u);
                    $res_e = mysqli_query($link, $sql_e);

                    if (mysqli_num_rows($res_u) > 0) {
                        ?>
                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                            Entered <strong>email </strong>already exists!!!
                        </div>
                        <?php
                    } else if (mysqli_num_rows($res_e) > 0) {
                        ?>
                            <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                Entered<strong> library id</strong> already exists!!!
                            </div>
                        <?php
                    } else {
                        $query = "INSERT INTO borrower (name, email, password, lid, status) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[pass]', '$_POST[lid]', 'Deactivated')";
                        $results = mysqli_query($link, $query);
                        ?>
                            <div class="alert alert-success col-lg-6 col-lg-push-3">
                                Your registration is successfull!!!
                            </div>
                        <?php
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