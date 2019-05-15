<?php
namespace Drupal\first\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloForm extends FormBase {

    /**
     * Returns a unique string identifying the form.
     *
     * The returned ID should be a unique string that can be a valid PHP function
     * name, since it's used in hook implementation names such as
     * hook_form_FORM_ID_alter().
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId() {
        return 'ex81_hello_form';
    }

    /**
     * Form constructor.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {


//        $form['#theme'] = 'my_template';

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('name'),
            '#description' => $this->t('Enter the name'),
        ];

        $form['surname'] = [
            '#type' => 'textfield',
            '#title' => $this->t('surname'),
            '#description' => $this->t('Enter the surname'),
            '#required' => TRUE,
        ];

        $form['age'] = [
            '#type' => 'number',
            '#title' => $this->t('age'),
            '#description' => $this->t('Enter the age'),
            '#required' => TRUE,
        ];

        $form['pid'] = [
            '#type' => 'hidden',
        ];


        // Group submit handlers in an actions element with a key of "actions" so
        // that it gets styled correctly, and so that other modules may add actions
        // to the form. This is not required, but is convention.

        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);

        $name = $form_state->getValue('name');
        $surname = $form_state->getValue('surname');
        $age = $form_state->getValue('age');

        if (count_chars($name) < 2) {
            // Set an error for the form element with a key of "title".
            $form_state->setErrorByName('title', $this->t('The title required.'));
        }

        if (empty($surname)) {
            // Set an error for the form element with a key of "accept".
            $form_state->setErrorByName('surname', $this->t('The surname required.'));
        }

        if (strlen($age)>2){
            // Set an error for the form element with a key of "accept".
            $form_state->setErrorByName('age', $this->t('invalid age.'));
        }

    }
    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */


    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $connection = \Drupal::database();
        $messenger = \Drupal::messenger();

        if($form_state->getValue('pid')){
             $connection->update('cities')
                ->fields([
                    'name' => $form_state->getValue('name'),
                    'surname' => $form_state->getValue('surname'),
                    'age' => $form_state->getValue('age'),
                ])
                ->condition('pid', $form_state->getValue('pid'))
                ->execute();
            $messenger->addMessage('updated');

        }else{
         $connection->insert('cities')
            ->fields([
                'name' => $form_state->getValue('name'),
                'surname' => $form_state->getValue('surname'),
                'uid' => 1,
                'age' => $form_state->getValue('age'),
            ])
            ->execute();
            $messenger->addMessage('added');
        }
        $form_state->setRedirect('first.content');
        return;
    }
}