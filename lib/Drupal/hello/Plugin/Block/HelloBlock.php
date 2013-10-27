<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\block\BlockBase;

/**
 * Provides a 'Hello Block' block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello Block")
 * )
 */
class HelloBlock extends BlockBase {

  public function settings() {
    return array(
      'cache' => DRUPAL_NO_CACHE,
    );
  }

  public function build() {
    // This is NOT BEST PRACTICE - but BlockBase doesn't have simple dependency injection yet?
    $helloText = \Drupal::service('hello.text');
    return array(
      'greeting' => array(
        '#markup' => $helloText->getText(),
      ),
    );
  }

}