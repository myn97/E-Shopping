<?php
//Code creating databases

$con = mysql_connect('localhost','root','');
$sql = 'CREATE DATABASE shopping';
$query = mysql_query( $sql );
mysql_select_db('shopping') or die('Connection failed');
$sql = 'CREATE TABLE customers(
 serial int NOT NULL auto_increment PRIMARY KEY,
 name varchar(20) NOT NULL,
 email varchar(80) NOT NULL,
 address varchar(80) NOT NULL,
 phone varchar(20) NOT NULL)';
 $query = mysql_query( $sql );

$sql = 'CREATE TABLE products(
 serial int NOT NULL auto_increment PRIMARY KEY,
 name varchar(20) NOT NULL,
 description varchar(255) NOT NULL,
 price float NOT NULL,
 picture varchar(80) NOT NULL )';
$query = mysql_query( $sql );

$sql = 'CREATE TABLE orders(
 serial int NOT NULL auto_increment PRIMARY KEY,
 date date NOT NULL,
 customerid int NOT NULL)';
$query = mysql_query( $sql );

$sql = 'CREATE TABLE order_detail(
 orderid int NOT NULL,
 productid int NOT NULL,
 quantity int NOT NULL,
 price float NOT NULL)';
$query = mysql_query( $sql );

$sql = "INSERT INTO products(name ,description ,price
,picture) VALUES('Gun', 'A powerful locally made weapon holding 30 rounds', 250, 'images/img3.JPG')";
$query = mysql_query( $sql );

$sql = "INSERT INTO products(name ,description ,price
,picture) VALUES('Spray','A powerful locally made weapon holding 20 rounds', 80,
'images/img2.jpg')";
$query = mysql_query( $sql );

$sql = "INSERT INTO products(name ,description ,price
,picture) VALUES('firearm Gun', 'A powerful locally made weapon holding 20 rounds', 50, 'images/img1.jpg')";
$query = mysql_query( $sql ); 


 
$sql = 'select * from orders ';
 $query = mysql_query( $sql );
print "<table border=1 bgcolor=red>";
while($a=mysql_fetch_row($query) )
{
Print "<tr><td>".$a[0]."</td>";
Print "<td>".$a[1]."</td>";
Print "<td>".$a[2]."</td></tr>";
}
Print "</table>";
 mysql_close();
?> 