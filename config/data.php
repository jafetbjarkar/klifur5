<?php
  // - SET ACTIVE SITE
  $site = 'klifur';
  // $site = 'isalp';

  if($site == 'klifur') {
    // Change the favicon
    $favicon = get_stylesheet_directory_uri() . "/images/favicon-klifur.png?v=1";
    // Main site logo
    $site_logo = get_stylesheet_directory_uri() . "/images/klifur-logo.svg";
    // In Problems: Used to populate climbing type DD
    $type_of_climbing = ['boulder' => 'Boulder', 'sport'=> 'Sport', 'trad' => 'Traditional' ];
    // Crag google map
    $map_embed = '<iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msid=205265335858135699416.00048240a25d103bca6b8&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=65.007224,-19.248047&amp;spn=3.715753,15.358887&amp;z=6&amp;output=embed"></iframe>';
    // ACF climbing type categories
    $climbing_types = ['Boulder', 'Sport climbing', 'Traditional climbing'];
    // The add route link markup
    $add_route_link = '<p><a href="http://klifur.is/wp-admin/post-new.php">Veist þú um eina?"</a></p>';

  } elseif($site == 'isalp') {
    $favicon = get_stylesheet_directory_uri() . "/images/favicon-isalp.png?v=2";
    $site_logo = get_stylesheet_directory_uri() . "/images/isalp-logo.png";
    $type_of_climbing = ['ice' => 'Ísklifur', 'mix' => 'Mix-klifur', 'alpine' => 'Alpaklifur'];
    $map_embed = '<iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/d/u/0/embed?mid=zGE0gm__fSLs.kd4v-EC61tc4"></iframe>';
    $climbing_types = ['ice', 'mix', 'alpine'];
    $add_route_link = '<p><a href="http://super.isalp.is/wp-admin/post-new.php">Veist þú um eina?"</a></p>';
  }

?>
