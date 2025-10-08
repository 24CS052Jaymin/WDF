delete_event.php

<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("DELETE FROM events WHERE id=$id");
}
header("Location: index.php");
?>