<?php  /

  $host="localhost";
  $user="root";  
  $password=" ";  
  $database=" ";     
    /* verdier satt for host, user, password og database for tilkobling til databaseserver */

  $db = mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");
    /* tilkobling til database-serveren utført */
 
?>