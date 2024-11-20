<?php
session_start();
if (!isset($_SESSION["semail"])) {
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
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Library Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>ISBN</th>
                                <th>Book Name</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($link, "select * from issue_book where semail='$_SESSION[semail]'");
                            while ($row = mysqli_fetch_array($res)) {
                                echo "<tr class='tr-shadow'>";
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
                                echo "<tr class='spacer'></tr>";

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