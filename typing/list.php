<?php

$folder = "uploads/";

if ($handle = opendir($folder)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $fileExtension = pathinfo($entry, PATHINFO_EXTENSION);
            if ($fileExtension == "pdf") {
                echo "<a href='" . $folder . $entry . "' download>" . $entry . "</a>";
                echo "<form action='delete.php' method='post'>";
                echo "<input type='hidden' name='file' value='" . $entry . "'>";
                echo "<input type='submit' value='Delete' name='delete'>";
                echo "</form>";
                echo "<br>";
            }
        }
    }
    closedir($handle);
}

?>
