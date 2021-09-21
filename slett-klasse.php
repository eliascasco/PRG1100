<?php  /* slett-klasse */

include ("start.php");

include ("dynamiske-funksjoner.php");

include ("db-tilkobling.php"); 

?> 

<script src="funksjon.js"> </script>

<h3>Slett klasser</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klasser: <br />
  <?php sjekkbokserKlasse(); ?> <br/>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {
      @$klassekode=$_POST ["klassekode"];
      $antall=count($klassekode);

      if ($antall==0)
        {
          print ("Ingen klasser ble valgt <br />");
        }
      else
        { 	
          for ($r=0;$r<$antall;$r++)
            {
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode[$r]';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
            }
          print ("De valgte klassene er n&aring; slettet <br />");
        }
    }
  include ("slutt.php");
?> 
  
