<?
include "lib.php";
//로그인 여부 확인
session_start();
if(isset($_SESSION['idx'])){
  exit_("이미 로그이 되어있습니다","/naver/userInfo.php");
}
if(isset($_GET['language'])){
  $language = $_GET['language'];
}else{
  $language = "ko";
}
include "language.php";
switch ($language) {
  case 'en':
    include "languagePackEn.php";
    break;
  default:
    include "languagePackKo.php";
    break;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$login?></title>
    <link rel="stylesheet" href="/naver/css/css.css?v7">
    <link rel="stylesheet" href="/naver/css/form.css?v7">
  </head>
  <body>
    <div id="wrap">
      <?include "header.php";?>
      <div id="container">
        <div id="content">
          <form id="loginForm" name="loginForm" action="loginSend.php" method="post">
            <input type="hidden" name="language" value="<?=$language?>">
            <div class="inputArea">
              <div class="inputRow">
                <input type="text" value="<?=isset($_COOKIE['idSave'])? $_COOKIE['idSave'] : "" ?>" name="id" placeholder="<?=$id?>" maxlength="41">
              </div>
            </div>
            <div class="inputArea">
              <div class="inputRow">
                <input type="password" name="pw" placeholder="<?=$password?>" maxlength="41">
              </div>
            </div>
            <input type="submit" value="<?=$login?>" class="submitBtn">
            <div id="loginInfo">
              <input type="checkbox" name="idSave">
              <label for="login_chk" id="idSave"><?=$staySignedIn?></label>
            </div>
          </form>
          <div id="findInfo">
            <a href="#"><?=$findPw?></a>
            <span class="bar"> | </span>
            <a href="#"><?=$findPw?></a>
            <span class="bar"> | </span>
            <a href="signup.php?language=<?=$language?>"><?=$signup?></a>
          </div>
          <div id="add">
            <span>광고다 이말이야</span>
          </div>
        </div>
      </div>
    <?include "footer.php"?>
    </div>
  </body>
</html>
