<?php

namespace Drupal\hello\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\hello\HelloText;

class HelloController implements ContainerInjectionInterface {

  protected $helloText;

  public function __construct(HelloText $helloText) {
    $this->helloText = $helloText;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('hello.text'));
  }

  public function hello($variable) {
    // We could use the request object here if we wanted! Just add Request $request to the arguments.
    $page = array(
      'greeting' => array(
        '#markup' => $this->helloText->getText(),
      ),
      'variable' => array(
        '#markup' => '<br />Also, this unsanitized URL string: ' . $variable . '.',
      ),
      'extra' => array(
         '#theme' => 'hello_greeting',
      ),
    );
    return $page;
  }

}