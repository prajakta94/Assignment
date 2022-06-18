<?php

namespace Drupal\site_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a config location Form.
 *
 * @class
 * LocationInfoForm
 */
class LocationInfoForm extends ConfigFormBase {

  const SETTINGS = 'site_location.location_config_settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'location_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $form['Country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('Country'),
      '#description' => $this->t('Enter Country Name'),
      '#required' => TRUE,
    ];

    $form['City'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('City'),
      '#description' => $this->t('Enter the City Name'),
      '#required' => TRUE,
    ];

    $form['Timezone'] = [
        '#type' => 'select',
        '#title' => $this->t('Select Timezone'),
        '#options' => [
          'America/Chicago' => $this->t('America/Chicago'),
          'America/New_York' => $this->t('America/New_York'),
          'Asia/Tokyo' => $this->t('Asia/Tokyo'),
          'Asia/Dubai' => $this->t('Asia/Dubai'),
          'Asia/Kolkata' => $this->t('Asia/Kolkata'),
          'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
          'Europe/Oslo' => $this->t('Europe/Oslo'),
          'Europe/London' => $this->t('Europe/London'),
        ],
        '#default_value' => $config->get('Timezone'),
        '#required' => TRUE,
      ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('Country', $form_state->getValue('Country'))
      ->set('City', $form_state->getValue('City'))
      ->set('Timezone', $form_state->getValue('Timezone'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
