<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db-dtpage');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


/* MYSQL QUERY
CREATE TABLE tbl_classes (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    group_name VARCHAR(128) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    description VARCHAR( 256 ) NOT NULL ,
	created_by int(11) NOT NULL
);

CREATE TABLE tbl_uploads (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	file_name varchar(128) NOT NULL,
  	group_name varchar(128) NOT NULL,
  	default_name varchar(128) NOT NULL,
  	description varchar(256) NOT NULL,
  	phase_name varchar(128) NOT NULL,
  	size bigint(20) NOT NULL,
  	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  	created_by int(11) NOT NULL,
  	file_type varchar(10) NOT NULL,
  	PRIMARY KEY (`id`)
) ;

CREATE TABLE tbl_users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
);
*/
?>

