<?php include(locate_template('custom/_base.php')); ?>

<?php

// - TYPE OF CLIMBING
if($site == 'klifur') {
  $type_of_climbing = ['boulder' => 'Boulder', 'sport'=> 'Sport', 'trad' => 'Traditional' ];  
} elseif($site == 'isalp') {
  $type_of_climbing = ['ice' => 'Ísklifur', 'mix' => 'Mix-klifur'];
}

?>