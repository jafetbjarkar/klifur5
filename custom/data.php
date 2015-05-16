<?php


// - TYPE OF CLIMBING
// In Problems: Used to populate climbing type DD
if($site == 'klifur') {
  $type_of_climbing = ['boulder' => 'Boulder', 'sport'=> 'Sport', 'trad' => 'Traditional' ];
} elseif($site == 'isalp') {
  $type_of_climbing = ['ice' => 'Ísklifur', 'mix' => 'Mix-klifur'];
}

// - GOOGLE MAP
// In Crags: Which map to use?
if($site == 'klifur') {
  $map_embed = '<iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msid=205265335858135699416.00048240a25d103bca6b8&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=65.007224,-19.248047&amp;spn=3.715753,15.358887&amp;z=6&amp;output=embed"></iframe>';
} elseif($site == 'isalp') {
  $map_embed = '';
}


// - LOGIN LOGO







?>