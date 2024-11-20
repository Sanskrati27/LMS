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
                        <h2 class="title-1">Add Book</h2>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Add Book</div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input type="number" id="isbn" name="isbn" placeholder="ISBN"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-folder-open"></i>
                                        </div>
                                        <input type="file" id="bimage" name="img" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <input type="text" id="bname" name="bname" placeholder="Book Name"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="aname" name="aname" placeholder="Author Name"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input type="number" id="quantity" name="quantity" placeholder="Total Quantity"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input type="number" id="aquantity" name="aquantity"
                                            placeholder="Available Quantity" class="form-control" required>
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
                $sql_u = "SELECT * FROM book WHERE isbn='$_POST[isbn]'";

                $res_u = mysqli_query($link, $sql_u);

                if (mysqli_num_rows($res_u) > 0) {
                    ?>
                    <div class="alert alert-danger col-lg-6 col-lg-push-3">
                        Entered <strong>ISBN </strong>already exists!!!
                    </div>
                    <?php
                } else {
                    $tm = md5(time());
                    $fnm = $_FILES["img"]["name"];
                    $dst = "./books_image/" . $tm . $fnm;
                    $dst1 = "books_image/" . $tm . $fnm;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $dst);

                    $query = "INSERT INTO book (isbn, bimage, bname, aname, quantity, aquantity) VALUES ('$_POST[isbn]', '$dst1','$_POST[bname]', '$_POST[aname]', '$_POST[quantity]', '$_POST[aquantity]')";
                    $results = mysqli_query($link, $query);
                    ?>
                    <div class="alert alert-success col-lg-6 col-lg-push-3">
                        Book added successfully!!!
                    </div>
                    <?php
                }
            }
            include "footer.php";
            ?>