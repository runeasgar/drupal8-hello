<?php

namespace Drupal\hello;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\UserSession;

class HelloText {

  protected $config;
  protected $user;

  protected $text;

  public function __construct(ConfigFactory $config, UserSession $user) {
    $this->config = $config;
    $this->user = $user;
  }

  public function getText() {
    $hello_language_manager = \Drupal::service('plugin.manager.hello.hello_language');
    $hello_language_instance = $hello_language_manager->createInstance($this->config->get('hello.settings')->get('hello_language'));
    $hello_translation = $hello_language_instance->helloTranslation();
    if ($this->config->get('hello.settings')->get('show_username') == 0) {
      $extra = "world";
    } else {
      $extra = $this->user->getUsername();
    }
    return $hello_translation . ', ' . $extra . '!';
  }
}