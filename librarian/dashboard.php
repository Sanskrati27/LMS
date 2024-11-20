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
                        <h2 class="title-1">Dashboard</h2>

                    </div>
                </div>
            </div>
            <?php
            $query="select * from borrower";
            $query1="select * from book";
            $query2="select * from issue_book";

            $result1=mysqli_query($link,$query);
            $result2=mysqli_query($link,$query1);
            $result3=mysqli_query($link,$query2);

            $row1 = mysqli_num_rows($result1);
            $row2 = mysqli_num_rows($result2);
            $row3 = mysqli_num_rows($result3);
            ?>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2><?php echo $row1 ?></h2>
                                    <span>Borrowers</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-book-image"></i>
                                </div>
                                <div class="text">
                                    <h2><?php echo $row2 ?></h2>
                                    <span>Books</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-format-list-bulleted"></i>
                                </div>
                                <div class="text">
                                    <h2><?php echo $row3 ?></h2>
                                    <span>Issued Books</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>


            <?php
            include "footer.php";
            ?>