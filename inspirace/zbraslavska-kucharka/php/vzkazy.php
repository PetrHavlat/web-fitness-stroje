<?php
 $soubor = fopen("navstevni_kniha.txt", "r") or die("Soubor nelze otevřít!");
 echo "<link rel='stylesheet' href='../css/kucharka.css' type='text/css'>";
 echo fread($soubor,filesize("navstevni_kniha.txt"));
 fclose($soubor);
?>