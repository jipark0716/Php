<?
$table = "naver_user_info";
include "lib.php";
include "DBconnect.php";
//삭제
$queryString = substr(getenv("QUERY_STRING"), strpos(getenv("QUERY_STRING"),"&")+1);
$queryString = substr($queryString,strpos($queryString,"&")+1);
if(isset($_GET['mode'])&&$_GET['mode']=="remove"){
  $query = <<<DOE
  delete from {$table} where idx = '{$_GET['target']}'
DOE;
  $conn->query($query);
  $queryString = substr(getenv("QUERY_STRING"), strpos(getenv("QUERY_STRING"),"&")+1);
  $queryString = substr($queryString,strpos($queryString,"&")+1);
  exit_("삭제 되었습니다.","/naver/CMS.php?" . $queryString);
}elseif (isset($_GET['mode'])&&$_GET['mode']=="deletemulti") {
  $select = $_POST['select'];
  $message = "";
  for($i = 0; isset($select[$i]); $i++){
    $query = "select name from $table where idx = {$select[$i]}";
    $result = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
    $message .= $result['name']."님, ";
    $query = "delete from $table where idx = {$select[$i]}";
    $conn->query($query);
  }
  exit_(subStr($message,0,-2)."을 지웠습니다","/naver/CMS.php?page={$_POST['page']}&pagerow={$_POST['pagerow']}");
}
//수정
elseif(isset($_GET['mode'])&&$_GET['mode']=="rewrite") {
  $query = <<<DOE
select * from {$table} where idx = '{$_GET['target']}'
DOE;
$result = mysqli_fetch_array($conn->query($query));
  ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="/naver/css/userInfo.css?<?=time()?>">
      </head>
      <body>
        <div id="wrap">
          <?include "header.php";?>
          <div id="content">
            <center><h2>수정</h2></center>
            <form action="/naver/CMSSend.php?mode=update&target=<?=$_GET['target']?>" method="post">
              <input type="hidden" name="query" value="<?=$queryString?>">
              <table class="userInfo">
                <colgroup>
                  <col width="30%">
                  <col>
                </colgroup>
                <tr>
                  <td>id</td>
                  <td><input type="text" value="<?=$result['id']?>" name="id"></td>
                </tr>
                <tr>
                  <td>pw</td>
                  <td><input type="text" name="pw"></td>
                </tr>
                <tr>
                  <td>name</td>
                  <td><input type="text" value="<?=$result['name']?>" name="name"></td>
                </tr>
                <tr class="birthdayInput">
                  <td>birthday</td>
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
                </tr>
                <tr>
                  <td>gender</td>
                  <td>
                    <select name="gender" class="select">
                      <option value="남">남자</option>
                      <option value="여" <?=$result['gender']=="여"?"selected":""?> >여자</option>
                    </section>
                  </td>
                </tr>
                <tr>
                  <td>call</td>
                  <td><input type="text" value="<?=$result['call_']?>" name="call"></td>
                </tr>
                <tr>
                  <td>email</td>
                  <td><input type="text" value="<?=$result['email']?>" name="email"></td>
                </tr>
              </table>
              <div id="button">
                <input type="submit" value="확인">
                <input type="button" value="취소" onclick="location.href='/naver/CMS.php?<?=$queryString?>'">
              </div>
            </form>
          </div>
          <?include "footer.php";?>
        </div>
      </body>
    </html>
  <?
}
//수정 DB전송
elseif(isset($_GET['mode'])&&$_GET['mode']=="update"){
  if (!is_numeric($_POST['call'])) {
    hisBack("전화번호는 숫자만 입력해주세요");
  }
  if(!isset($_POST['pw'])||$_POST['pw']){
    $query = "select password from $table where idx = '{$_GET['target']}'";
    $result = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
    $password = $result['password'];
  }else {
    $password = sha1($_POST['pw']);
  }
  $birthday = $_POST['day']+($_POST['month']*100)+($_POST['year']*10000);
  if(!isset($_POST['email'])){$email="";}
  else{$email=$_POST['email'];}
  $query = "update {$table} set
  id = '{$_POST['id']}',
  password = '{$password}',
  call_ = '{$_POST['call']}',
  name = '{$_POST['name']}',
  birthday = '{$birthday}',
  gender = '{$_POST['gender']}',
  email = '$email'
  where idx = '{$_GET['target']}'";
  $conn->query($query);
  exit_("수정되었습니다","/naver/CMS.php?".$_POST['query']);
}
?>
