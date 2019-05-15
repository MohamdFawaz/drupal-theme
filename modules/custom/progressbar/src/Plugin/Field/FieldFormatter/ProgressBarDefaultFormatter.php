<?php

namespace Drupal\progressbar\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;

/**
 * Plugin implementation of the 'ProgressBarDefaultFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "ProgressBarDefaultFormatter",
 *   label = @Translation("Progress Bar"),
 *   field_types = {
 *     "ProgressBar"
 *   }
 * )
 */
class ProgressBarDefaultFormatter extends FormatterBase {

  /**
   * Define how the field type is showed.
   *
   * Inside this method we can customize how the field is displayed inside
   * pages.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->name . ', ' . $item->progress
      ];
    }

    return $elements;
  }

} // class