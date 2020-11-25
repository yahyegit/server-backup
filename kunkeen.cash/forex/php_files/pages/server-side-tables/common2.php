<?php
          $Balances_ = get_balance_($aRow['customer_id']);
          $Balance_array = get_balance($aRow['customer_id']);
$c = 0;
foreach ($Balance_array as $key => $value) {
     $c = $c + $value;
}


?>