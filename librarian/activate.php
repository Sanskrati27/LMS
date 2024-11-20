<?php
include "connection.php";

$id = $_GET["id"];
mysqli_query($link,"update borrower set status='Activated' where id=$id");

?>

<script>
    window.location = "borrowers.php";
</script>