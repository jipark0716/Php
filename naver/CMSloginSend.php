<?
$table = "CMS_info";
include "lib.php";
include "DBconnect.php";
//입력 오류 체크
if(isset($_POST['idSave'])&&$_POST['idSave']=="on"){
  setcookie('idSave',$_POST['id'],time()+86400 * 30);
}else{
  setcookie("idSave", "", time() - 3600);
}
//입력 오류 체크
$loginFormList = array("id","pw","idSave");
for ($i=0; isset($loginFormList[$i+1]) ; $i++) {
  if($_POST[$loginFormList[$i]]==""){
    exit_($loginFormList[$i] . "를 입력해주세요","/naver/CMSlogin.php");
  }
}
//아이디 비밀번호 확인
$query = "select count(*) from $table where id = '{$_POST["id"]}'";
$result = mysqli_fetch_array($conn->query($query), MYSQLI_BOTH);
if($result[0]==0){
  hisBack("존재하지 않는 아이디 입니다");
}
$query = "select password from $table where id = '{$_POST["id"]}'";
$result = mysqli_fetch_array($conn->query($query), MYSQLI_BOTH);
if ($result["password"]!=sha1($_POST["pw"])) {
  hisBack("비밀번호가 일치하지 않음");
}else{
  $query = "select idx from $table where id = '{$_POST['id']}'";
  $result = mysqli_fetch_array($conn->query($query), MYSQLI_BOTH);
  session_start();
  $_SESSION['idx'] = $result['idx'];
  exit_("로그인 성공","/naver/CMS.php");
}
?>
