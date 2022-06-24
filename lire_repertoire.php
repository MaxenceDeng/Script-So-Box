<?php
require_once 'connexion.php';

$largeur_vignette = 200;
$hauteur_vignette = 200;

$source = "";
$destination = "";

function creationVignette($source, $chemin_vignette, $largeur_vignette, $hauteur_vignette)
{
    list($largeur_image, $hauteur_image, $original_type) = getimagesize($source);

    if ($largeur_image > $hauteur_image) {
        $new_largeur = $largeur_vignette;
        $new_hauteur = intval($hauteur_image * $new_largeur / $largeur_image);
    } else {
        $new_hauteur = $hauteur_vignette;
        $new_largeur = intval($largeur_image * $new_hauteur / $hauteur_image);
    }

    $dest_x = intval(($largeur_vignette - $new_largeur) / 2);
    $dest_y = intval(($hauteur_vignette - $new_hauteur) / 2);

    if ($original_type === 1) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    } else if ($original_type === 2) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    } else {
        return false;
    }

    $old_image = $imgcreatefrom($source);
    $new_image = imagecreate($largeur_vignette, $hauteur_vignette);

    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_largeur, $new_hauteur, $largeur_image, $hauteur_image);
    $imgt($new_image, $chemin_vignette);
    return file_exists($chemin_vignette);
}

echo creationVignette($source, $destination, $largeur_vignette, $hauteur_vignette);

?>