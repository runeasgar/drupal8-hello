<?php

namespace Drupal\hello\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a hello language annotation object.
 *
 * @Annotation
 */
class HelloLanguage extends Plugin {

  public $id;
  public $label;

}