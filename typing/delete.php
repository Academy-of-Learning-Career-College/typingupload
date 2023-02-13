<?php

$folder = "uploads/";

if (isset($_POST['delete'])) {
    $file = $_POST['file'];
    $filePath = $folder . $file;
    if (unlink($filePath)) {
        header("Location: list.php");
    } else {
        echo "Failed to delete file.";
    }
}

?>
