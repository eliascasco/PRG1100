<?php

include ("start.php");

include ("dynamiske-funksjoner.php");

?>

  <h3>Registrering av student </h3>

  <form method="post" action="" id="innlevering1" name="innlevering1">

  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br/>
          Brukernavn:<input type="text" id="brukernavn" name="brukernavn" required><br>
          Fornavn:<input type="text" id="fornavn" name="fornavn" required><br>
          Etternavn:<input type="text" id="etternavn" name="etternavn" required><br>
          Bildenummer: 
          <select name="bildenr" id="bildenr">
              <option value="">Velg bilde</option>
              <?php listeboksBilde(); ?> 
          </select> </br>
          Klasse:   
            <select name="klassekode" id="klassekode">
              <option value="">Velg klassekode</option>
              <?php listeboksKlasse(); ?> 
          </select> </br>
         
    </form>
        
<?php 
if (isset($_POST ["registrerStudentKnapp"]))
  {
    $brukernavn=$_POST ["brukernavn"];
    $fornavn=$_POST ["fornavn"];
    $etternavn=$_POST ["etternavn"];
    $klassekode=$_POST ["klassekode"];
    $bildenr=$_POST ["bildenr"];

    if (!$brukernavn || !$fornavn || !$etternavn)
      {
  print ("Både brukernavn, fornavn, etternavn, klassenavn og bildenummer må fylles ut");
}
else
{
  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat); 

  if ($antallRader!=0)  /* student er registrert fra før */
  {
    print ("Studenten er registrert fra før");
  }
else
    {
    $sqlSetning="INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode','$bildenr');";
    mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
      /* SQL-setning sendt til database-serveren */

    print ("Følgende student er nå registrert: $brukernavn - $fornavn - $etternavn - $klassekode - $bildenr"); 
    }
  }
} 
?> 

