<?php

$servername = "localhost";
$username = "root";
$password = "";
$DB = "X";



$conn=mysqli_connect("localhost","root","","X");


        if(!$conn){
            die("connection failed ". mysqli_connect_error());
        }
