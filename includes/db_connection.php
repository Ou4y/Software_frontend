<?php
/*
starting a connection on $conn variabl
----------------------------------------
using mysqli_connect()    with parameters:
1- localhost =>name of the server which serve the db 
2-username
3- password
4- name of the database
*/
$conn=mysqli_connect("localhost","root","","X");
//-------------------------------------------------------------


//checking the connection of the db and printing an error message or a success message

        if(!$conn){
            die("connection failed ". mysqli_connect_error());
        }
        else
        echo "conneced...";