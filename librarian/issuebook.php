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
                        <h2 class="title-1">Issue Book</h2>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <form action="" method="post">
                            <div class="card-header">Issue Book</div>
                            <div class="card-body card-block">

                                <div class="form-group">

                                    <div class="input-group">
                                        <form action="" method="post" class="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <select name="lid" id="lid" class="form-control">

                                                <option selected hidden disabled>Library Id</option>
                                                <?php
                                                $res1 = mysqli_query($link, "select lid from borrower where status='Activated'");
                                                while ($row1 = mysqli_fetch_array($res1)) {
                                                    echo "<option value='$row1[lid]'>$row1[lid]</option>";
                                                }
                                                ?>

                                            </select>
                                            &nbsp;&nbsp;
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <select name="isbn" id="isbn" class="form-control">
                                                <option selected hidden disabled>ISBN</option>
                                                <?php
                                                $res2 = mysqli_query($link, "select isbn from book where aquantity>0");
                                                while ($row2 = mysqli_fetch_array($res2)) {
                                                    echo "<option value='$row2[isbn]'>$row2[isbn]</option>";
                                                }
                                                ?>
                                            </select>
                                            <button class="au-btn--submit" type="submit" name="isearch">
                                                <i class="zmdi zmdi-search"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                                <?php
                                if (isset($_POST["isearch"])) {

                                    $res3 = mysqli_query($link, "select * from borrower where lid ='$_POST[lid]'");

                                    while ($row3 = mysqli_fetch_array($res3)) {
                                        $name = $row3["name"];
                                        $email = $row3["email"];

                                    }

                                    $res4 = mysqli_query($link, "select * from book where isbn ='$_POST[isbn]'");
                                    while ($row4 = mysqli_fetch_array($res4)) {
                                        $isbn = $row4["isbn"];
                                        $bname = $row4["bname"];
                                        $aname = $row4["aname"];
                                        $qty = $row4["quantity"];
                                        $aqty = $row4["aquantity"];
                                    }
                                    ?>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" id="libid" name="libid" placeholder="Library Id" required
                                                readonly class="form-control" value="<?php echo $_POST['lid'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="name" id="sname" name="sname" placeholder="Borrower Name" required
                                                readonly class="form-control" value="<?php echo $name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="semail" name="semail" placeholder="Borrower Email"
                                                required readonly class="form-control" value="<?php echo $email ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" id="in" name="in" placeholder="ISBN" class="form-control"
                                                readonly required value="<?php echo $_POST['isbn'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <input type="name" id="bname" name="bname" placeholder="Book Name" required
                                                class="form-control" value="<?php echo $bname ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Issue Date
                                            </div>
                                            <input type="date" id="idate" name="idate" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Return Date
                                            </div>
                                            <input type="date" id="rdate" name="rdate" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" name="issue">Submit</button>
                                    </div>

                                    <?php
                                }
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["issue"])) {
            $query = "INSERT INTO issue_book (lid, sname, semail, isbn, bname, issuedate, returndate, fine) VALUES ('$_POST[libid]', '$_POST[sname]', '$_POST[semail]','$_POST[in]', '$_POST[bname]', '$_POST[idate]', '$_POST[rdate]', 0)";
            $results = mysqli_query($link, $query);
            $query2 = "update book set aquantity = aquantity-1 where isbn = '$_POST[in]'";
            $result = mysqli_query($link, $query2);
            ?>
            <div class="alert alert-success col-lg-6 col-lg-push-3">
                Book issued successfully!!!
            </div>
            <?php

        }
        
include "footer.php";
?>