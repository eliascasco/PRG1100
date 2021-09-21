<?php  /* sok-i-db */
/*
/*    Programmet demonstrerer søk i databasetabeller
*/
include ("start.php");
?> 

<h3>S&oslashk etter student</h3>

<form method="post" action="" id="sokeSkjema" name="sokeSkjema">
    S&oslash;kestreng: <input type="text" id="sokestreng" name="sokestreng" required /> <br/>
    <input type="submit" value="Fortsett" id="sokeKnapp" name="sokeKnapp" /> 
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["sokeKnapp"]))
    {
      $sokestreng=$_POST ["sokestreng"];

      include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

      print ("Treff for s&oslash;kestrengen <strong>$sokestreng</strong> <br /><br />");  
	  
      /* søk i KLASSE-tabellen*/

      /* søk i STUDENT-tabellen*/

      $sqlSetning="SELECT * FROM student WHERE brukernavn LIKE '%$sokestreng%' OR fornavn LIKE '%$sokestreng%' OR bildeNr LIKE '%$sokestreng%' OR klassekode LIKE '%$sokestreng%' OR etternavn LIKE '%$sokestreng%';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat); 

      if ($antallRader==0) 
        {
          print ("Treff i STUDENT-tabellen: <br /> Ingen <br /> <br />");  
        }
      else 
        {
          print ("Treff i STUDENT-tabellen: <br />");  /* starten på tabellen definert */
          print ("<table border=1>");  /* starten på tabellen definert */
          print ("<tr><th align=left>brukernavn - fornavn - fornavn - etternavn - klassekode - bildenr</th> </tr>");

          for ($r=1;$r<=$antallRader;$r++)
            {
              $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
              $brukernavn=$rad["brukernavn"];      
              $fornavn=$rad["fornavn"];   
              $etternavn=$rad["etternavn"];   
              $klassekode=$rad["klassekode"];   
              $bildenr=$rad["bildeNr"];   


              $sokestrenglengde=strlen($sokestreng);  /* lengden på sokestrengen */
			  
              print("<tr><td> ");
              $tekst="$brukernavn - $fornavn - $etternavn - $klassekode - $bildenr";  /* første tekststreng */
              $startpos=stripos($tekst,$sokestreng);  /* første startpos */

              while ($startpos!==false)
                { 
                  $tekstlengde=strlen($tekst);  /* lengden på teksten */

                  $hode=substr($tekst,0,$startpos);  
                  $sok=substr($tekst,$startpos,$sokestrenglengde);  
                  $hale=substr($tekst,$startpos+$sokestrenglengde,$tekstlengde-$startpos-$sokestrenglengde);

                  print("$hode<strong><font color='yellow'>$sok</font></strong>");  /* deler av utskriften*/

                  $tekst=$hale;/* ny tekst = nåværende hale */
                  $startpos=stripos($tekst,$sokestreng);  /* ny startpos */
                } 
                print("$hale</td></tr>");  /* utskrift av siste hale */
            }
          print ("</table> </br />"); 
        }
    }
  include ("slutt.php");
?> 