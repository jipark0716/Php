<?
session_start();
include "DBconnect.php";
include "lib.php";
$table = "naver_user_info";
if ($_POST['target']=="birthday") {
  if($_POST['year']<1900||$_POST['year']>2018){hisback("년도 입력 오류");}
  if($_POST['day']>31||$_POST['day']<1){hisback("날짜 입력 오류");}
  $value = $_POST['day']+($_POST['month']*100)+($_POST['year']*10000);
}elseif($_POST['target']=="password"){
  $value = sha1($_POST[$_POST['target']]);
}else{
  $value = $_POST[$_POST['target']];
}
$query = "update $table set
{$_POST['target']} = '{$value}'
where idx = '{$_SESSION['idx']}'";
$conn->query($query);
exit_("수정되었습니다","/naver/userInfo.php")
?>
