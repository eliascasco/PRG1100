<?php  

include ("start.php");

include ("dynamiske-funksjoner.php");

include ("db-tilkobling.php");

?> 

<script src="funksjon.js"> </script>

<h3>Endre student</h3>

<form method="post" action="" id="finnStudentSkjema" name="finnStudentSkjema">
  Student: 
    <select name="brukernavn" id="brukernavn">
        <?php listeboksStudent();?>
    </select> <br/>
  <input type="submit"  value="Velg" name="endreStudent" id="endreStudent"> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br /> <br/>
</form>

<?php
  if (isset($_POST ["endreStudent"]))
    {
      $brukernavn=$_POST ["brukernavn"];
	  
      include("db-tilkobling.php");  /* tilkobling til database-server og valg av database utført */ 

      $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $brukernavn=$rad["brukernavn"];
      $fornavn=$rad["fornavn"];
      $etternavn=$rad["etternavn"];
      $klassekode=$rad["klassekode"];
      $bildeNr=$rad["bildeNr"];

      print ("<form method='post' action='' id='endrePoststedSkjema' name='endrePoststedSkjema'>");
      print ("Brukernavn <input type='text' name='brukernavn' id='brukernavn' value='$brukernavn' readonly /> <br />");		
      print ("Fornavn <input type='text' name='fornavn' id='fornavn' value='$fornavn' required /> <br />");
      print ("Etternavn <input type='text' name='etternavn' id='etternavn' value='$etternavn' /> <br />");
      print ("Klassekode <select name='klassekode' id='klassekode'>"); print("<option value=''>Velg klassekode </option>"); listeboksKlasse($klassekode); print ("</select> <br />"); 
      print ("Bildenummer <select name='bildeNr' id='bildeNr'>"); print("<option value=''>Velg bilde</option>"); listeboksBilde($bildeNr); print ("</select> <br />"); 
      print ("<input type='submit' value='Endre student' name='endreStudentKnapp' id='endreStudentKnapp'>");
      print ("</form>");
    }

  if (isset($_POST ["endreStudentKnapp"]))
    {
      $brukernavn=$_POST["brukernavn"];
      $fornavn=$_POST["fornavn"];
      $etternavn=$_POST["etternavn"];
      $klassekode=$_POST["klassekode"];
      $bildeNr=$_POST["bildeNr"];

     if (!$fornavn || !$fornavn)
        {
          print ("Fornavn og etternavn må fylles ut fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */		

          $sqlSetning="UPDATE student SET fornavn='$fornavn',etternavn='$etternavn',klassekode='$klassekode',bildeNr='$bildeNr' WHERE brukernavn='$brukernavn';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
            /* SQL-setning sendt til database-serveren */
			
          print ("Student med brukernavn $brukernavn er n&aring; endret<br />");
        }
    }
  include ("slutt.php");
?> 