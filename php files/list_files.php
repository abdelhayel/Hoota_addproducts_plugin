<?php
function listFiles($dir){
    $files = [];
    $items = scandir($dir, SCANDIR_SORT_DESCENDING);
    
    foreach ($items as $item) {
        if ($item != "." && $item != "..") {
            $path = $dir . '/' . $item;
            if (is_dir($path)) {
                // Si c'est un répertoire, listez ses fichiers récursivement
                $files = array_merge($files, listFiles($path));
            } else {
                // Si c'est un fichier, ajoutez-le à la liste
                $files[] = $path;
            }
        }
    }
    
    return $files;
}

$dir = 'uploads';
$files = listFiles($dir);

echo "<ul>";
foreach ($files as $file) {
    echo "<li><a href='$file' download>" . basename($file) . "</a></li>";
}
echo "</ul>";
?>
