<?php

namespace Drupal\hello\Plugin\HelloLanguage;

use Drupal\hello\HelloLanguageInterface;

/**
 * Displays hello in French
 *
 * @HelloLanguage(
 *   id = "french",
 *   label = @Translation("French (Bonjour)")
 * )
 */
class French implements HelloLanguageInterface {

  function helloTranslation() {
    return 'Bonjour';
  }

}
