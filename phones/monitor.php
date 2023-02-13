

$contents = file_get_contents($file);
echo $contents;

// while (true) {
//     clearstatcache();
//     $lastModified = filemtime($file);
//     echo "no change"
//     sleep(1);

//     clearstatcache();
//     if (filemtime($file) > $lastModified) {
//         $contents = file_get_contents($file);
//         echo $contents;
//     }
// }

?>
