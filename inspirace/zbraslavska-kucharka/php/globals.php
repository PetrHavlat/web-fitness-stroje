<?php /*Global functions */
//definice konstant
define("FILE","php/navstevni_kniha.txt");
define("ERROR",2);
define("OK",1);

//definice proměnných

function msg($event, $str)
{
  if($event==OK) $skript = "<script src='js/jquery-1.11.1.min.js'></script>
                            <script>
                              $('document').ready(function(){ $('#msgbox').fadeIn(); });
                              document.getElementById('msgbox').innerHTML = '$str';
                              document.getElementById('msgbox').style.backgroundColor = 'green';
                            </script>";
  if($event==ERROR) $skript = "<script src='js/jquery-1.11.1.min.js'></script>
                               <script>
                                 $('document').ready(function(){ $('#msgbox').fadeIn(); });
                                 document.getElementById('msgbox').innerHTML = '$str';
                                 document.getElementById('msgbox').style.backgroundColor = 'red';
                               </script>";
  echo "$skript";
}

function clean_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function err_msg($msg)
{
  msg(ERROR, $msg);
}

function info_msg($msg)
{
  msg(OK, $msg);
}

function open_file($path, $mod)
{
  $file = @fopen($path, $mod);
  if (error_get_last()!=null) err_msg("Soubor nelze otevřít! Kontaktujte mě prosím na havlat82@centrum.cz.");
  return $file;
}

function file_write($file, $str)
{
  fwrite($file, $str);
  if (error_get_last()!=null) err_msg("Do souboru nelze zapisovat! Kontaktujte mě prosím na havlat82@centrum.cz.");
}


function close_file($file)
{
  fclose($file);
  if (error_get_last()!=null) err_msg("Soubor nelze uzavřít! Kontaktujte mě prosím na havlat82@centrum.cz.");
}

function check_txt($check,$txt)
{
  $r = false;
  if(strpos("$check","$txt")>-1) {$r = true;} else {$r = false;}
  return $r;
}

function connect_kucharka()
{
  $con = mysqli_connect("localhost","pankytara","bubukara","buburecepty");
  if ($con==null) err_msg("Nepodařilo se připojit do databáze receptů! Kontaktujte mě prosím na havlat82@centrum.cz.");
  return $con;
}

function query($con, $sql)
{
  $data = mysqli_query($con, $sql);
  if ($data==null) err_msg("Nepodařilo se odeslat dotaz do databáze! Kontaktujte mě prosím na havlat82@centrum.cz.");
  return $data;
}

?>