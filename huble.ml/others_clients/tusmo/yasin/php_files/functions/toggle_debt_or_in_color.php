<?php
function toggle_debt_color($val){
    if(preg_match('/-/', $val)){
      return 'in_color';
    }else {
      return 'debt_color';
    }
}

?>