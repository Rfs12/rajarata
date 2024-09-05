<?php
$servername="localhost";
$username="root";
$password="";
$database="rajarata_system";

$conn=new mysqli($servername,$username,$password,$database);

if($conn==true){
   
}
else{
    echo 'you have db connection issue';
}