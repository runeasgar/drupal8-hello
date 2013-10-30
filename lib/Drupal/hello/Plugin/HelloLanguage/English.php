<?php

namespace Drupal\hello\Plugin\HelloLanguage;

use Drupal\hello\HelloLanguageInterface;

/**
 * Displays hello in English
 *
 * @HelloLanguage(
 *   id = "english",
 *   label = @Translation("English (Hello)")
 * )
 */
class English implements HelloLanguageInterface {

  function helloTranslation() {
    return 'Hello';
  }

}
