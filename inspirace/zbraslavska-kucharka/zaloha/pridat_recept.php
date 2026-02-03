<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>Bubákova kuchařka</title>
    <meta charset='utf-8'>
    <meta name='description' content='České i zahraniční recepty'>
    <meta name='author' content='Petr Havlát'><meta name='copyright' content='Petr Havlát'>
    <meta name='robots' content='all'>
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/kucharka.css" type="text/css">
  </head>
  <body>
    <div class="wrapper">

      <header>

        <div class="logo">
          <a href="index.html"><img src="image/logo.png" alt="logo"></a>
        </div>

        <div class="header">
          <h1>Bubákova kuchařka</h1>
        </div>

      </header>

      <nav class="main_menu">

        <ul>
          <li><a href="index.html">Úvodní stránka</a></li>
          <li><a href="recepty.php">Recepty</a></li>
          <li><a href="pridat_recept.php">Přidat recept</a></li>
          <li><a href="navstevni_kniha.php">Návštěvní kniha</a></li>
        </ul>

  		</nav>

  		<section class="content">

        <article class="left-box">


        </article>

        <article class="right-box" id="pridat-recept">

          <?php
            if(isSet($_POST['uzivatel']) && isSet($_POST['kategorie'])
               && isSet($_POST['nazev_receptu']) && isSet($_POST['ingredience'])
               && isSet($_POST['popis']))
            {
            //uložení obsahu formulářových polí do proměnných
			        $uzivatel = $_POST['uzivatel'];
              $kategorie = $_POST['kategorie'];
			        $nazev_receptu = $_POST['nazev_receptu'];
              $ingredience = $_POST['ingredience'];
              $popis = $_POST['popis'];
            //uložení aktuálního data
              $datum_vlozeni = strFTime("%d.%m.%Y", Time());
            //funkce pro připojení k mySQL databázi

            // kontrola názvu receptu
              include 'php/pripojeni_mySQL.php';

              $spojeni = pripoj_mySQL();
              utf8($spojeni);

            // kontrola, zda recept v DB již existuje
							$sql = "SELECT *
						    			FROM recepty
								  		WHERE nazev_receptu='$nazev_receptu'";

              $radek = mysqli_fetch_array(mysqli_query($spojeni, $sql));
							if($radek!=NULL) echo "<script> alert('Recept je již v databázi!'); </script>";
							else
              {
              //SQL dotaz pro vložení položky do databáze
                $sql = "INSERT
								  			INTO recepty (uzivatel, kategorie, nazev_receptu, ingredience, popis, datum_vlozeni)
								    		VALUES ('$uzivatel','$kategorie','$nazev_receptu','$ingredience','$popis','$datum_vlozeni'";

                if(mysqli_query($spojeni, $sql))
                echo "<script> alert('Nový recept byl vložen do databáze.'); </script>";
                else echo "<script> alert('Při vkládání se vyskytla chyba!'); </script>";

                $spojeni = odpoj_mySQL($spojeni);
              }
            }

          ?>

          <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="uzivatel" placeholder="Uživatel" required><br>
            <select name="kategorie" required>
              <option value="Polévky">Polévky</option>
              <option value="Maso">Maso</option>
              <option value="Ryby">Ryby</option>
            </select><br>
            <input type="text" name="nazev_receptu" placeholder="Název receptu" required><br>
            <textarea name="ingredience" placeholder="Výčet ingrediencí" required></textarea><br>
            <textarea name="popis" placeholder="Pracovní postup" required></textarea><br>
            <button type="submit">Vlož recept</button><button type="reset">Vymaž</button>
          </form>

        </article>

      </section>

      <footer class="footer">
        <p>Vytvořil a spravuje Petr Havlát &copy; 2014.
           Kontakt: <a href="mailto:havlat82@centrum.cz">havlat82@centrum.cz</a>.<br>
           Všechny použité obrázky jsou k volnému použití.</p>
     	</footer>

    </div>     <!-- konec id obal -->
  </body>
</html>