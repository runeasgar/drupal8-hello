<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\hello\HelloText;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Hello Block' block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello Block")
 * )
 */
class HelloBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $helloText;

  // Seems like something here is causing the notice warnings and killing the block title..
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, array $plugin_definition) {
    return new static($container->get('hello.text'), $configuration, $plugin_id, $plugin_definition);
  }

  public function __construct(HelloText $helloText, array $configuration, $plugin_id, array $plugin_definition) {
    $this->helloText = $helloText;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  public function settings() {
    return array(
      'cache' => DRUPAL_NO_CACHE,
    );
  }

  public function build() {
    //var_dump($this->helloText);
    return array(
      'greeting' => array(
        '#markup' => $this->helloText->getText(),
      ),
    );
  }

}