<?php

namespace Drupal\progressbar\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface as StorageDefinition;

/**
 * Plugin implementation of the 'ProgressBar' field type.
 *
 * @FieldType(
 *   id = "ProgressBar",
 *   label = @Translation("Progress Bar"),
 *   description = @Translation("Store feature with corresponding progress."),
 *   category = @Translation("Custom"),
 *   default_widget = "ProgressBarDefaultWidget",
 *   default_formatter = "ProgressBarDefaultFormatter"
 * )
 */
class ProgressBar extends FieldItemBase {

  /**
   * Field type properties definition.
   *
   * Inside this method we defines all the fields (properties) that our
   * custom field type will have.
   *
   * Here there is a list of allowed property types: https://goo.gl/sIBBgO
   */
  public static function propertyDefinitions(StorageDefinition $storage) {

    $properties = [];

    $properties['name'] = DataDefinition::create('string')
      ->setLabel(t('Feature Name'));

    $properties['progress'] = DataDefinition::create('string')
      ->setLabel(t('Progress Value'));

    return $properties;
  }

  /**
   * Field type schema definition.
   *
   * Inside this method we defines the database schema used to store data for
   * our field type.
   *
   * Here there is a list of allowed column types: https://goo.gl/YY3G7s
   */
  public static function schema(StorageDefinition $storage) {

    $columns = [];
    $columns['name'] = [
      'type' => 'char',
      'length' => 255,
    ];
    $columns['progress'] = [
      'type' => 'char',
      'length' => 255,
    ];

    return [
      'columns' => $columns,
      'indexes' => [],
    ];
  }

  /**
   * Define when the field type is empty.
   *
   * This method is important and used internally by Drupal. Take a moment
   * to define when the field type must be considered empty.
   */
  public function isEmpty() {

    $isEmpty =
      empty($this->get('name')->getValue()) &&
      empty($this->get('progress')->getValue());

    return $isEmpty;
  }

} // class