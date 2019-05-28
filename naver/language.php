<head>
  <link rel="stylesheet" href="/naver/css/language.css?v2">
</head>
<select onchange="check()" id="language" name="language">
  <?
  $languageList = array("ko","en","c1","c2");
    for($i=0;$i<4;$i++){
      if($language==$languageList[$i]){
        ?><option selected><?=$languageList[$i]?></option><?
      }else{
        ?><option value="<?=$languageList[$i]?>"><?=$languageList[$i]?></option><?
      }
    }
  ?>
</select>
<script>
  function check() {
    var target = document.getElementById("language");
    var selected = target.options[target.selectedIndex].value;
    location.href = "http://pji.iloveschool.me/naver/login.php?language="+selected;
  }
</script>
