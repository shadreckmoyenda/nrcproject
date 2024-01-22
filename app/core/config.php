<?php


define("APP_NAME", "NRC");


if ($_SERVER['SERVER_NAME'] == "localhost") {

 	// for local server
	define("ROOT", "http://localhost/nrc");

	define("DBDRIVER", "mysql");
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "nrc_db");

}else{

	// for online server
	define("ROOT", "http://www.nrc.ac.mw");

	define("DBDRIVER", "mysql");
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "nrc_db");
} 