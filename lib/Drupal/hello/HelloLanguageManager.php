<?php

namespace Drupal\hello;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Plugin\DefaultPluginManager;
use Traversable;

class HelloLanguageManager extends DefaultPluginManager {

  public function __construct(Traversable $namespaces, CacheBackendInterface $cache_backend, LanguageManager $language_manager, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/HelloLanguage', $namespaces, 'Drupal\hello\Annotation\HelloLanguage');

    $this->alterInfo($module_handler, 'hello_language_info');
    $this->setCacheBackend($cache_backend, $language_manager, 'hello_language');
  }

}