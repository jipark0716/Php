<?
echo $_POST['mode'];
echo $_POST['asdf'];
include "naver/DBconnect.php";
include "naver/lib.php";
$array1 = array('하나','하루','한결','초롱','포근','푸름','하나나','지라라','열매','예슬','우림','으뜸','은비','우람','산들','새롬','새미','새이','샘','소라','소담','소미','솔비');
$array2 = array('hanana0408','oneday131','oneruf1131','chorong886','forrms14432','vnfmafma141','hanana0408','zirara','881dufao','dPtnf142','dnflafla','themem775','onbi1003','uramram199','sandddd13','selommmmm11','semi1141','seisei6','samsma1131','sora05','sodam13','somi44','solbi15');

if(isset($_POST['mode'])&&$_POST['mode']=="a"){
  $table = "test";
  $query = "select date from $table order by date";
  $result = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
  $random1 = mt_rand(0,2);
  $random2 = mt_rand(0,2);
  $inputDate = $result['date']-1;
  $query = "insert into $table (date,당첨,당첨2) values('{$inputDate}','{$random1}','{$random2}')";
  $conn->query($query);
  echo $inputDate;
  exit;
}elseif(isset($_POST['mode'])&&$_POST['mode']=="b"){
  $table = "test";
  $query = "insert into $table (date,당첨,당첨2) values('1','0','0')";
  $conn->query($query);
  echo "완료";
  exit;
}elseif (isset($_POST['mode'])&&$_POST['mode']=="적당히 10번만") {
$table = "naver_user_info";
  for($i = 0 ; $i<10 ; $i++){
    $random1 = mt_rand(0,22);
    $birthday = mt_rand(1900,2018)*10000;
    $birthday+= mt_rand(1,12)*100;
    $birthday+= mt_rand(1,30);
    $random3 = mt_rand(0,1);
    $random3 = $random3==1?"남":"여";
    $pw = sha1("aa");
    $query = "insert into $table (id,password,name,birthday,gender,email,call_)
    values ('{$array2[$random1]}','$pw','{$array1[$random1]}','{$birthday}','$random3','','01030402040')";
    $conn->query($query);
    echo $query."<br>";
  }
  exit;
}elseif (isset($_POST['mode'])&&$_POST['mode']=="죽어랏 조성현") {
  $pw = md5("aa");
  $table = "user";
  $host = 'localhost';
  $user = 'stu_jsh';
  $pw = 'aa1234';
  $dbName = 'stu_jsh';
  $conn = new mysqli($host, $user, $pw, $dbName);
  if (!$conn) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }
  while(true){
    $random1 = mt_rand(0,22);
    $random2 = mt_rand(1900,2018);
    $random3 = mt_rand(1,12);
    $random4 = mt_rand(1,30);
    $random5 = mt_rand(0,1);
    $random5 = $random5 == 1 ? "남자" : "여자";
    $conn->query("set session character_set_connection=utf8;");
    $conn->query("set session character_set_results=utf8;");
    $conn->query("set session character_set_client=utf8;");
    $query = "insert into $table (id,pw,name,email,tel,sex,year,month,day,ip,lv)
    values ('{$array2[$random1]}','$pw','{$array1[$random1]}','aa','aa','{$random5}','$random2','$random3','$random4','On','1')";
    echo $query;
    $conn->query($query);
  }
  exit;
}elseif(isset($_POST['mode'])&&$_POST['mode']=="CMS"){?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
      <table>
        <tr>
          <td><input type="checkbox" name="login_point" value="Y" style="vertical-align:-2px"> 출석체크 포인트서비스 허용</td>
  				<td><input type="checkbox" name="push_point" value="Y" style="vertical-align:-2px"> 푸쉬체크 포인트서비스 허용</td>
  				<td><input type="checkbox" name="install_point" value="Y" style="vertical-align:-2px"> 앱설치 포인트서비스 허용</td>
  				<td><input type="checkbox" name="app_cart" value="Y" style="vertical-align:-2px"> 장바구니 리마인드 서비스 허용</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="app_retarget" value="Y" style="vertical-align:-2px"> 리타겟팅 서비스 허용</td>
          <td><input type="checkbox" name="app_ma" value="Y" style="vertical-align:-2px"> 마케팅오토메이션 서비스 허용</td>
  				<td><input type="checkbox" name="push_msg_show" value="Y" style="vertical-align:-2px"> 푸쉬메세지 소식란에 보이도록 허용</td>
  				<td><input type="checkbox" name="script_api" value="Y" style="vertical-align:-2px"> Device ID 값 리턴 허용</td>
        </tr>
        <tr>
  				<td><input type="checkbox" name="app_members" value="Y" style="vertical-align:-2px"> 앱사용자 관리 허용</td>
          <td><input type="checkbox" name="lock_screen" value="Y" style="vertical-align:-2px"> 잠금화면설정 서비스 허용</td>
  				<td><input type="checkbox" name="reward_opt" value="1" style="vertical-align:-2px"> 추천리워드 허용</td>
  				<td><input type="checkbox" name="push_popup" value="Y" style="vertical-align:-2px"> 팝업푸쉬 허용</td>
        </tr>
        <tr>
  				<td><input type="checkbox" name="push_call_back" value="Y" style="vertical-align:-2px"> 푸쉬 리시브 콜백 허용</td>
          <td><input type="checkbox" name="is_fcm" value="Y" style="vertical-align:-2px"> 푸쉬 FCM 발송 적용</td>
          <td><input type="checkbox" name="script_popup" value="Y" style="vertical-align:-2px"> 스크립트 설치업체(앱설치배너,매출통계 등)</td>
        </tr>
      </table>
    </body>
  </html>
  <?
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
    <cender>
      <h1>mode</h1>
      <form action="test.php" method="post">
        <input type="text" name="mode">
        <input type="submit" value="전송">
      </form>
    </cender>
  </body>
</html>
