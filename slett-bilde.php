<?php  /* slett-bilde */

include ("start.php");

include ("dynamiske-funksjoner.php");

?> 

<script src="funksjon.js"> </script>

<h3>Slett bilde</h3>

<form method="post" action="" id="slettBilde" name="slettBilde" onSubmit="return bekreft()">
  Bilder: <br />
  <?php sjekkbokserBilde(); ?> <br/>
  <input type="submit" value="Slett bilde" name="slettBildeKnapp" id="slettBildeKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettBildeKnapp"]))
    {
      @$filnavn=$_POST["filnavn"];
      $antall=count($filnavn);

      if ($antall==0)
        {
          print ("Ingen bilder ble valgt <br />");
        }
      else
        {
          include("db-tilkobling.php");  	
          for ($r=0;$r<$antall;$r++)
            {
              $sqlSetning="DELETE FROM bilde WHERE filnavn='$filnavn[$r]';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
            }
          print ("De valgte bildene er n&aring; slettet <br />");
        }
    }
  include ("slutt.php");
?> 
  
