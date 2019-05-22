<?php

namespace Drupal\dropzonejs_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DropzoneJsTestForm.
 */
class DropzoneJsTestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return '_dropzonejs_test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['dropzonejs'] = [
      '#title' => $this->t('DropzoneJs element'),
      '#type' => 'dropzonejs',
      '#required' => TRUE,
      '#dropzone_description' => 'DropzoneJs description',
      '#max_filesize' => '1M',
      '#extensions' => 'jpg png',
    ];
    /*
    $form['image'] = [
      '#title' => $this->t('Documents'),
      '#type' => 'dropzonejs',
      '#required' => TRUE,
      '#dropzone_description' => 'Drag and drop file',
      '#max_filesize' => '1M',
      '#extensions' => 'jpg png pdf',
      '#max_files' => 1,
      '#attributes' => array('class' => array('form-control')),

    ];
    */
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
     *
     * @returns Array of images
     */
    $image = $form_state->getValue('image')['uploaded_files'];

  }

}
