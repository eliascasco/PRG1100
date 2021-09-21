<?php  /* vis-alle-poststeder */
/*
/*  Programmet skriver ut alle registrerte poststeder
*/
  include("start.php");
  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM bilde;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte bilde</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>BildeNr</th> <th align=left>Opplastningsdato</th> <th align=left>Filnavn</th><th align=left>Beskrivelse</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $bildeNr=$rad[0];   
      $opplastningsdato=$rad[1];   
      $filnavn=$rad[2];   
      $beskrivelse=$rad[3];   

      print ("<tr> <td> $bildeNr </td> <td> $opplastningsdato </td> <td> $filnavn </td> <td> $beskrivelse </td></tr>");
    }
  print ("</table>"); 
?>