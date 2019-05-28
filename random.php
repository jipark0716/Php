<?
$table = "sortilege";
include "naver/DBconnect.php";
$member = array('박정인','박찬웅','조성현');
// $colList = array('date','당첨','당첨1');
$query = "select date from $table order by date desc limit 1";
$lastDate = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
$nowDate = date("ymd",time());
$random1 = mt_rand(0,2);
$random2 = mt_rand(0,2);
if($nowDate>$lastDate[0]){
  $query = "insert into $table (date,당첨,당첨2) values('{$nowDate}','{$random1}','{$random2}')";
  $conn->query($query);
}
$query = "select * from $table order by date desc";
$result = $conn->query($query);
if(isset($_GET['mode'])&&$_GET['mode']=='info'){
  $query = "select count(*) from $table";
  $dataCount = mysqli_fetch_array($conn->query($query),MYSQLI_BOTH);
  $query = "select count(*) as count from $table orders group by 당첨";
  $result = $conn->query($query);
  $count = 0;
  foreach ($result as $key => $value) {
    $memberCount[$count] = ($value['count']/$dataCount[0])*360;
    $count++;
  }
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="/css/random.css?<?=time()?>">
      <script type="text/javascript">

          function draw(){
            //정인
            var size = 50;

            var ctx = document.getElementById('pji').getContext("2d");
            ctx.beginPath();
            ctx.moveTo(size, size);
            ctx.arc(size,size,size, (Math.PI/180)*<?=$memberCount[0]?>,(Math.PI/180)*0,true);
            ctx.fillStyle = "#0000ff";
            ctx.fill();
            //찬웅
            var ctx = document.getElementById('pcw').getContext("2d");
            ctx.beginPath();
            ctx.moveTo(size, size);
            ctx.arc(size,size,size, (Math.PI/180)*<?=$memberCount[0]+$memberCount[1]?>,(Math.PI/180)*<?=$memberCount[0]?>,true);
            ctx.fillStyle = "#ff00ff";
            ctx.fill();
            //성현
            var ctx = document.getElementById('jsh').getContext("2d");
            ctx.beginPath();
            ctx.moveTo(size, size);
            ctx.arc(size,size,size, (Math.PI/180)*0,(Math.PI/180)*360,true);
            ctx.fillStyle = "#ff0000";
            ctx.fill();
          }
      </script>

  </head>
  <body onload="draw();">
    <div class="draw">
      <canvas id="pji" class="circle"></canvas>
      <canvas id="pcw" class="circle"></canvas>
      <canvas id="jsh" class="circle"></canvas>
    </div>
    <div class="tjfaud">
      <ul>
        <li>정인<div></div></li>
        <li>찬웅<div></div></li>
        <li>성현<div></div></li>
      </ul>
    </div>
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
    <title>디지텍-출석부</title>
    <link href="./css/mobile.css" media="screen and (min-width: 200px) and (max-width: 2000px)" rel="stylesheet">
    <link rel="stylesheet" href="./css/random.css?<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Pen+Script&amp;subset=korean" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Nanum+Pen+Script&amp;subset=korean" rel="stylesheet">
  </head>
  <body>
    <div id="background">
      <div id="wrap">
        <div class="menu_bar">
          <button type="button" onclick="document.location='random.php?mode=info'">통계보러가기</button>
        </div>
        <center>
          <h1>출석부 담당</h1>
        </center>
        <div id="scroll">
          <table  class="menu">
            <thead>
              <tr>
                <th class="a_box">날짜</th>
                <th class="b_box">가져와라</th>
                <th class="b_box">갔다놔라</th>
              </tr>
            </thead>
          </table>
          <table class="nowDate">
            <colgroup>
              <col width="30%">
              <col width="35%">
              <col width="35%">
            </colgroup>
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?
                foreach ($result as $key) {
                  ?>
                    <tr>
                      <?
                        if($nowDate==$key['date']){
                          ?><td>오늘</td><?
                        }else{
                          ?><td><?=floor($key['date']/10000)?>년<?=floor(($key['date']%10000)/100)?>월<?=floor($key['date'])%100?>일</td><?
                        }
                      ?>
                      <td><?=isset($key['당첨'])? $member[$key['당첨']] : "-" ?></td>
                      <td><?=isset($key['당첨2'])? $member[$key['당첨2']] : "-" ?></td>
                    </tr>
                  <?
                }
              ?>
            </tbody>
          </table>
        </div>
        <center>
          <h3>Copyright&copy;2018 이쁜 정인이 All Rights Reserved</h3>
        </center>
      </div>
    </div>
  </body>
</html>
