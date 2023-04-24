<?php
$c = mysqli_connect('localhost','root','','ecommerce',3307);
if(!$c){
    die(mysqli_error($c));//it's not a error
}
?>