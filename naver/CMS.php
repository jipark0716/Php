<?
$table = "naver_user_info";
include "lib.php";
include "DBconnect.php";
//로그인 여부 확인
session_start();
if(!isset($_SESSION['idx'])){
  exit_("로그인 해주세요","/naver/CMSlogin.php");
}
$query = "select count(*) from CMS_info where idx = '{$_SESSION['idx']}'";
$result = mysqli_fetch_array($conn->query($query), MYSQLI_BOTH);
if($result[0]==0){
  exit_("권한이 없습니다","/naver/userInfo.php");
}
//로그아웃
if(isset($_GET['mode'])&&$_GET['mode']=="logout"){
  session_destroy();
  exit_("로그아웃 되었습니다","/naver/CMSlogin.php");
}
if(!isset($_GET['pagerow'])||$_GET['pagerow']<1){$pagerow=10;}
else{$pagerow = $_GET['pagerow'];}
if(!isset($_GET['page'])||$_GET['page']<1){$nowpage=1;}
else{$nowpage = $_GET['page'];}
$query = "select count(*) from ".$table;
$dataCount = mysqli_fetch_array($conn->query($query));
$maxPage = (($dataCount[0]-1)/$pagerow)+1;
if($maxPage<$nowpage){hisBack("존재하지 않는 페이지 입니다.");}
$query = "select * from " . $table . " order by idx desc limit " . ($nowpage-1)*$pagerow . "," . $pagerow;
$result = $conn->query($query);
$count = 0;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/naver/css/CMS.css?<?=time()?>">
    <script type="text/javascript">
      var select = document.getElementsByName('select[]');
      function selectAll() {
        for (var i = 0; i < <?=$pagerow?>; i++) {
          select[i].checked = true;
        }
      }
      function deselectAll() {
        for (var i = 0; i < <?=$pagerow?>; i++) {
          select[i].checked = false;
        }
      }
    </script>
  </head>
  <body>
    <div id="menu">
      <a href="/naver/CMS.php?mode=logout">로그아웃</a>
    </div>
    <div id="wrap">
      <?include "header.php";?>
      <div class="tableInfo">
        <span>전체 회원수 : <?=$dataCount[0]?></span>
      </div>
      <div id="content">
        <div id="container">
          <div class="left">
            <form class="pageMove" action="/naver/CMS.php" method="get">
              <input type="hidden" name="pagerow" value="<?=$pagerow?>">
              <input type="number" name="page" value="<?=$nowpage?>" min = "1" max="<?=floor($maxPage)?>">
              <input type="submit" value="페이지 이동" size="10">
              <select onchange="location.href=this.value">
                <option value="/naver/CMS.php?page=1&pagerow=10" <?=$pagerow==10 ? "selected":" "?> >10개 씩</option>
                <option value="/naver/CMS.php?page=1&pagerow=20" <?=$pagerow==20 ? "selected":" "?> >20개 씩</option>
                <option value="/naver/CMS.php?page=1&pagerow=50" <?=$pagerow==50 ? "selected":" "?> >50개 씩</option>
                <option value="/naver/CMS.php?page=1&pagerow=100"<?=$pagerow ==100?"selected":" "?>>100개 씩</option>
              </select>
            </form>
          </div>
          <form action="CMSSend.php?mode=deletemulti" method="post">
            <input type="hidden" name="page" value="<?=$nowpage?>">
            <input type="hidden" name="pagerow" value="<?=$pagerow?>">
            <div class="deleteBTN">
              <div class="right">
                <input type="submit" value="선택된 항목 삭제">
                <input type="button" value="모두 선택" onclick="selectAll()">
                <input type="button" value="선택 취소" onclick="deselectAll()">
              </div>
            </div>
            <table id="userInfo">
              <colgroup>
                <col width="15%">
                <col width="5%">
                <col width="10%">
                <col width="15%">
                <col width="18%">
                <col width="7%">
                <col width="20%">
                <col width="15%">
              </colgroup>
              <tr>
                <th>id</th>
                <th>선택</th>
                <th>pw</th>
                <th>name</th>
                <th>birthday</th>
                <th>gender</th>
                <th>email</th>
                <th>수정</th>
              </tr>
              <?
                foreach ($result as $key) {
                  ?>
                    <tr>
                      <td><?=$key['id']?></td>
                        <td><input type="checkbox" class="select" name="select[]" value="<?=$key['idx']?>"></td>
                      <td>****</td>
                      <td><?=$key['name']?></td>
                      <td><?=floor($key['birthday']/10000)?>년<?=floor($key['birthday']%10000/100)?>월<?=floor($key['birthday'])%100?>일</td>
                      <td><?=$key['gender']=="남"?"남자":"여자"?></td>
                      <td><?=$key['email']==""?"-":$key['email']?></td>
                      <td>
                        <a href="CMSSend.php?mode=rewrite&target=<?=$key['idx']?>&<?=getenv("QUERY_STRING")?>">수정</a>
                        <a href="CMSSend.php?mode=remove&target=<?=$key['idx']?>&<?=getenv("QUERY_STRING")?>">삭제</a>
                      </td>
                    </tr>
                  <?
                }
              ?>
            </table>
          </form>
        </div>
        <div id="pageing">
          <?
          //페이징
          $pagepage = floor(($nowpage-1)/10);
          if($pagepage!="0"){
            ?><a href="CMS.php?page=1&pagerow=<?=$pagerow?>">맨처음  </a>
            <a href="CMS.php?page=<?=$nowpage-(($nowpage-1)%10)-1?>&pagerow=<?=$pagerow?>">이전</a><?
          }
            for($i=($pagepage*10)+1;$i<=($pagepage+1)*10;$i++){
              if($i>=($dataCount[0]/$pagerow)+1){break;}
              if($nowpage==$i){?><span><?=$i?></span><?}
              else{?> <a href="CMS.php?page=<?=$i?>&pagerow=<?=$pagerow?>"><?=$i?></a> <?}
            }
            if(($i-1)*$pagerow<$dataCount[0]){
          ?>
          <a href="CMS.php?page=<?=$i?>&pagerow=<?=$pagerow?>">다음</a>
          <a href="CMS.php?page=<?=floor($maxPage)?>&pagerow=<?=$pagerow?>"> 맨뒤로</a>
          <?}?>
        </div>
      </div>
      <?include "footer.php";?>
    </div>
  </body>
</html>
