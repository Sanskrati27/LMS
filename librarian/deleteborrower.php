<?php
include "connection.php";

$id = $_GET["id"];
mysqli_query($link,"delete from borrower where id=$id");

?>

<script>
    window.location = "borrowers.php";
</script>