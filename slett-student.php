<?php  /* slett-student */

include ("start.php");

include ("dynamiske-funksjoner.php");

?> 

<script src="funksjon.js"> </script>

<h3>Slett studenter</h3>

<form method="post" action="" id="slettStudent" name="slettStudent" onSubmit="return bekreft()">
  Studenter: <br />
  <?php sjekkbokserStudent(); ?> <br/>
  <input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettStudentKnapp"]))
    {
      @$fornavn=$_POST["fornavn"];
      $antall=count($fornavn);

      if ($antall==0)
        {
          print ("Ingen studenter ble valgt <br />");
        }
      else
        {
          include("db-tilkobling.php");  	
          for ($r=0;$r<$antall;$r++)
            {
              $sqlSetning="DELETE FROM student WHERE fornavn='$fornavn[$r]';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
            }
          print ("De valgte studentene er n&aring; slettet <br />");
        }
    }
  include ("slutt.php");
?> 
  
