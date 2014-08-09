<?php

/**
 * Permet la création d'une archive Zip à partir d'un dossier
 * @author Clément POUJOL alias Monobloclimber
 * @version 1
 * @copyright clementpoujol.fr
 * 
 * @param  string $dirSource
 * @param  string $dirBackup
 * @param  integer $reload
 * @param  object $oZip
 * @return dossier Zipé
 */
function createZip($dirSource,$dirBackup, $reload = null, $oZip = null) {
    // si le dossier existe
    if ($dir = opendir($dirSource)) {
        // on créait le chemin du dossier final
        $pathZip = substr($dirBackup, 0, -1).'.zip';

        //si la fonction est lancé pour la première fois on créait l'objet
        if(!$reload){
            $oZip = new ZipArchive;
            $oZip->open($pathZip, ZipArchive::CREATE);
        }// sinon on récupère l'object passé en param
        else{
            $oZip = $oZip;
        }
        
        while (($file = readdir($dir)) !== false) {
            // on évite le dossier parent et courant
            if($file != '..'  && $file != '.') {
                // Si c'est un dossier on relance la fonction
                if(is_dir($dirSource.$file)) {
                    createZip($dirSource.$file.'/', $dirBackup.$file.'/', 1, $oZip);
                }// sinon c'est un fichier donc on l'ajoute à l'archive
                else {
                    $oZip->addFile($dirSource.$file);
                }
            }
        }
        // on ferme l'archive
        if(!$reload){
            return $oZip->close();
        }
    }

}

createZip('../www/','../backup/'.date("j-m-Y_G-i").'/');