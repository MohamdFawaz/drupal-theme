<?php

namespace Drupal\progressbar\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ProgressBarDefaultWidget' widget.
 *
 * @FieldWidget(
 *   id = "ProgressBarDefaultWidget",
 *   label = @Translation("Progress Bar select"),
 *   field_types = {
 *     "ProgressBar"
 *   }
 * )
 */
class ProgressBarDefaultWidget extends WidgetBase {

  /**
   * Define the form for the field type.
   *
   * Inside this method we can define the form used to edit the field type.
   *
   * Here there is a list of allowed element types: https://goo.gl/XVd4tA
   *
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    Array $element,
    Array &$form,
    FormStateInterface $formState
  ) {

    // Name

    $element['name'] = [
      '#type' => 'textfield',
      '#title' => t('Feature Name'),

      // Set here the current value for this field, or a default value (or
      // null) if there is no a value
      '#default_value' => isset($items[$delta]->name) ?
        $items[$delta]->name : null,

      '#empty_value' => '',
      '#placeholder' => t('Feature Name'),
    ];

    // progress

    $element['progress'] = [
      '#type' => 'textfield',
      '#title' => t('Feature Progress'),
      '#default_value' => isset($items[$delta]->progress) ?
        $items[$delta]->progress : null,
      '#empty_value' => '',
      '#placeholder' => t('Progress'),
    ];

    return $element;
  }

} // class