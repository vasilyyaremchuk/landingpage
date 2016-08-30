<?php

namespace Drupal\landingpage\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;

/**
 * Class LandingpageThemeNegotiator.
 *
 * @package Drupal\landingpage
 */
class LandingpageThemeNegotiator implements ThemeNegotiatorInterface {

  public function applies(RouteMatchInterface $route_match) {
    // Retrieve an array which contains the path pieces.
    $current_path = \Drupal::service('path.current')->getPath();
    $path_args = explode('/', $current_path);
  	$node = $route_match->getParameter('node');
    if (!empty($node) && $route_match->getParameter('node')->bundle() == 'paragraph_test' && empty($path_args[3])) {
      return TRUE;
    }
    return FALSE;    	
  }
 
  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    return 'landingpage_service';
  }

}
