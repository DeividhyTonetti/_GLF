<?php

    include_once("..".DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."config.php");
    ini_set('default_charset','ISO 8859-1');
    
    $siape = $_POST['siape'];
    $name = $_POST['name'];
    $hours = $_POST['hours'];
    $date1= $_POST['date1'];
    $date2 = $_POST['date2'];
    $archive = $_FILES['fileUpload']);

    $csv = new Csv();

   //$csv->importar();
?>