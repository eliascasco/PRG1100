<?php  

include ("start.php");


include ("dynamiske-funksjoner.php");

include ("db-tilkobling.php");

?> 

<script src="funksjon.js"> </script>

<h3>Endre Klassekode</h3>

<form method="post" action="" id="finnKlassekodeSkjema" name="finnKlassekodeSkjema">
  Klassekode: 
    <select name="klassekode" id="klassekode">
        <?php listeboksKlasse();?>
    </select> <br/>
  <input type="submit"  value="Endre Klassekode" name="endreKlassekodeKnapp" id="endreKlassekodeKnapp"> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if(isset($_POST["endreKlassekodeKnapp"]))
  {
    $klassekode=$_POST["klassekode"];

    $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
    $klassenavn=$rad["klassenavn"];
    $studiumkode=$rad["studiumkode"];

    print ("<form method='post' action='' id='endreKlasseSkjema' name='endreKlasseSkjema'>");
    print ("Klassekode <input type='text' name='klassekode' id='klassekode' value='$klassekode' readonly /> <br />");		
    print ("Klassenavn <input type='text' name='klassenavn' id='klassenavn' value='$klassenavn' required /> <br />");
    print ("Studiumkode <input type='text' name='studiumkode' id='studiumkode' value='$studiumkode' required /> <br />");
    print ("<input type='submit' value='Endre klassenavn' name='endreKlasseKnapp' id='endreKlasseKnapp'>");
    print ("</form>");
  } 

  if (isset($_POST ["endreKlasseKnapp"]))
    {
      $klassekode=$_POST["klassekode"];
      $klassenavn=$_POST["klassenavn"];
      $studiumkode=$_POST["studiumkode"];

     if (!$klassenavn || !$studiumkode)
        {
          print ("Klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */		

          $sqlSetning="UPDATE klasse SET klassenavn='$klassenavn', studiumkode='$studiumkode' WHERE klassekode='$klassekode';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
            /* SQL-setning sendt til database-serveren */
			
          print ("Klasse med klassekode $klassekode er n&aring; endret<br />");
        }
    }
  include ("slutt.php");
?> 