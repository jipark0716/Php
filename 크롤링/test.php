<?php
include "../lib/lib.php";

if(isset($_POST['download'])){
  $packtPage = curlGet($_POST['url']);

  $script = str_replace("\\","",returnXPathObject($packtPage));

  do {
    $imageUrl[isset($imageUrl)?count($imageUrl):0] = substr($script,0,strpos($script,"\",\""));
    $script = substr($script,strpos($script,"\",\"")+3);
  } while (strpos($script,"\",\"") !== false);

  $zip = new DirectZip();
  $zip->open('test.zip');
  $count = 000;
  foreach ($imageUrl as $key) {
    $count++;
    copy($key,"image/".sprintf('%03d',$count).".jpg");
    $zip->addFile("image/".sprintf('%03d',$count).".jpg",sprintf('%03d',$count) .".jpg");
  }
  $zip->close();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="wrap">
      <div class="content">
        <form action="test.php" method="post">
          <input type="text" name="url">
          <input type="submit" name="download" value="전송">
        </form>
      </div>
    </div>
  </body>
</html>
