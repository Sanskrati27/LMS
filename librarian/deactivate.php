<?php
include "connection.php";

$id = $_GET["id"];
mysqli_query($link,"update borrower set status='Deactivated' where id=$id");

?>

<script>
    window.location = "borrowers.php";
</script>