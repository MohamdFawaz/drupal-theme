<?php
/**
 * @file
 * Contains \Drupal\hello_world\Controller\HelloController.
 */
namespace Drupal\first\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dropzonejs_test\Form\DropzoneJsTestForm;

class FirstController extends ControllerBase {

    protected  $connection;
    protected  $formBuilder;

    public function __construct()
    {
        $this->connection = \Drupal::database();
        $this->formBuilder= \Drupal::formBuilder();
    }

    public function content() {
        $myform = $this->formBuilder->getForm('Drupal\first\Form\HelloForm');
//        $myform['field']['#value'] = 'From my controller';
      
        $query = \Drupal::database()->select('cities');
        $query->fields('cities', ['name', 'pid', 'surname','age']);
        $data = $query->execute()->fetchAll();
        return [
            '#theme' => 'my_template',
            '#data' => $data,
            '#form' => $myform,
        ];
    }

    public function delete($id)
    {
        $num_deleted = $this->connection->delete('cities')
            ->condition('pid', $id)
            ->execute();
        $messenger = \Drupal::messenger();
        $messenger->addMessage('deleted');
        return $this->redirect('first.content');
    }

    public function edit($id)
    {
        $myform = $this->formBuilder->getForm('Drupal\first\Form\HelloForm');
//        $query = $this->connection->query("SELECT * FROM cities WHERE pid = $id");
        $query = $this->connection->select('cities','c')->fields('c',['name','age','surname','pid'])->condition('pid',$id)->execute();
        $result = $query->fetch();
        $myform['name']['#value'] = $result->name;
        $myform['age']['#value'] = $result->age;
        $myform['surname']['#value'] = $result->surname;
        $myform['pid']['#value'] = $result->pid;

        return [
            '#theme' => 'edit_form',
            '#form' => $myform,
        ];
    }

    public function test()
    {
      $myform = $this->formBuilder->getForm('Drupal\first\Form\DropdownForm');
//      $myform = new DropzoneJsTestForm();
      $query = $this->connection->select('cities');
      $query->fields('cities', ['name', 'pid', 'surname','age','role']);
      $users = $query->execute()->fetchAll();
      $test = '';
        return [
        '#theme' => 'show',
        '#form' => $myform,
        '#data' => $users,
        '#test' => $test
      ];
    }
}