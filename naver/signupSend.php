<?
$table = "naver_user_info";
include "DBconnect.php";
include "lib.php";
//입력 오류 체크
$loginFormList = array("id","pw","pwck","name","year","month","day","gender","email","call");
for ($i=0; isset($loginFormList[$i]) ; $i++) {
  if($loginFormList[$i]=="email"){continue;}
  if(trim($_POST[$loginFormList[$i]])==""){
    hisBack($loginFormList[$i] . "를 입력해주세요");
    break;
  }
  if($_POST[$loginFormList[$i]]=='empty'){
    hisBack($loginFormList[$i] . "를 입력해주세요");
    break;
  }
}
if($_POST['pw']!=$_POST['pwck']){
  hisBack("비밀번호 일치하지 않음");
}
  //날짜 입력 체크
if($_POST['year']>2018||$_POST['year']<1900||!is_numeric($_POST['year'])){
  hisBack("년도 입력이 올바르지 않음");
}
if($_POST['month']>31||$_POST['month']<1||!is_numeric($_POST['month'])){
  hisBack("월 입력이 올바르지 않음");
}
if($_POST['day']>31||$_POST['day']<1||!is_numeric($_POST['day'])){
  hisBack("일 입력이 올바르지 않음");
}
if(!is_numeric($_POST['call'])){
  hisBack("전화번호는 숫자만 입력해주세요");
}
//id 중복확인
$query = "select count(*) from $table where id = '{$_POST['id']}'";
$result = mysqli_fetch_array($conn->query($query), MYSQLI_BOTH);
if ($result[0]>0) {
  hisBack("아이디 중복");
}
//디비 입력
$birthday = $_POST['day']+($_POST['month']*100)+($_POST['year']*10000);
$password = sha1($_POST["pw"]);
$query = <<<EOD
insert into $table (id,password,name,birthday,gender,email,call_)
values ('{$_POST["id"]}','{$password}','{$_POST["name"]}','{$birthday}','{$_POST["gender"]}','{$_POST["email"]}',{$_POST["call"]})
EOD;
$conn->query($query);
exit_("회원가입 완료, 로그인 해주세요","/naver/login.php");
?>
