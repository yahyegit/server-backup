<?
function toggle_debt_color($val){
    if(preg_match('/-/', $val)){
      return 'debt_color';
    }else {
      return 'in_color';
    }
}

?>