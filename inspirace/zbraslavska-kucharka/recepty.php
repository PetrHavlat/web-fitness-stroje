<!DOCTYPE html>
<html lang='cs'>
  <head>

    <title>Moje recepty | Recepty</title>

    <meta charset='utf-8'>
    <meta name='description' content='Najdi recept na svoje oblíbené jídlo..'>
    <meta name='author' content='Petr Havlát'><meta name='copyright' content='Petr Havlát'>
    <meta name='robots' content='all'>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/kucharka.css" type="text/css">
    <link href='image/favicon.png' rel='shortcut icon' type='image/png'>

    <script src="js/modernizer-min.js"></script>

  </head>

  <body>
    <div class="wrapper">

      <header>

        <a href="http://www.facebook.com/petr.havlat">
          <img class="icon" src="image/logo.png"
               alt="Kontaktuj mě na Facebooku" title="Kontaktuj mě na Facebooku">
        </a>
        <h1>Moje recepty</h1>

      </header>

      <nav>

        <ul>
          <li><a href="index.html">Úvodní stránka</a></li>
          <li><a href="recepty.php">Recepty</a></li>
          <li><a href="pridat_recept.php">Přidat recept</a></li>
          <li><a href="navstevni_kniha.php">Návštěvní kniha</a></li>
        </ul>

  		</nav>

  		<section>

        <article id="msgbox">

        </article>

        <article id="left_box" class="form" onmousemove="msg_done()">

          <?php

            include 'php/globals.php';

            $beg="<!DOCTYPE html>
                  <html lang='cs'>
                  <head>
                    <title>Zbraslavská kuchařka</title>
                    <meta charset='utf-8'>
                    <link rel='stylesheet' href='../css/kucharka.css' type='text/css'>
                    <script src='../js/modernizer-min.js'></script>
                  </head>
                  <body>";

            $end_notfound="</body></html>";

            $skript_beg="<script src='../js/jquery-1.11.1.min.js'></script><script>";

            $skript_end="</script></body></html>";

            $n=0;
            $c=$c2=$c3=$c4=$c5=$c6=$c7=false;
            $user=$cat=$rec=$ing=$proc=$date= "";
            $s_user=$s_cat=$s_rec=$s_ing= "";

            if (isSet($_POST['uzivatel'])) $s_user = clean_input($_POST['uzivatel']);
            if (isSet($_POST['kategorie'])) $s_cat = clean_input($_POST['kategorie']);
            if (isSet($_POST['nazev_receptu'])) $s_rec = clean_input($_POST['nazev_receptu']);
            if (isSet($_POST['ingredience'])) $s_ing = clean_input($_POST['ingredience']);

            if ($con=connect_kucharka())
            {
              query($con, "SET NAMES utf8");

              $sql = "SELECT *
                      FROM recepty
                      ORDER BY nazev_receptu";

              if ($file = open_file("html/results.html", "w"))
              {
                file_write($file, $beg);
                if($data = query($con, $sql))
                {
                  while($line = mysqli_fetch_array($data))
                  {
                    for($i=0; $i<count($line)/2; $i++)
                    {
                      switch ($i)
                      {
                        case 1: $user=$line[$i]; break;
                        case 2: $cat=$line[$i]; break;
                        case 3: $rec=$line[$i]; break;
                        case 4: $ing=$line[$i]; break;
                        case 5: $proc = $line[$i]; break;
                        case 6: $date=$line[$i]; break;
                      }
                    }
                    if($s_cat!="")
                    {
                      if((check_txt(strtolower($cat),strtolower($s_cat)))) $c=true;
                    } else $c=true;

                    if($s_cat!="" && $s_user!="")
                    {
                      if(check_txt(strtolower($user),strtolower($s_user))
                      && check_txt(strtolower($cat),strtolower($s_cat))) $c2=true;
                    } else $c2=true;

                    if($s_cat!="" && $s_rec!="")
                    {
                      if(check_txt(strtolower($rec),strtolower($s_rec))
                      &&check_txt(strtolower($cat),strtolower($s_cat))) $c3=true;
                    } else $c3=true;

                    if($s_cat!="" && $s_ing!="")
                    {
                      if(check_txt(strtolower($cat),strtolower($s_cat))
                      &&check_txt(strtolower($ing),strtolower($s_ing))) $c4=true;
                    } else $c4=true;

                    if($s_cat!="" && $s_user!="" && $s_rec!="")
                    {
                      if(check_txt(strtolower($user),strtolower($s_user))
                      &&check_txt(strtolower($rec),strtolower($s_rec))
                      &&check_txt(strtolower($cat),strtolower($s_cat))) $c5=true;
                    } else $c5=true;

                    if($s_cat!="" && $s_user!="" && $s_ing!="")
                    {
                      if(check_txt(strtolower($cat),strtolower($s_cat))
                      &&check_txt(strtolower($user),strtolower($s_user))
                      &&check_txt(strtolower($ing),strtolower($s_ing))) $c6=true;
                    } else $c6=true;

                    if($s_cat!="" && $s_user!="" && $s_ing!="" && $s_rec!="")
                    {
                      if(check_txt(strtolower($user),strtolower($s_user))
                      && check_txt(strtolower($cat),strtolower($s_cat))
                      && check_txt(strtolower($rec),strtolower($s_rec))
                      && check_txt(strtolower($ing),strtolower($s_ing))) $c7=true;
                    } else $c7=true;

                    if($c&&$c2&&$c3&&$c4&&$c5&&$c6&&$c7)
                    {
                      file_write($file,"<p><div id='rh$n' class='transparent'>");
                      file_write($file,"<b>$rec</b><br>");
                      file_write($file,"Vložil: $user $date<br>");
                      file_write($file,"<div id='rd$n' class='toggle'>");
                      file_write($file,"<h5>Ingredience:</h5>");
                      file_write($file,"<p>$ing</p>");
                      file_write($file,"<h5>Postup:</h5>");
                      file_write($file,"<p>$proc</p></div></div></p>");

                      $c=$c2=$c3=$c4=$c5=$c6=$c7=false;
                      $n++;
                    }
                  }

                  if($n==0)
                  {
                    file_write($file,"<h4>Se zadanými parametry se neshoduje ani jeden recept</h4>");
                    file_write($file,$end_notfound);
                  } else
                    {
                      file_write($file,$skript_beg);
                      for($a=0; $a<$n; $a++)
                      {
                        $skript=stripslashes("\$('document').ready(function(){\$('#rh$a').click(function(){\$('#rd$a').animate({height:'toggle',opacity: 1});});});");
                        file_write($file,$skript);

                      }
                      file_write($file,$skript_end);
                    }
                }
                close_file($file);
              }
              $con = mysqli_close($con);
            }

          ?>
          <form id="seek" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <h3>Hledej recept podle..</h3>
            <input type="text" name="uzivatel" placeholder="Uživatele">
            <input type="text" name="nazev_receptu" placeholder="Názvu receptu">
            <input type="text" name="ingredience" placeholder="Výčtu ingrediencí">

            <h3>nebo podle kategorie..</h3>
            <select name="kategorie" label="kategorie">
              <option value="">Všechny</option>
              <option value="Předkrm">Předkrm</option>
              <option value="Polévka">Polévka</option>
              <option value="Hlavní chod ">Hlavní chod</option>
              <option value="Dezert/moučník">Dezert/moučník</option>
              <option value="Salát">Salát</option>
              <option value="Nápoj">Nápoj</option>
            </select>

            <button type="submit">Hledej recept</button>
            <button type="reset">Vymaž</button>

          </form>

        </article>

        <article id="right_box" class="recipe">
          <?php echo "<h3>Nalezeno $n receptů</h3>";?>
          <iframe id="results" src="html/results.html"></iframe>
        </article>

      </section>

  		<footer>

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