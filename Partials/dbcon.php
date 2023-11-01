<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$database="project2";
$conn= mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Sorry connection not made". mysqli_connect_error());
}
?>