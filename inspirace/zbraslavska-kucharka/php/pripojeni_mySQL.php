<?php

  function pripoj_mySQL()	{
    $server = "localhost";
    $uzivatel = "havlatp";
	  $heslo = "1234";
	  $db = "kucharka";

	  $spojeni = mysqli_connect($server, $uzivatel, $heslo, $db);
    return $spojeni;
	}

  // funkce na porovnání znakové sady
	function utf8($spojeni)	{ mysqli_query($spojeni, "SET NAMES utf8"); }


	function odpoj_mySQL($spojeni) { mysqli_close($spojeni); }
	/* ----------------------------------------------------------- */
  function test_spojeni() {
    $spojeni = pripoj_mySQL();
	  utf8($spojeni);
    if($spojeni) echo "připojeno<br>";
    else "nepřipojeno<br>";

    $spojeni=odpoj_mySQL($spojeni);
    if(!$spojeni) echo "odpojeno<br>";
    else echo "asi jinej gang..<br>";
  }

?>
