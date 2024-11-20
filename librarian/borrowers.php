<?php
session_start();
if (!isset($_SESSION["aemail"])) {
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
                        <h2 class="title-1">Borrowers</h2>
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="student"
                                placeholder="Search for borrowers name..." />
                            <button class="au-btn--submit" type="submit" name="search">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <a href="addborrower.php"><button class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>add borrower</button></a>
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
                                <th>name</th>
                                <th>email</th>
                                <th>Library Id</th>
                                <th>status</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST["search"])) {
                                $res1 = mysqli_query($link, "select * from borrower where name like('$_POST[student]%')");
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
                                        echo "<td>$row1[name]</td>";
                                        echo "<td><span class='block-email'>$row1[email]</span></td>";
                                        echo "<td>$row1[lid]</td>";
                                        if ($row1["status"] == "Activated") {
                                            echo "<td><span class='status--process'>$row1[status]</span></td>";
                                        } else {
                                            echo "<td><span class='status--denied'>$row1[status]</span></td>";
                                        }

                                        echo "<td><div>
                                <a href='activate.php?id=$row1[id]'><button class='btn btn-success btn-sm' name='addb'>Activate</button></a>
                                &nbsp;<a href='deactivate.php?id=$row1[id]'><button class='btn btn-danger btn-sm' name='addb'>Deactivate</button></a>
                            </div></td>";
                                        echo "<td><div>
                                <a href='deleteborrower.php?id=$row[id]'><button class='btn btn-danger btn-sm' name='deleteb'>Delete</button></a>
                            </div></td>";
                                        echo "<tr class='spacer'></tr>";
                                    }
                                }
                            } else {
                                $res = mysqli_query($link, "select * from borrower");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr class='tr-shadow'>";
                                    echo "<td>$row[id]</td>";
                                    echo "<td>$row[name]</td>";
                                    echo "<td><span class='block-email'>$row[email]</span></td>";
                                    echo "<td>$row[lid]</td>";
                                    if ($row["status"] == "Activated") {
                                        echo "<td><span class='status--process'>$row[status]</span></td>";
                                    } else {
                                        echo "<td><span class='status--denied'>$row[status]</span></td>";
                                    }
                                    echo "<td><div>
                                    <a href='activate.php?id=$row[id]'><button class='btn btn-success btn-sm' name='addb'>Activate</button></a>
                                    &nbsp;<a href='deactivate.php?id=$row[id]'><button class='btn btn-danger btn-sm' name='addb'>Deactivate</button></a>
                                </div></td>";
                                    echo "<td><div>
                                <a href='deleteborrower.php?id=$row[id]'><button class='btn btn-danger btn-sm' name='deleteb'>Delete</button></a>
                            </div></td>";
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