<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\block\Annotation\Block;
use Drupal\Core\Annotation\Translation;

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
    return array(
      'greeting' => array(
        // ViewsBlockBase.php has a potential method..
        '#markup' => 'This should really use the service.. but how??',
      ),
    );
  }

}