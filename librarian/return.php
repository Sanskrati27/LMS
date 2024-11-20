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
                        <h2 class="title-1">Return Book</h2>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <form action="" method="post">
                            <div class="card-header">Return Book</div>
                            <?php
                            $id = $_GET["id"];
                            $res = mysqli_query($link, "select * from issue_book where id=$id");
                            while ($row = mysqli_fetch_array($res)) {
                                $libid = $row["lid"];
                                $name = $row["sname"];
                                $email = $row["semail"];
                                $in = $row["isbn"];
                                $bname = $row["bname"];
                                $idate = $row["issuedate"];
                                $rdate = $row["returndate"];
                                $fine = $row["fine"];
                            }
                            ?>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input type="number" id="libid" name="libid" placeholder="Library Id" required
                                            readonly class="form-control" value="<?php echo $libid ?>">
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
                                            readonly required value="<?php echo $in ?>">
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
                                        <input type="date" id="idate" name="idate" class="form-control" required
                                            value="<?php echo $idate ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Return Date
                                        </div>
                                        <input type="date" id="rdate" name="rdate" class="form-control" required
                                            value="<?php echo $rdate ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Fine
                                        </div>
                                        <?php
                                        if (isset($_POST["cfine"])) {
                                            $nrdate = $_POST["rdate"];
                                            $date1 = strtotime($nrdate);
                                            $date2 = strtotime($rdate);
                                            if ($date2 < $date1) {
                                                $diff = $date1 - $date2;
                                                $days = floor($diff / (60 * 60 * 24));
                                                $fine = 2 * $days;
                                            }

                                        }
                                        ?>

                                        <input type="number" id="fine" name="fine" placeholder="Fine" required readonly
                                            class="form-control" value="<?php echo $fine ?>">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            name="return">Return</button>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" name="cfine">Calculate
                                            Fine</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["return"])) {
            try {
                $query = "INSERT INTO returned (libid, stuname, stuemail, isbn, bookname, idate, rdate, fine) VALUES ('$_POST[libid]', '$_POST[sname]','$_POST[semail]', '$_POST[in]', '$_POST[bname]', '$_POST[idate]', '$_POST[rdate]', '$_POST[fine]')";
                $results = mysqli_query($link, $query);

                echo $libid;
                echo $name;
                echo $_POST["rdate"];
            } catch (Exception $e) {
                echo $e;
            }
            $query2 = "update book set aquantity = aquantity+1 where isbn =$in";
            $result1 = mysqli_query($link, $query2);

            $sql = "DELETE FROM issue_book WHERE id=$id";
            $result2 = mysqli_query($link, $sql);
            ?>
            <div class="alert alert-success col-lg-6 col-lg-push-3">
                Book returned successfully!!!
            </div>
            <script>
                window.location = "viewreturnedbooks.php";
            </script>

            <?php
        }
        include "footer.php";
        ?>