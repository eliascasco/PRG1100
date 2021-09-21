<?php  

include ("start.php");


include ("dynamiske-funksjoner.php");

include ("db-tilkobling.php");

?> 

<script src="funksjon.js"> </script>

<h3>Endre bilde</h3>

<form method="post" action="" id="finnBildeSkjema" name="finnBildeSkjema">
  Bilde: 
    <select name="bildeNr" id="bildeNr">
        <?php listeboksBilde();?>
    </select> <br/>
  <input type="submit"  value="Velg" name="endreBilde" id="endreBilde"> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if(isset($_POST["endreBilde"]))
  {
    $bildeNr=$_POST["bildeNr"];

    $sqlSetning="SELECT * FROM bilde WHERE bildeNr='$bildeNr';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
    $bildeNr=$rad["bildeNr"];
    $filnavn=$rad["filnavn"];
    $dato=$rad["opplastningsdato"];
    $beskrivelse=$rad["beskrivelse"];

    print ("<form method='post' action='' id='endreKlasseSkjema' name='endreKlasseSkjema'>");
    print ("Bildenummer <input type='text' name='bildeNr' id='bildeNr' value='$bildeNr' readonly /> <br />");		
    print ("Filnavn <input type='text' name='filnavn' id='filnavn' value='$filnavn' required /> <br />");
    print ("Beskrivelse <input type='text' name='beskrivelse' id='beskrivelse' value='$beskrivelse' required /> <br />");
    print ("Opplastningsdato <input type='date' name='dato' id='dato' value='$dato' required /> <br />");
    print ("<input type='submit' value='Endre Bilde' name='endreBildeKnapp' id='endreBildeKnapp'>");
    print ("</form>");
  } 

  if (isset($_POST ["endreBildeKnapp"]))
    {
      $bildeNr=$_POST["bildeNr"];
      $filnavn=$_POST["filnavn"];
      $dato=$_POST["dato"];
      $beskrivelse=$_POST["beskrivelse"];

     if (!$filnavn || !$beskrivelse)
        {
          print ("Filnavn  og beskrivelse må fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */		

          $sqlSetning="UPDATE bilde SET bildeNr='$bildeNr', filnavn='$filnavn', beskrivelse='$beskrivelse', opplastningsdato='$dato' WHERE bildeNr='$bildeNr';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
            /* SQL-setning sendt til database-serveren */
			
          print ("Bilde med bildenummer $bildeNr er n&aring; endret<br />");
        }
    }
  include ("slutt.php");
?> 