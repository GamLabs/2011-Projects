<?php
//template for Marinelli Theme
//author: singalkuppe - www.signalkuppe.com
$commands = array();
$commands[] = array('selector' => '#page', 'effect' => 'round', 'corners' => 'all', 'width' => 10);
rounded_corners_add_corners($commands);


function marinelli_width($left, $right) {
  $width = "short";
  if (!$left ) {
    $width = "long";
  }  
  
   if (!$right) {
    $width = "long";
  }
  return $width;
}



/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
      $breadcrumb[] = drupal_get_title();
        array_shift($breadcrumb);
       return '<div class="path"><p><span>'.t('You are here').'</span>'. implode(' / ', $breadcrumb) .'</p></div>';
  }
  }


//overrides taxonomy term page function
function marinelli_taxonomy_term_page($tids, $result) {
  drupal_add_css(drupal_get_path('module', 'taxonomy') .'/taxonomy.css');

  $output = '';

  // Only display the description if we have a single term, to avoid clutter and confusion.
  if (count($tids) == 1) {
    $term = taxonomy_get_term($tids[0]);
    $description = $term->description;

    // Check that a description is set.
    if (!empty($description)) {
      $output .= '<div class="terminfo"><p>';
      $output .= filter_xss_admin($description);
      $output .= '</p></div>';
    }
  }

  $output .= taxonomy_render_nodes($result);

  return $output;
}





function marinelli_admin_page($blocks) {
  $stripe = 0;
  $container = array();

  foreach ($blocks as $block) {
    if ($block_output = theme('admin_block', $block)) {
      if (empty($block['position'])) {
        // perform automatic striping.
        $block['position'] = ++$stripe % 2 ? 'left' : 'right';
      }
      if (!isset($container[$block['position']])) {
        $container[$block['position']] = '';
      }
      $container[$block['position']] .= $block_output;
    }
  }

  $output = '<div class="admin clear-block">';
  $output .= '<div class="compact-link"><p>'; // use <p> for hide/show anchor
  if (system_admin_compact_mode()) {
    $output .= l(t('Show descriptions'), 'admin/compact/off', array('title' => t('Expand layout to include descriptions.')));
  }
  else {
    $output .= l(t('Hide descriptions'), 'admin/compact/on', array('title' => t('Compress layout by hiding descriptions.')));
  }
  $output .= '</p></div>';

  foreach ($container as $id => $data) {
    $output .= '<div class="'. $id .' clear-block">';
    $output .= $data;
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}

function marinelli_admin_block_content($content) {
  if (!$content) {
    return '';
  }

  if (system_admin_compact_mode()) {
    $output = '<dl class="menu">';
    foreach ($content as $item) {
      $output .= '<dt>'. l($item['title'], $item['href'], $item['localized_options']) .'</dt>'; // use definition list per compact mode
    }
    $output .= '</dl>';
  }
  else {
    $output = '<dl class="admin-list">';
    foreach ($content as $item) {
      $output .= '<dt>'. l($item['title'], $item['href'], $item['localized_options']) .'</dt>';
      $output .= '<dd>'. $item['description'] .'</dd>';
    }
    $output .= '</dl>';
  }
  return $output;
}

function marinelli_system_admin_by_module($menu_items) { // admin by module page
  $stripe = 0;
  $output = '';
  $container = array('left' => '', 'right' => '');
  $flip = array('left' => 'right', 'right' => 'left');
  $position = 'left';

  // Iterate over all modules
  foreach ($menu_items as $module => $block) {
    list($description, $items) = $block;

    // Output links
    if (count($items)) {
      $block = array();
      $block['title'] = $module;
      $block['content'] = theme('item_list', $items);
      $block['description'] = t($description);

      if ($block_output = theme('admin_block', $block)) {
        if (!isset($block['position'])) {
          // Perform automatic striping.
          $block['position'] = $position;
          $position = $flip[$position];
        }
        $container[$block['position']] .= $block_output;
      }
    }
  }

  $output = '<div class="bymodule">';
  foreach ($container as $id => $data) {
    $output .= '<div class="'. $id .' clear-block">';
    $output .= $data;
    $output .= '</div>';
  }
  $output .= '</div>';

  return $output;
}

function phptemplate_get_primary_links() {
  return menu_tree(variable_get('menu_primary_links_source', 'primary-links'));
}


// retrieve custom theme settings


$preload = theme_get_setting('cssPreload'); // print the js file if we choose css image preload

if($preload == '1'){
	
	drupal_add_js(drupal_get_path('theme','marinelli').'/js/preloadCssImages.jQuery_v5.js'); // load the javascript
	drupal_add_js('$(document).ready(function(){
		
	$.preloadCssImages();
		
	});
	
	','inline');

}

	
$valore = theme_get_setting('menutype'); // if we choose dropdown

if($valore == '1'){ 
 
    drupal_add_js(drupal_get_path('theme','marinelli').'/js/jquery.hoverIntent.minified.js'); // load the javascript
	drupal_add_js(drupal_get_path('theme','marinelli').'/js/marinellidropdown.js'); // load the javascript
	drupal_add_css(drupal_get_path('theme','marinelli').'/dropdown.css'); // load the css
	
}

function marinelli_preprocess() {
// if rounded corners module is installed and enabled, round corners on certain elements using jquery
// else do nothing
 if (function_exists('rounded_corners_add_corners')){
  $btmround = array();
  $btmround[] = array('selector' => '.btmround');
  rounded_corners_add_corners($btmround);
  $divnormal = array();
  $divnormal[] = array('selector' => '.divnormal');
  rounded_corners_add_corners($divnormal);
  $divnormaldark = array();
  $divnormaldark[] = array('selector' => '.divnormaldark');
  rounded_corners_add_corners($divnormaldark);
  $btrround = array();
  $btrround[] = array('selector' => '.btrround');
  rounded_corners_add_corners($btrround);
  $btrround4 = array();
  $btrround4[] = array('selector' => '.btrround4', 'width' => 4);
  rounded_corners_add_corners($btrround4);
  $blockmenuleaf = array();
  $blockmenuleaf[] = array('selector' => '#block-menu-menu-footernav li.leaf', 'width' => 5);
  rounded_corners_add_corners($blockmenuleaf);
  $blockimagemenu1 = array();
  $blockimagemenu1[] = array('selector' => '#block-imagemenu-1');
  rounded_corners_add_corners($blockimagemenu1);
 }
 else {
 return;
 }
}
