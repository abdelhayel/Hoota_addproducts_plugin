<?php
function downloadFile($filename) {
    $file_path = 'uploads/' . $filename;
    if (file_exists($file_path)) {
        // Définir le type de contenu en tant que CSV
        header('Content-Type: text/csv');
        
        // Forcer le téléchargement du fichier avec un nom spécifié
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // Lire et renvoyer le contenu du fichier
        readfile($file_path);
        exit; // Terminer le script après le téléchargement
    } else {
        // Gérer le cas où le fichier n'existe pas
        header("HTTP/1.0 404 Not Found");
        return false;
    }
}

function deleteFile($filename) {
    $file_path = 'uploads/' . $filename;
    if (file_exists($file_path)) {
        // Supprimer le fichier
        if (unlink($file_path)) {
            return true;
        } else {
            // Gérer le cas où la suppression échoue
            header("HTTP/1.1 500 Internal Server Error");
            return false;
        }
    } else {
        // Gérer le cas où le fichier n'existe pas
        header("HTTP/1.0 404 Not Found");
        return false;
    }
}
function deleteDirectoryContents($dir) {
    if (!is_dir($dir)) {
        return false;
    }

    $files = array_diff(scandir($dir), array('.', '..'));
    $deletedCount = 0;

    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            // Si c'est un sous-répertoire, supprimez-le récursivement
            $deletedCount += deleteDirectoryContents($path);
        } else {
            // Si c'est un fichier, supprimez-le
            unlink($path);
            $deletedCount++;
        }
    }

    return $deletedCount;
}

?>
