<?php

include("start.php");

include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM student;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte studenter</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>Brukernavn</th> <th align=left>Fornavn</th> <th align=left>Etternavn</th><th align=left>Klassekode</th><th align=left>BildeNr</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $brukernavn=$rad[0];   
      $fornavn=$rad[1];   
      $etternavn=$rad[2];   
      $klassekode=$rad[3];   
      $bildeNr=$rad[4];   

      print ("<tr> <td> $brukernavn </td> <td> $fornavn </td> <td> $etternavn </td>  <td> $klassekode </td>  <td> $bildeNr </td> </tr>");
    }
  print ("</table>"); 
?>