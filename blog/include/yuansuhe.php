<?php
// 求元素和$a=array(1,2,3,array(4,5,6),array(4,3,3));
$array=array(1,2,3,array(4,5,6),array(4,3,3));
function get_sum($array) {
   $num = 0;
   foreach($array as $k => $v) {
     if(is_array($v)) {
       $num += get_sum($v);
     }
   }
   return $num + array_sum($array);
}
echo get_sum($array);