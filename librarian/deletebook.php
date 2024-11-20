<?php
include "connection.php";

$id = $_GET["id"];
mysqli_query($link,"delete from book where id=$id");

?>

<script>
    window.location = "book.php";
</script>