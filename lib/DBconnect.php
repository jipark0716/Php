<?
// error_reporting(0);
$host = 'localhost';
$user = 'stu_pji';
$pw = 'aa1234';
$dbName = 'stu_pji';
$conn = new mysqli($host, $user, $pw, $dbName);
if (!$conn) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$conn->query("set session character_set_connection=utf8;");
$conn->query("set session character_set_results=utf8;");
$conn->query("set session character_set_client=utf8;");
// $query = "SELECT * FROM naver_user_info";
// $result = $conn->query($query);
// foreach ($result as $key) {
//   echo $key['idx'];
// }
?>
