<?php
 /* Arquivo de configuração que faz o autoload das classes */
 spl_autoload_register(function($class_name){
	 
	 //Indica onde as classes estão armazenadas (neste caso dentro da pasta 'class')
	 $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php"; 
	 
	 echo "<br>".$filename."<br>";
	 
	 if(file_exists($filename)) {
		 require_once($filename);
	 }	 
 });
  
?>