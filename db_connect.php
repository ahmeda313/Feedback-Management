<?php
try{
$con=mysqli_connect("localhost","root","root","review_system");
if(!$con){
    echo"Something went wrong";
}}
catch(Exception){
    echo"Something went wrong";
}
?>