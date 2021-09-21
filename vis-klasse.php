<?php

include("start.php");

?>

  <h3>Vis alle klasser</h3> 

  <form method="post" action="" id="innlevering1" name="innlev1">
        </form>

<?php  /* vis-alle-klassekoder */
/*
/*  Programmet skriver ut alle registrerte klassekoder
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM klasse;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte klassekode</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>Klassekode</th> <th align=left>Klassenavn</th> <th align=left>Studiumkode</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $klassekode=$rad[0];   
      $klassenavn=$rad[1];   
      $studiumkode=$rad[2];   

      print ("<tr> <td> $klassekode </td> <td> $klassenavn </td> <td> $studiumkode </td> </tr>");
    }
  print ("</table>"); 
?>

