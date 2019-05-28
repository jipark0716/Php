<?php
include "{$_SERVER["DOCUMENT_ROOT"]}/lib/lib.php";

if(isset($_POST['download'])){
  $packtPage = curlGet($_POST['url']);

  $myMangshowMe = new mangashowMeGet($packtPage);
  $imageUrl = $myMangshowMe->getImageUrl();

  $zip = new DirectZip();
  $zip->open($myMangshowMe->getTitle().".zip");
  $count = 0;
  foreach ($imageUrl as $key) {
    $count++;
    copy($key,"image/".sprintf('%03d',$count).".jpg");
    $zip->addFile("image/".sprintf('%03d',$count).".jpg",sprintf('%03d',$count) .".jpg");
  }
  $zip->close();
  exit;
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
        <form action="index.php" method="post">
          <input type="text" name="url">
          <input type="submit" name="download" value="전송">
        </form>
      </div>
    </div>
  </body>
</html>
