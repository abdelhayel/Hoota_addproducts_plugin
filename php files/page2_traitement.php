<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Message de résultat</title>
    
    <!-- Meta tags, CSS links, etc. -->
    <style>
        .message-wrapper {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgb(158, 241, 221);
        }

        .message-unknown-error {
            margin-top: 0%;
            font-size: 36px;
            font-weight: bold;
            text-align: center;
        }

        .message {
            max-width: 600px;
            width: 100%;
            text-align: center;
            line-height: 1.6;
            font-size: 18px;
            margin-top: 30px;
        }

        .message a {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 18px;
            text-decoration: none;
            text-transform: uppercase;
            background: transparent;
            color: #c9c9c9;
            border: 3px solid #c9c9c9;
            display: inline-block;
            padding: 15px 30px;
            font-weight: 700;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
            margin-top: 20px;
        }

        .message a:hover {
            color: #ffab00;
            border-color: #ffab00;
        }
        .btn-page-accueil a {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 18px;
            text-decoration: none;
            text-transform: uppercase;
            background: transparent;
            color: #c9c9c9;
            border: 3px solid #c9c9c9;
            display: inline-block;
            padding: 15px 30px;
            font-weight: 700;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
            margin-top: 20px;
        }

        .btn-page-accueil a:hover {
            color: #ffab00;
            border-color: #ffab00;
        }
    </style>
</head>
<body>
<div class="message-wrapper">   
    <div class="message">
        <?php
                include 'file_functions.php';

                $operationSucceeded = false; // Variable pour suivre si l'opération réussit

                if (isset($_POST['downloadFiles'])) {
                include 'list_files.php'; // Inclure le fichier list_files.php pour afficher la liste des fichiers
                 $fileCount = countFiles('uploads');
                    
                if ($fileCount > 0) {
                echo "Téléchargement effectué ! $fileCount fichier(s) existant(s).";
                $operationSucceeded = true;
                } else {
                echo "Opération échouée ! Aucun fichier n'existe.";
                }
                } elseif (isset($_POST['deleteFiles'])) {
                $dir = 'uploads';
                $deletedCount = deleteDirectoryContents($dir);
    
                if ($deletedCount !== false) {
                    if ($deletedCount > 0) {
                        echo "Suppression réussie du contenu du répertoire 'uploads'. $deletedCount fichier(s) supprimé(s).";
                } else {
                        echo "Aucun fichier n'existe dans le répertoire 'uploads'.";
                }
    } else {
        echo "Une erreur s'est produite lors de la suppression des fichiers.";
    }
}

    function countFiles($dir) {
    $fileCount = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $fileCount++;
        }
    }
    
    return $fileCount;
    }
?>
        </div>
        <div class="btn-page-accueil">
            <a href="index.html">Retourner à la page d'accueil</a>
        </div>
    </div>
</body>

</html>
