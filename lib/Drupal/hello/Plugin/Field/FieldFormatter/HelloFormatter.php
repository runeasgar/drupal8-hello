<?php

namespace Drupal\hello\Plugin\field\FieldFormatter;

// FormatterBase class.
use Drupal\Core\Field\FormatterBase;
// FieldItemInterface
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'foo_formatter' formatter
 *
 * @FieldFormatter(
 *   id = "hello_formatter",
 *   label = @Translation("Hello formatter"),
 *   field_types = {
 *     "text"
 *   },
 *   settings = {
 *     "use_comma" = "1",
 *   },
 *    edit = {
 *      "editor" = "form"
 *    }
 * )
 */
class HelloFormatter extends FormatterBase {

  public function settingsForm(array $form, array &$form_state) {
    $element = array();

    $element['use_comma'] = array(
      '#title' => t('Use comma'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('use_comma'),
    );

    return $element;
  }

  public function settingsSummary() {
    $summary = array();
    if ($this->getSetting('use_comma')) {
      $output = 'Yes';
    } else {
      $output = 'No';
    }
    $summary[] = t('Use Comma: @use_comma', array('@use_comma' => $output));
    return $summary;
  }

  public function viewElements(FieldItemListInterface $items) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $output = $item->processed;
      if ($this->getSetting('use_comma')) {
        $output = 'Hello, ' . $output;
      } else {
        $output = 'Hello ' . $output;
      }
      $elements[$delta] = array('#markup' => $output);
    }
    return $elements;
  }

}