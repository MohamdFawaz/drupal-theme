<?php

/**
 * @file
 * Contains \Drupal\first\Plugin\Field\FieldWidget\UploaderDefaultWidget.
 */

namespace Drupal\first\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Plugin implementation of the 'uploader_default' widget.
 *
 * @FieldWidget(
 *   id = "uplaoder_default",
 *   label = @Translation("Uploader default"),
 *   field_types = {
  *     "uploader"
  *   }
 * )
 */

class UploaderDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $config = $this->getConfiguration();
    $cardinality = 0;

    $form['uploader'] = [
      '#title' => $this->t('File upload'),
      '#type' => 'dropzonejs',
      '#required' => TRUE,
      '#dropzone_description' => $config['settings']['dropzone_description'],
      '#max_filesize' => $config['settings']['max_filesize'],
      '#extensions' => $config['settings']['extensions'],
      '#max_files' => ($cardinality > 0) ? $cardinality : 0,
      '#clientside_resize' => $config['settings']['clientside_resize'],
    ];
    return $element;
  }

}