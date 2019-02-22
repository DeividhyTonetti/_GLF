<?php
    class Donwload
    {
        // criar método construtor em vez de ficar passando parâmetros, usar o this irá simplificar e ficará
        // feito da maneira correta! SET E GET, não fiz por sacanagem.

        public function arquivos($path)
        {
            $diretorio = dir($path);
            $cont = 0;

            while($arquivo = $diretorio -> read())
            {
                if($arquivo != '..' and $arquivo != '.')
                {
                        $this->zip($path, $arquivo);
                        unlink($path.DIRECTORY_SEPARATOR.$arquivo);
                }
            }

            unlink('disciplina.zip');
            
        }


        public function zip($path, $arquivo)
        {
            $zip = new ZipArchive();
            
            if( $zip->open( 'disciplina.zip' , ZipArchive::CREATE )  === true)
            {
                $content = file_get_contents($path.DIRECTORY_SEPARATOR.$arquivo);
                $zip->addFromString(pathinfo ($arquivo, PATHINFO_BASENAME), $content);
                 
                $zip->close();

                header('Content-type: application/zip');
                header('Content-disposition: attachment; filename="disciplina.zip"');
                readfile('disciplina.zip');
            }
            
        }
    }
?>