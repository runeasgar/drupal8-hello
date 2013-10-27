<?php

namespace Drupal\hello\Tests;

use Drupal\simpletest\WebTestBase;

class HelloUITest extends WebTestBase {

  protected $profile = 'testing';
  public static $modules = array('hello');

  /**
   * Standard test user.
   */
  protected $web_user;

  public static function getInfo() {
    return array(
      'name' => 'Test Hello UI',
      'description' => "Ensures that hello module delivers text.",
      'group' => 'Hello',
    );
  }

  function setUp() {
    parent::setUp();

    $this->web_user   = $this->drupalCreateUser(array('be greeted'));
  }

  function testHelloHome() {
    $this->drupalGet("hello");
    $this->assertText('Hello');
  }

}