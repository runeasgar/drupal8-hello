<?php

namespace Drupal\hello;

use Drupal\Core\Config\ConfigFactory;
// This is never used.. remove? Looks like it's involved in getting username, below.
use Drupal\Core\Session\UserSession;

class HelloText {

  protected $config;
  protected $user;

  protected $text;

  // Not type-hinting UserSession or User here because it seems the service is being provided both at different times.
  public function __construct(ConfigFactory $config, $user) {
    $this->config = $config;
    $this->user = $user;
  }

  public function getText() {
    // This should be refactored to dependency inject the HelloLanguageManager object using the services file.
    // However, it looks like this is not yet ready in D8 head last I checked.
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