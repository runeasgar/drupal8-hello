<?php

namespace Drupal\hello\Tests;

use Drupal\simpletest\WebTestBase;

class HelloFormatterTest extends WebTestBase {

  protected $profile = 'testing';
  public static $modules = array('hello', 'node', 'entity_test', 'field_ui');
  protected $field;
  protected $instance;
  protected $admin_user;

  public static function getInfo() {
    return array(
      'name' => 'Test Hello Formatter',
      'description' => "Ensures that hello formatter works as expected.",
      'group' => 'Hello',
    );
  }

  function setUp() {
    parent::setUp();
    $admin_user = $this->drupalCreateUser(array(
      'view test entity',
      'administer entity_test content',
      'administer content types',
    ));
    $this->drupalLogin($admin_user);

    // Create another field with settings to validate.
    $this->field = entity_create('field_entity', array(
      'name' => drupal_strtolower($this->randomName()),
      'entity_type' => 'entity_test',
      'type' => 'text',
    ));
    $this->field->save();
    $this->instance = entity_create('field_instance', array(
      'field_name' => $this->field->name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
      'settings' => array(
        'default_value' => 'blank',
      ),
    ));
    $this->instance->save();

    entity_get_form_display($this->instance->entity_type, $this->instance->bundle, 'default')
      ->setComponent($this->field->name, array(
        'type' => 'hello_formatter',
      ))
      ->save();

  }

  function testHelloFormatter() {

    // See DatetimeFieldTest.php where setUp was borrowed from.
    // Need to create an entity, get its ID, render it and make sure it renders properly.

    $this->display_options = array(
      'settings' => array('use_comma' => '1'),
    );
    entity_get_display($this->instance->entity_type, $this->instance->bundle, 'full')
      ->setComponent($this->field->name, $this->display_options)
      ->save();

  }

}