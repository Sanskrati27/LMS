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
                        <h2 class="title-1">View Issued Books</h2>
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="student"
                                placeholder="Search for student name..." />
                            <button class="au-btn--submit" type="submit" name="search">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Library Id</th>
                                <th>Borrower Name</th>
                                <th>Borrower Email</th>
                                <th>ISBN</th>
                                <th>Book Name</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Fine</th>
                                <th>Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST["search"])) {
                                $res1 = mysqli_query($link, "select * from issue_book where sname like('$_POST[student]%')");
                                if (mysqli_num_rows($res1) == 0) {
                                    ?>
                                    <div class="alert alert-danger col-lg-6 col-lg-push-6">
                                        No data found with such name!!!
                                    </div>
                                    <?php
                                } else {
                                    while ($row1 = mysqli_fetch_array($res1)) {
                                        echo "<tr class='tr-shadow'>";
                                        echo "<td>$row1[id]</td>";
                                        echo "<td>$row1[lid]</td>";
                                        echo "<td><span class='block-email'>$row1[sname]</span></td>";
                                        echo "<td class='desc'>$row1[semail]</td>"; //email
                                        echo "<td>$row1[isbn]</td>";
                                        echo "<td><span class='block-email'>$row1[bname]</span></td>";
                                        echo "<td>$row1[issuedate]</td>";
                                        echo "<td>$row1[returndate]</td>";
                                        if ($row1["fine"] == 0) {
                                            echo "<td><span class='status--process'>$row1[fine]</span></td>";
                                        } else {
                                            echo "<td><span class='status--denied'>$row1[fine]</span></td>";
                                        }
                                        echo "<td><div>
                                <a href='return.php?id=$row1[id]'><button class='btn btn-success btn-sm' name='addb'>Return</button></a>
                                &nbsp;
                            </div></td>";
                                        echo "<tr class='spacer'></tr>";
                                    }
                                }
                            } else {
                                $res = mysqli_query($link, "select * from issue_book");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr class='tr-shadow'>";
                                    echo "<td>$row[id]</td>";
                                    echo "<td>$row[lid]</td>";
                                    echo "<td><span class='block-email'>$row[sname]</span></td>";
                                    echo "<td class='desc'>$row[semail]</td>"; //email
                                    echo "<td>$row[isbn]</td>";
                                    echo "<td><span class='block-email'>$row[bname]</span></td>";
                                    echo "<td>$row[issuedate]</td>";
                                    echo "<td>$row[returndate]</td>";
                                    if ($row["fine"] == 0) {
                                        echo "<td><span class='status--process'>$row[fine]</span></td>";
                                    } else {
                                        echo "<td><span class='status--denied'>$row[fine]</span></td>";
                                    }
                                    echo "<td><div>
                                <a href='return.php?id=$row[id]'><button class='btn btn-success btn-sm' name='addb'>Return</button></a>
                                &nbsp;
                            </div></td>";
                                    echo "<tr class='spacer'></tr>";

                                    echo "<tr class='spacer'></tr>";

                                }
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>

            <?php
            include "footer.php";
            ?>