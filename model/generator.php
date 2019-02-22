<?php
    session_start();

    include_once("..".DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."config.php");
    ini_set('default_charset','ISO 8859-1');
    
    $csv = new Csv();
    
    if(!empty($_POST['importar']))
    {
        $_SESSION['siape'] = $_POST['siape'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['date1'] = $_POST['date1'];
        $_SESSION['date2'] = $_POST['date2'];
        $_SESSION['fileUpload'] = $_FILES['fileUpload'];

        $siape = $_POST['siape'];
        $name = $_POST['name'];
        $date1= $_POST['date1'];
        $date2 = $_POST['date2'];
        $archive = $_FILES['fileUpload'];
        $csv->importar($siape, $name, $date1, $date2, $archive);
        $importar = "";
    }

    //Aqui, pode passar o tratar dados vazio, pois estou manipulando sessão!. Mas necessita mudar no CSV e XLS.
    if(!empty($_POST['tratar']))
    {
        $csv->tratarDados($_SESSION['disciplina'], $_SESSION['data'], $_SESSION['siape'],  $_SESSION['name'], $_SESSION['date1'], $_SESSION['date2'], $_SESSION['fileUpload'], $_POST['hours'], $_POST['hours1'], $_POST['op1'], $_POST['op2']);
        $tratar = "";
    }

?>