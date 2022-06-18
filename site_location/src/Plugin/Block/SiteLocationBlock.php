<?php

namespace Drupal\site_location\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Site Location Info' Block.
 *
 * @Block(
 *   id = "Site_location_Info",
 *   admin_label = @Translation("Site Location Info Block"),
 *   category = @Translation("Site Location Info Block"),
 * )
 */

class SiteLocationBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    // $timeupdated = $this->$load_data->getTimefromtimezone();
    $timeupdated = \Drupal::service('site_location.timeservice')->getTimefromtimezone();
    $country = \Drupal::config('site_location.location_config_settings')->get('Country');
    $city = \Drupal::config('site_location.location_config_settings')->get('City');

    $render = [
      '#theme' => 'show_datetime',
      '#timeupdated' => $timeupdated,
      '#country' => $country,
      '#city' => $city,
    ];
    return $render;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}