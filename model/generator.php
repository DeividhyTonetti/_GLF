<?php

    include_once("..".DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."config.php");
    ini_set('default_charset','ISO 8859-1');
    
    $csv = new Csv();

    $csv->importar();
?>