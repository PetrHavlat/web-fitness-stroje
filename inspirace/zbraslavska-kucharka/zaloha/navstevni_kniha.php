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

  		<section class="content" id="vase-vzkazy">

        <article class="left-box">
          <div id="pridej-vzkaz-text">
            <h2>Napište mi vzkaz</h2>
            <p>Líbí vám tyto stránky?<br>
               Něco se vám na stránkách nelíbí?<br>
               Napište mi vzkaz do návštevní knihy!</p>
          </div>

          <div id="pridej-vzkaz-formular">

            <?php
            //definice konstant
              define("SOUBOR","php/navstevni_kniha.txt");
            //definice proměnných
              $nameErr = $emailErr = $commentErr = "";
              $name = $email = $comment = "";

              function cisti_vstup($data)
              {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }

              if ($_SERVER["REQUEST_METHOD"] == "POST")
              // Po stisku Přidej vzkaz
              {
              // chybový stavy
                if (empty($_POST["name"])) $nameErr = "Toto pole se musí vyplnit.";
                else $name = cisti_vstup($_POST["name"]);

                if (empty($_POST["email"])) $emailErr = "Toto pole se musí vyplnit.";
                else
                {
                  $email = cisti_vstup($_POST["email"]);
                  // check if e-mail address is well-formed
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $emailErr = "Neplatný e-mail";
                }

                if (empty($_POST["comment"])) $commentErr = "Toto pole se musí vyplnit.";
                else $comment = cisti_vstup($_POST["comment"]);

                if(isSet($_POST['name']) && isSet($_POST['email']) && isSet($_POST['comment']))
                // zápis do souboru navstevni_kniha.txt
                {
                  $soubor = fopen(SOUBOR, "a") or die("Soubor nelze otevřít!");

                  fwrite($soubor,"<em style='font-family: Arial Black'>".$name."</em><br>");
                  fwrite($soubor,"<a style='color: red' href='mailto:$email'>".$email."</a><br>");
                  fwrite($soubor,$comment."<br><br>");

                  fclose($soubor);
                }
              }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <input type="text" name="name" placeholder="Vaše jméno">
              <span class="error">* <?php echo $nameErr;?></span>
              <input type="text" name="email" placeholder="Váš e-mail">
              <span class="error">* <?php echo $emailErr;?></span>
              <textarea name="comment" placeholder="Váš vzkaz"></textarea>
              <span class="error">* <?php echo $commentErr;?></span><br>
              <button type="submit">Přidej vzkaz</button>
              <button type="reset">Vymaž</button>
            </form>

          </div>
        </article>

        <article class="right-box">
          <h2 style="color: white">Vaše vzkazy:</h2>
          <iframe src="php/vzkazy.php"></iframe>
        </article>

      </section>


  		<footer class="footer">
        <p>Vytvořil a spravuje Petr Havlát &copy; 2014.
           Kontakt: <a href="mailto:havlat82@centrum.cz">havlat82@centrum.cz</a>.<br>
           Všechny použité obrázky jsou k volnému použití.</p>
        <!-- reklama -->
         <div ><div class="oznamy">Magnetický hlavolam <a href="http://unimagnet.cz/20-k-d5-neocube-216kusu.html" title="NeoCube - magnetické kuličky a 3D puzzle">NeoCube</a>. <strong>Oblékáme se stylově</strong> - <a href="http://www.krutyhadry.cz" title="Kruté oblečení">oblečení</a> a hip hop oblečení</div></div>
        <!-- konec reklama -->
       </footer>

    </div>     <!-- konec id obal -->
  </body>
</html>