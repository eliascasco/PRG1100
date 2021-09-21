<?php  /* registrer-klassekode */
/*
/*  Programmet lager et html-skjema for å registrere et klassekode
/*  Programmet registrerer data (klassekode, klassenavn og studiumkode) i databasen
*/
include ("start.php");
?> 

<h3>Registrer bilde</h3>

<form method="post" action="" id="registrerBildeSkjema" name="registrerBildeSkjema">
  Filnavn <input type="text" id="filnavn" name="filnavn" required /> <br/>
  Bildenummer <input type="text" id="bildeNr" name="bildeNr" required /> <br/>
  Beskrivelse <input type="text" id="beskrivelse" name="beskrivelse" required /> <br/>
  Opplastningsdato <input type="date" id="opplastningsdato" name="opplastningsdato" required /> <br/>
  <input type="submit" value="Registrer Bilde" id="registrerBildeKnapp" name="registrerBildeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerBildeKnapp"]))
    {
      $bildeNr=$_POST ["bildeNr"];
      $opplastningsdato=$_POST ["opplastningsdato"];
      $filnavn=$_POST ["filnavn"];
      $beskrivelse=$_POST ["beskrivelse"];

      if (!$bildeNr || !$opplastningsdato || !$filnavn || !$beskrivelse)
        {
          print ("B&aring;de bildeNr, opplastningsdato, filnavn og beskrivelse m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM bilde WHERE bildeNr='$bildeNr';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* poststedet er registrert fra før */
            {
              print ("Bilde er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO bilde VALUES('$bildeNr','$opplastningsdato','filnavn','beskrivelse');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende bilde er n&aring; registrert: $bildeNr - $opplastningsdato - $filnavn - $beskrivelse"); 
            }
        }
    }
  include("slutt.php");
?> 