<?
include "{$_SERVER["DOCUMENT_ROOT"]}/lib/DBconnect.php";
$thisFile = basename($_SERVER['PHP_SELF']);
$table = "chatt_file_info";
$nowDate = time();

if(isset($_POST['fileUpload'])){
  $uploads_dir = './chatt/';
  $name = $_FILES['myfile']['name'];
  $error = $_FILES['myfile']['error'];
  $ext = array_pop(explode('.', $name));
  echo $ext;
  if( $error != UPLOAD_ERR_OK ) {
  	switch( $error ) {
  		case UPLOAD_ERR_INI_SIZE:
  		case UPLOAD_ERR_FORM_SIZE:
  			echo "파일이 너무 큽니다. ($error)";
  			break;
  		case UPLOAD_ERR_NO_FILE:
  			echo "파일이 첨부되지 않았습니다. ($error)";
  			break;
  		default:
  			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
  	}
    	exit;
  }
  if($ext != "txt"){
    echo "확장자 오류";
    exit;
  }
  $query = "select count(*) from {$table}";
  $result = mysqli_fetch_array($conn->query($query));
  $uploadName = "text{$result[0]}.txt";
  $query = "insert into {$table} (physicalName,logicalName,uploadName) values('{$uploadName}',{$nowDate},'{$_FILES['myfile']['name']}')";
  exit;
  $conn->query($query);
  move_uploaded_file( $_FILES['myfile']['tmp_name'], $uploads_dir.$uploadName);
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
    <div id="wrap">
      <div class="">
        <form enctype='multipart/form-data' action='<?=$thisFile?>' method='post'>
        	<input type='file' name='myfile'>
        	<input type="submit" value="보내기" name="fileUpload">
        </form>
      </div>
    </div>
  </body>
</html>
