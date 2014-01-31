<?php

namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloBeGreetedAccessCheck implements AccessCheckInterface {

  // This is roughly the equivalent of getFormID?
  public function applies(Route $route) {
    return array('_access_hello_be_greeted');
  }

  public function access(Route $route, Request $request, AccountInterface $account) {
    // We could do some logic here, but this is just a proof of concept.
    return static::ALLOW; // other options DENY, KILL
  }
}