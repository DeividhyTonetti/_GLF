<?php

    include_once("..".DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."config.php");

    $data = array(
        0 => array('Nr.', 'Name', 'E-Mail'),
        array(1, 'Oliver Schwarz', 'oliver.schwarz@gmail.com'),
        array(2, 'Hasematzel', 'hasematzel@gmail.com'));

    $xls = new Excel;
    $xls->addWorksheet('Names', $data);
   // $xls->sendWorkbook('test.xls');

   $csv = new Csv();

    $csv->importar();

?>