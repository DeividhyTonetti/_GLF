<?php 

function incluirClasses($nomeClasse)
{
	if (file_exists($nomeClasse.".php") === true) 
	{
		require_once($nomeClasse.".php");
	}
}

	spl_autoload_register("incluirClasses");
	spl_autoload_register(function($nomeClasse)
	{
		if (file_exists("..".DIRECTORY_SEPARATOR."controller".DIRECTORY_SEPARATOR."class".DIRECTORY_SEPARATOR. $nomeClasse.".php") === true) 
		{
			require_once("..".DIRECTORY_SEPARATOR."controller".DIRECTORY_SEPARATOR."class".DIRECTORY_SEPARATOR. $nomeClasse.".php");
		}
		else
		{
			require_once("controller".DIRECTORY_SEPARATOR."class".DIRECTORY_SEPARATOR. $nomeClasse.".php");
		}
	});


?>