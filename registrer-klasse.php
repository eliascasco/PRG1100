<?php

include("start.php"); 

?>

<h2>Registering av klasser</h2>

<script src="klasse_valid.js"></script>
    
    <form method="post" action="" id="innlevering1" name="innlevering1">
        
           Klassekode:<input type="text" id="klassekode" name="klassekode" required><br>
           Klassenavn:<input type="text" id="klassenavn" name="klassenavn" required><br>
           Studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
          <input type="submit" value="Registrer klassekode" id="registrerKlassekodeKnapp" name="registrerKlassekodeKnapp" /> 
          <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
        
    </form>

    <?php 
  if (isset($_POST ["registrerKlassekodeKnapp"]))
    {
      $klassekode=$_POST ["klassekode"];
      $klassenavn=$_POST ["klassenavn"];
      $studiumkode=$_POST ["studiumkode"];

      if (!$klassekode || !$klassenavn || !$studiumkode)
        {
          print ("B&aring;de klassekode, klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* poststedet er registrert fra før */
            {
              print ("Klassekoden er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klassekode','$klassenavn','$studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klasse er n&aring; registrert: $klassekode - $klassenavn - $studiumkode"); 
            }
        }
    }
?> 