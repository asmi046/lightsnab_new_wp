<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head profile="http://gmpg.org/xfn/11"> 
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

  <title><?php wp_title(); ?></title>

  <link rel="icon" type="image/png" sizes="256x256" href="<?php echo get_template_directory_uri();?>/img/favicons/icon256.png">
  <link rel="icon" type="image/png" sizes="128x128" href="<?php echo get_template_directory_uri();?>/img/favicons/icon128.png">
  <link rel="icon" type="image/png" sizes="64x64" href="<?php echo get_template_directory_uri();?>/img/favicons/icon64.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/img/favicons/icon32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/img/favicons/icon16.png">
  <link rel="icon" type="image/svg+xml" sizes="any" href="<?php echo get_template_directory_uri();?>//img/favicons/iconSVG.svg"> 

  <link rel="stylesheet" href="css/style.css">

  <?php wp_head();?> 

  

</head> 
<body>
  <!-- Подключение  модальных окон-->
  <? include "modal-win.php";?>

  <!-- <div id="wrapper" class="wrapper"> -->
