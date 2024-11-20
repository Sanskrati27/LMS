<?php
session_start();
if(!isset($_SESSION["aemail"])){
    header("location: signin.php");
}

include "connection.php";
include "header.php";
?>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Add Borrower</h2>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Add Borrower</div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="name" name="name" placeholder="Name" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" id="email" name="email" placeholder="Email"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                        <input type="password" id="password" name="password" placeholder="Password"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <input type="number" id="lid" name="lid" placeholder="Library Id"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-primary btn-sm" name="addb">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST["addb"])) {
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
                            Entered<strong> library id</strong>already exists!!!
                        </div>
                    <?php
                } else {
                    $query = "INSERT INTO borrower (name, email, password, lid, status) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[password]', '$_POST[lid]', 'Activated')";
                    $results = mysqli_query($link, $query);
                    ?>
                        <div class="alert alert-success col-lg-6 col-lg-push-3">
                            Borrower added successfull!!!
                        </div>
                    <?php
                }
            }

            include "footer.php";
            ?>