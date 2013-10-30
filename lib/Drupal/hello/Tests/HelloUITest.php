<?php

namespace Drupal\hello\Tests;

use Drupal\simpletest\WebTestBase;

class HelloUITest extends WebTestBase {

  protected $profile = 'testing';
  public static $modules = array('hello', 'block');

  /**
   * Standard test user.
   */
  protected $web_user;

  /**
   * An admin user.
   */
  protected $admin_user;

  public static function getInfo() {
    return array(
      'name' => 'Test Hello UI',
      'description' => "Ensures that hello UI works as expected.",
      'group' => 'Hello',
    );
  }

  function setUp() {
    parent::setUp();
    $this->web_user = $this->drupalCreateUser(array('be greeted'));
    $this->admin_user = $this->drupalCreateUser(array('be greeted', 'administer blocks', 'administer hello'));
  }

  function testHelloHome() {
    $this->drupalLogin($this->web_user);
    $this->drupalGet('hello');
    $this->assertText('Hello, bob' . $this->web_user->getUsername());
  }

  function testHelloBlock() {
    $this->drupalLogin($this->admin_user);
    $this->drupalPlaceBlock('hello_block');
    $this->drupalGet('');
    $this->assertFieldById()
    $this->assertText('Hello, ' . $this->admin_user->getUsername());
  }

  function testHelloAdmin() {
    $this->drupalLogin($this->admin_user);

    $this->drupalGet('admin/config/hello/settings');
    //$this->assertFieldByName('show_username', '1');
    $this->assertFieldChecked('edit-show-username');
    $this->drupalGet('hello');
    $this->assertText('Hello, ' . $this->admin_user->getUsername());

    $this->drupalPlaceBlock('hello_block');
    $this->drupalGet("");
    $this->assertText('Hello, ' . $this->admin_user->getUsername());

    $this->drupalGet('admin/config/hello/settings');
    $this->drupalPostForm(NULL, array('show_username' => false), t('Save configuration'));
    $this->assertNoFieldChecked('edit-show-username');
    $this->drupalGet("hello");
    $this->assertText('Hello, world!');

  }

}