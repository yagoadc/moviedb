<?php

//DB configuration Constants
 //PDO Database Connection
if(!defined('host'))
	define('host', 'localhost');
if(!defined('user'))
     define('user', 'yago');
if(!defined('pass'))
     define('pass', 'mysqldcc');
 if(!defined('db'))  
    define('db', 'MOVIE');   

 try {
     $db = new PDO('mysql:host='.host.';dbname='.db, user,pass);
     $db->exec("set names utf8");
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // echo "Conexion Exitosa";
     } catch(PDOException $e) {
     echo 'ERROR: ' . $e->getMessage();
     }
?>