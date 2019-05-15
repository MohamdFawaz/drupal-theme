<?php
/**
* @file
* Contains \Drupal\snippets\Plugin\Field\FieldType\SnippetsItem.
*/

namespace Drupal\first\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;


/**
 * Plugin implementation of the 'uploader' field type.
 *
 * @FieldType(
 *   id = "uploader",
 *   label = @Translation("Uploader field"),
 *   description = @Translation("This field stores images to database"),
 *   default_widget = "uploader_default",
 *   default_formatter = "uploader_default"
 * )
 */
class Uploader extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  static $propertyDefinitions;

  public static function schema(FieldStorageDefinitionInterface $field) {
    return array(
      'columns' => array(
        'uploader' => array(
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('uploader')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['uploader'] = DataDefinition::create('string')
      ->setLabel(t('dropzone js uploader field'));

    return $properties;
  }

}