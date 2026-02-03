<!DOCTYPE html>
<html lang='cs'>
  <head>

    <title>Moje recepty | Přidej recept</title>

    <meta charset='utf-8'>
    <meta name='description' content='Znáš nějaký skvělý recept, který tu chybí?
                                      Přidej ho na stránky..'>
    <meta name='author' content='Petr Havlát'><meta name='copyright' content='Petr Havlát'>
    <meta name='robots' content='all'>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/kucharka.css" type="text/css">
    <link href='image/favicon.png' rel='shortcut icon' type='image/png'>

    <script src="js/modernizer-min.js"></script>

  </head>

  <body>
    <div class="wrapper">

      <header class="header">

        <a href="http://www.facebook.com/petr.havlat">
          <img class="icon" src="image/logo.png"
               alt="Kontaktuj mě na Facebooku" title="Kontaktuj mě na Facebooku">
        </a>
        <h1>Moje recepty</h1>

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

        <article id="msgbox">

        </article>

        <article id="left_box">

          <h3>Přidej recept</h3>
          <p>Znáš nějaký výborný recept, který tu chybí?<br />
             Předej ostatním svoje kulinářské znalosti<br />
             a vlož svůj zaručený recept do kuchařky!</p>

        </article>

        <article id="right_box" class="add_recipe" onmousemove="msg_done()">

          <?php

            if(isSet($_POST['uzivatel']) && isSet($_POST['kategorie'])
               && isSet($_POST['nazev_receptu']) && isSet($_POST['ingredience'])
               && isSet($_POST['popis']))
            {
            //uložení obsahu formulářových polí do proměnných
			        $user = $_POST['uzivatel'];
              $cat = $_POST['kategorie'];
			        $rec = $_POST['nazev_receptu'];
              $ing = $_POST['ingredience'];
              $proc = $_POST['popis'];
            //uložení aktuálního data
              $date = strFTime("%d.%m.%Y", Time());
            //funkce pro připojení k mySQL databázi

              include 'php/globals.php';

              if ($con=connect_kucharka())
              {
                query($con, "SET NAMES utf8");

             // kontrola, zda recept v DB již existuje
							  $sql = "SELECT *
						      			FROM recepty
								    		WHERE nazev_receptu='$rec'";

                $line = mysqli_fetch_array(query($con, $sql));
							  if($line!=NULL) info_msg("Recept je již v databázi.");
							    else
                  {
                //SQL dotaz pro vložení položky do databáze
                    $sql = "INSERT
								  	    		INTO recepty (uzivatel, kategorie, nazev_receptu, ingredience, popis, datum_vlozeni)
								    		    VALUES ('$user','$cat','$rec','$ing','$proc','$date')";

                    if(query($con, $sql)) info_msg("Nový recept byl vložen do databáze.");
                  }
                $con = mysqli_close($con);
              }
            }

          ?>

          <form method="post"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <input type="text" name="uzivatel" placeholder="Uživatel" required>

            <select name="kategorie" required>
              <option value="Předkrm">Předkrm</option>
              <option value="Polévka">Polévka</option>
              <option value="Hlavní chod ">Hlavní chod</option>
              <option value="Dezert/moučník">Dezert/moučník</option>
              <option value="Salát">Salát</option>
              <option value="Nápoj">Nápoj</option>
            </select>

            <input type="text" name="nazev_receptu" placeholder="Název receptu" required>
            <textarea name="ingredience" placeholder="Výčet ingrediencí" required></textarea>
            <textarea name="popis" placeholder="Pracovní postup" required></textarea>

            <button type="submit">Vlož recept</button>
            <button type="reset">Vymaž</button>

          </form>

        </article>

      </section>

      <footer class="footer">

        <p>Vytvořil a spravuje Petr Havlát &copy; 2014.
           Kontakt: <a href="mailto:havlat82@centrum.cz">havlat82@centrum.cz</a>.<br>
           Všechny použité obrázky jsou k volnému použití.</p>
        <endora>

       </footer>

    </div>     <!-- konec id obal -->

    <script src='js/jquery-1.11.1.min.js'></script>
    <script>
      function msg_done()
      {
        $('#msgbox').fadeOut("slow");
      }
    </script>

  </body>
</html>