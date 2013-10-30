<?php

namespace Drupal\hello\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a hello language annotation object.
 *
 * @Annotation
 */
class HelloLanguage extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the hello language.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $label;

}