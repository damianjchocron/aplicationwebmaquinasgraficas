<?php

function controllers_autoload($classname){
	$fileName = "controllers/" . $classname . '.php'; // Declaro variable con nombre de clase
	if (is_file($fileName)) include $fileName; // PRegunto si el archivo existe.
}

spl_autoload_register('controllers_autoload'); //Nativo de php, esto espera un callback