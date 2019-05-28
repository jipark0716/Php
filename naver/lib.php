<?php
function exit_($message,$url){
  ?><script type="text/javascript">
    alert("<?=$message?>");
    document.location="<?=$url?>";
  </script><?
  exit;
}
function hisBack($message){
  ?><script type="text/javascript">
    alert("<?=$message?>");
    window.history.back();
  </script><?
  exit;
}
?>
