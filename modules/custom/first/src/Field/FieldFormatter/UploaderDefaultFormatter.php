<?php
/**
 * @file
 * Contains \Drupal\first\Plugin\field\formatter\UploaderDefaultFormatter.
 */

namespace Drupal\first\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
* Plugin implementation of the 'uploader_default' formatter.
 *
 * @FieldFormatter(
 *   id = "uploder_default",
 *   label = @Translation("Uploder default"),
 *   field_types = {
  *     "uploder"
  *   }
 * )
 */
class UploaderDefaultFormatter extends FormatterBase {

    public function viewElements(FieldItemListInterface $items, $langcode) {
      $elements = array();
      foreach ($items as $delta => $item) {
        // Render output using snippets_default theme.
        $source = array(
          '#theme' => 'uploder_default',
          '#uploader' => $item->uploader
        );

        $elements[$delta] = array('#markup' => render($source));
      }

      return $elements;
    }
}
