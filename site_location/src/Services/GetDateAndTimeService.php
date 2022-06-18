<?php

namespace Drupal\site_location\Services;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime;

/**
 * Defines a service to get Date and time as per timezone seclection.
 *
 * @class GetDateAndTimeService
 */

class GetDateAndTimeService {
  /**
   * Config Factory Object.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->configFactory = $configFactory;
  }
  /**
   *Function to get time as per Timezone
   */
  public function getTimefromtimezone(){
    $keys = $this->configFactory->get('site_location.location_config_settings')->get('Timezone');
    //$tz = \Drupal::config('site_location.location_config_settings')->get('Timezone');
    $tz_obj = new \DateTimeZone($keys);
    $today = new \DateTime("now", $tz_obj);
    $data = $today->format('d M Y h:i:s');
    return $data;
  }

}