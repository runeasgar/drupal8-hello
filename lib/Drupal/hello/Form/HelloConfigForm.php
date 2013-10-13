<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;

class HelloConfigForm extends ConfigFormBase {

  public function getFormID() {
    return 'hello.settings';
  }

  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('hello.settings');
    $show_username = $config->get('show_username');
    $form['show_username'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show username on hello page?'),
      '#default_value' => $show_username,
      '#description' => $this->t('Just as an example..'),
    );
    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, array &$form_state) {
    $this->configFactory->get('hello.settings')
      ->set('show_username', $form_state['values']['show_username'])
      ->save();
    return parent::submitForm($form, $form_state);
  }

}