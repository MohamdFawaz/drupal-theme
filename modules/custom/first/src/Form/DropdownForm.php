<?php

/**
 * @file
 * Contains \Drupal\first\Form\DropdownForm.
 */

namespace Drupal\first\Form;

use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\dropzonejs\DropzoneJsUploadSave;
use Drupal\dropzonejs_eb_widget\Plugin\EntityBrowser\Widget\DropzoneJsEbWidget;
use Drupal\dropzonejs_test\Form\DropzoneJsTestForm;
use Drupal\Tests\dropzonejs\Kernel\DropzoneJsUploadControllerTest;
use Drupal\Core\File;


class DropdownForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'first_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#attributes'] = array('class' => 'dropzone');

    //    $form['first_field'] = [
//      '#type' => 'select',
//      '#title' => t('First field'),
//      '#options' => $options,
//      '#ajax' => [
//        'callback' => [$this, 'changeOptionsAjax'],
//        // 'callback' => '\Drupal\helloworld\Form\helloworldForm::changeOptionsAjax',
//        // 'callback' => '::changeOptionsAjax',
//        'wrapper' => 'second_field_wrapper',
//      ],
//    ];
    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>'
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#placeholder' => $this->t('please enter your first name'),
      '#attributes' => array('class' => array('form-control','name-field')),
      '#ajax' => [
        'callback' => array($this, 'validateNameAjax'),
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Verifying Name...'),
        ),
      ],
      '#suffix' => '<span class="name-valid-message"></span>'

    ];

    $form['surname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#placeholder' => $this->t('please enter your last name'),
      '#attributes' => array('class' => array('form-control','surname-field')),

    ];

    $form['age'] = [
      '#type' => 'select',
      '#title' => $this->t('Age'),
      '#options' => $this->ageOptions(),
      '#ajax' => [
        'callback' => [$this,'changeOptionsAjax'],
        'wrapper' => 'role_field_wrapper'
      ],
      '#attributes' => array('class' => array('form-control')),

    ];

    $form['role'] = [
      '#type' => 'select',
      '#title' => t('Role'),
      '#options' => $this->getOptions($form_state),
      '#prefix' => '<div id="role_field_wrapper">',
      '#suffix' => '</div>',
      '#attributes' => array('class' => array('form-control')),

    ];
//    $form['image'] = [
//      '#type' =>  'dropzonejs',
//      '#title' => $this->t('Image'),
//      '#attributes' => array('class' => array('form-control','dropzone')),
//
//
//    ];
    $form['dropzonejs'] = [
      '#title' => $this->t('Documents'),
      '#type' => 'dropzonejs',
      '#required' => TRUE,
      '#dropzone_description' => 'Drag and drop file',
      '#max_filesize' => '1M',
      '#extensions' => 'jpg png pdf',
      '#max_files' => 1,

    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
//    $form['actions'] = [
//      '#type' => 'button',
//      '#value' => $this->t('Submit'),
//      '#ajax' => [
//        'callback' => '::setMessage',
//      ],
//      '#attributes' => array('class' => array('btn btn-success')),
//    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state){

    if (!$this->validateName($form, $form_state)) {
      $form_state->setErrorByName('name', $this->t('This is not a .com email address.'));
    }
  }

  /**
   * Validates that the email field is correct.
   */
  protected function validateName(array &$form, FormStateInterface $form_state) {

    if ($this->checkSpecialChars($form_state->getValue('name'))) {
      return FALSE;
    }
    return TRUE;
  }

  function checkSpecialChars($string)
  {
    return preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string);
  }


  /**
   * Ajax callback to validate the email field.
   */
  public function validateNameAjax(array &$form, FormStateInterface $form_state,$field) {
    $valid = $this->validateName($form, $form_state);
    $response = new AjaxResponse();
    if ($valid) {
      $css = ['border' => '1px solid green'];
      $message = $this->t('Name ok.');
    }
    else {
      $css = ['border' => '1px solid red'];
      $message = $this->t('Name is not valid, Remove any special characters.');
    }
    $response->addCommand(new CssCommand('#edit-name', $css));
    $response->addCommand(new HtmlCommand('.name-valid-message', $message));
    return $response;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $image = $form_state->getValue('dropzonejs')['uploaded_files'];
    $absolute_path = \Drupal::service('file_system');

    $values = [
      'name' => $form_state->getValue('name'),
      'surname' => $form_state->getValue('surname'),
      'age' => $form_state->getValue('age'),
      'role' => $form_state->getValue('role'),
      'image' => $image[0]['path'],
    ];
    /* Fetch the array of the file stored temporarily in database */


    $connection = \Drupal::database();
    $query = $connection->insert('cities')->fields($values)->execute();
    if ($query){
      return $query;
    }
    return false;
  }

  public function ageOptions($total = 40)
  {
    for ($i = 0; $i <= $total; $i++){
      $ages[$i] = $i;
    }
    return $ages;
  }

  /**
   * Ajax callback to change options for second field.
   */
  public function changeOptionsAjax(array &$form, FormStateInterface $form_state) {
    return $form['role'];
  }

  /**
   * Get options for second field.
   */
  public function getOptions(FormStateInterface $form_state) {
    if ($form_state->getValue('age') > 18) {
      $options = [
        'admin' => 'Admin',
        'manager' => 'Manager'
      ];
    }
    else {
      $options = [
        'guest' => 'Guest',
        'user' => 'User'
      ];
    }
    return $options;
  }

  /**
   *
   */
  public function setMessage(array $form, FormStateInterface $form_state) {


    if ($pid = $this->submitForm($form,$form_state)) {


      $response = new AjaxResponse();
      $response->addCommand(
        new AppendCommand(
          '.users',
          '<tr>
                  <th scope="row">' . $pid . '</th>
                  <td>'.$form_state->getValue('name').'</td>
                  <td>'.$form_state->getValue('surname').'</td>
                  <td>'.$form_state->getValue('age').'</td>
                  <td>'.ucwords($form_state->getValue('role')).'</td>
                  </tr>')
            );
    }else{
      $response = new AjaxResponse();
      $response->addCommand(
        new HtmlCommand(
          '.result_message',
          '<div class="my_top_message">'.var_dump($form_state->getErrors()).'</div>')
      );
      $response->addCommand(new HtmlCommand('.name-field', 'addClass', array('error')));
    }
    return $response;

  }

}
?>