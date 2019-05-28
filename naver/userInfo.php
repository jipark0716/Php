<?
$table = "naver_user_info";
include "lib.php";
include "DBconnect.php";
//로그인 여부 확인
session_start();
if(!isset($_SESSION['idx'])){
  exit_("로그인 해주세요","/naver/login.php");
}
//로그아웃
if(isset($_GET['mode'])&&$_GET['mode']=="logout"){
  session_destroy();
  exit_("로그아웃 되었습니다","/naver/login.php");
}
$query = "select * from {$table} where idx = '{$_SESSION['idx']}'";
$result = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
if(isset($_GET['mode'])){$mode = $_GET['mode'];}
else{$mode = "";}
if(isset($_GET['target'])){$target = $_GET['target'];}
else{$target = "";}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/naver/css/userInfo.css?<?=time()?>">
  </head>
  <body>
    <div id="menu">
      <a href="/naver/userInfo.php?mode=logout">로그아웃</a>
    </div>
    <div id="wrap">
      <?include "header.php";?>
      <div id="content">
        <table class="userInfo">
          <colgroup>
            <col width="30%">
            <col width="55%">
            <col width="15%">
          </colgroup>
          <tr>
            <td>id</td>
              <?
                if($mode=="rewrite"&&$target=="id"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="id"><td>
                    <input type="text" name="id" value="<?=$result['id']?>"></td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=$result['id']?></td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=id'">수정</button></td>
                  <?
                }
              ?>
            </td>
          </tr>
          <tr>
            <td>pw</td>
            <?
              if($mode=="rewrite"&&$target=="pw"){
                ?> <form action="userInfoSend.php" method="post">
                  <input type="hidden" name="target" value="password"><td>
                  <input type="password" name="password"></td>
                  <td>
                    <input type="submit" class="update" value="확인">
                    <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                  </td>
                </form> <?
              }else{
                ?><td>****</td>
                <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=pw'">수정</button></td>
                <?
              }
            ?>
          </tr>
          <tr>
            <td>name</td>
              <?
                if($mode=="rewrite"&&$target=="name"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="name"><td>
                    <input type="text" name="name" value="<?=$result['name']?>"></td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=$result['name']?></td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=name'">수정</button></td>
                  <?
                }
              ?>
          </tr>
          <tr class="birthdayInput">
            <td>birthday</td>
              <?
                if($mode=="rewrite"&&$target=="birthday"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="birthday">
                    <td>
                      <input type="text" name="year" value="<?=floor($result['birthday']/10000)?>">년
                      <select class="select" name="month">
                        <?
                          for ($i=1; $i<=12; $i++) {
                            ?>
                              <option value="<?=$i?>" <?=$i==floor($result['birthday']%10000/100)?"selected":""?> ><?=$i?></option>
                            <?
                          }
                        ?>
                      </select>월
                      <input type="text" name="day" value="<?=floor($result['birthday'])%100?>">일
                    </td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=floor($result['birthday']/10000)?>년<?=floor($result['birthday']%10000/100)?>월<?=floor($result['birthday'])%100?>일</td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=birthday'">수정</button></td>
                  <?
                }
              ?>
          </tr>
          <tr>
            <td>gender</td>
              <?
                if($mode=="rewrite"&&$target=="gender"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="gender"><td>
                      <select name="gender">
                        <option value="남">남자</option>
                        <option value="여" <?=$result['gender']=="여"?"selected":""?>>여자</option>
                      </select>
                    </td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=$result['gender']=="남"?"남자":"여자"?></td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=gender'">수정</button></td>
                  <?
                }
              ?>
          </tr>
          <tr>
            <td>call</td>
              <?
                if($mode=="rewrite"&&$target=="call"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="call_"><td>
                    <input type="text" name="call_" value="<?=$result['call_']?>"></td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=$result['call_']?></td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=call'">수정</button></td>
                  <?
                }
              ?>
          </tr>
          <tr>
            <td>email</td>
              <?
                if($mode=="rewrite"&&$target=="email"){
                  ?> <form action="userInfoSend.php" method="post">
                    <input type="hidden" name="target" value="email"><td>
                    <input type="text" name="email" value="<?=$result['email']?>"></td>
                    <td>
                      <input type="submit" class="update" value="확인">
                      <input type="button" class="update" value="취소" onclick="location.href='/naver/userInfo.php'">
                    </td>
                  </form> <?
                }else{
                  ?><td><?=$result['email']==""?"-":$result['email']?></td>
                  <td><button onclick="location.href='/naver/userInfo.php?mode=rewrite&target=email'">수정</button></td>
                  <?
                }
              ?>
          </tr>
        </table>
      </div>
      <?include "footer.php";?>
    </div>
  </body>
</html>
