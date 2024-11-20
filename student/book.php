<?php
session_start();
if(!isset($_SESSION["semail"])){
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
                        <h2 class="title-1">Books </h2>
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="book"
                                placeholder="Search for book name..." />
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
                                <th>ISBN</th>
                                <th>Book Image</th>
                                <th>Book Name</th>
                                <th>Author Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST["search"])) {
                                $res1 = mysqli_query($link, "select * from book where bname like('$_POST[book]%')");
                                if (mysqli_num_rows($res1) == 0) {
                                    ?>
                                    <div class="alert alert-danger col-lg-6 col-lg-push-6">
                                        No data found with such name!!!
                                    </div>
                                    <?php
                                } else {
                                    while ($row1 = mysqli_fetch_array($res1)) {
                                        echo "<tr class='tr-shadow'>";
                                    echo "<td>$row1[isbn]</td>";
                                    echo "<td><img src='../librarian/$row1[bimage]' height='100' width='100'></td>";//book image column
                                    echo "<td><span class='block-email'>$row1[bname]</span></td>";
                                    echo "<td><span class='block-email'>$row1[aname]</span></td>";
                                    echo "<tr class='spacer'></tr>";
                                    }
                                }
                            } else {
                                $res = mysqli_query($link, "select * from book");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr class='tr-shadow'>";
                                    echo "<td>$row[isbn]</td>";
                                    echo "<td><img src='../librarian/$row[bimage]' height='100' width='100'/></td>";//book image column
                                    echo "<td><span class='block-email'>$row[bname]</span></td>";
                                    echo "<td><span class='block-email'>$row[aname]</span></td>";
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