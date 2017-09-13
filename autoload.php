<?php
spl_autoload_register(function ($class_name) {
    include __DIR__.'/'.str_replace("\\", "/", $class_name) . '.class.php';
//	spl_autoload(str_replace("\\","/", $class_name) . '.class.php');
});
 ?>
