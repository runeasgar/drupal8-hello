<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Cache\Cache;

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
    $form['hello_language'] = array(
      '#type' => 'radios',
      '#title' => t('Hello language'),
      '#options' => array(),
      '#default_value' => $config->get('hello_language'),
      '#description' => t('Choose language for the word hello.'),
    );
    $hello_language_manager = \Drupal::service('plugin.manager.hello.hello_language');
    foreach($hello_language_manager->getDefinitions() as $id => $definition) {
      $form['hello_language']['#options'][$id] = $definition['label'];
    }
    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, array &$form_state) {
    $this->configFactory->get('hello.settings')
      ->set('show_username', $form_state['values']['show_username'])
      ->save();
    $this->configFactory->get('hello.settings')
      ->set('hello_language', $form_state['values']['hello_language'])
      ->save();
    parent::submitForm($form, $form_state);
    // per pants
    Cache::invalidateTags(array('config' => 'hello.settings'));
  }

}