<!DOCTYPE html>
<html lang='cs'>
  <head>

    <title>Moje recepty | Návštevní kniha</title>

    <meta charset='utf-8'>
    <meta name='description' content='Napiš mi svůj názor na stránky..'>
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

        <article id="left_box" class="form" onmousemove="msg_done()">
          <h3>Napište mi vzkaz</h3>
          <p>Líbí vám tyto stránky?<br>
             Něco se vám na stránkách nelíbí?<br>
             Napište mi vzkaz do návštevní knihy!</p>

            <?php
            //definice proměnných
              include 'php/globals.php';

              $name = $comment = "";

              if ($_SERVER["REQUEST_METHOD"] == "POST")
              // Po stisku Přidej vzkaz
              {
              // chybový stavy
                $name = clean_input($_POST["name"]);
                $comment = clean_input($_POST["comment"]);

                if ($file = open_file(FILE, "a"))
                {
                  file_write($file,"<p class='transparent2'><b>".$name."</b><br>");
                  file_write($file,$comment."</p>");

                  close_file($file);
                }
                info_msg("Děkuji za Váš vzkaz");
              }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

              <input type="text" name="name" placeholder="Vaše jméno" required>
              <textarea name="comment" placeholder="Váš vzkaz" required></textarea>

              <button type="submit">Přidej vzkaz</button>
              <button type="reset">Vymaž</button>

            </form>

        </article>

        <article id="right_box" class="guestbook">

          <h3>Vaše vzkazy:</h3>
          <iframe id="messages" src="php/vzkazy.php"></iframe>

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