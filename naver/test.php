<?
include "DBconnect.php";
$query = "select id from naver_user_info where idx = '29'";
$result = mysqli_fetch_array($conn->query($query));
echo $result[0];
echo $result[1];
echo $result[2];

echo "";
?>
