<?
if(isset($_GET['language'])){
  $language = $_GET['language'];
}else{
  $language = "ko";
}
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
    <title><?=$signup?></title>
    <link rel="stylesheet" href="/naver/css/signup.css?<?=time()?>">
    <link rel="stylesheet" href="/naver/css/form.css?<?=time()?>">
  </head>
  <body>
    <div id="wrap">
      <?include "header.php";?>
      <div id="container">
        <div id="content">
          <form action="signupSend.php" method="post">
            <div class="inputGroup">
              <p><?=$username?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="text" id="id" name="id" maxlength="41">
                  <span>@naver.com</span>
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$password?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="password" name="pw" maxlength="41">
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$password?> <?=$confirm?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="password" name="pwck" maxlength="41">
                </div>
              </div>
            </div>
            <div class="inputGroup" id="name">
              <p><?=$name?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="text" name="name" maxlength="41">
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$dOB?></p>
              <div class="inputAreaDate">
                <div class="inputRow">
                  <input type="text" name="year" placeholder="<?=$year?>">
                </div>
              </div>
              <div class="inputAreaDate">
                <div class="inputRow">
                  <select class="month" name="month">
                    <option value="empty"><?=$month?></option>
                    <?
                    for($i=1;$i<=12;$i++){
                      ?>
                      <option value="<?=$i?>"><?=$i?></option>
                      <?
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="inputAreaDate">
                <div class="inputRow">
                  <input type="text" name="day" placeholder="<?=$day?>">
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$gender?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <select class="month" name="gender">
                    <option value="empty"><?=$gender_?></option>
                    <option value="남"><?=$male?></option>
                    <option value="여"><?=$female?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$recoveryEmail?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="text" name="email" placeholder="<?=$optional?>" maxlength="41">
                </div>
              </div>
            </div>
            <div class="inputGroup">
              <p><?=$mobilePhone?></p>
              <div class="inputArea">
                <div class="inputRow">
                  <input type="text" name="call" maxlength="41">
                </div>
              </div>
            </div>
            <input type="submit" value="<?=$signup?>" class="submitBtn">
          </form>
        </div>
      </div>
      <?include "footer.php";?>
    </div>
  </body>
</html>
