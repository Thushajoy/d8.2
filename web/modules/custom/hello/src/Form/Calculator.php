<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
*Implements a hello form
*/
class HelloForm extends FormBase{
/**
*
*/
public function getFormID(){
  return 'hello-form';
}

public function buildForm(array $form, FormStateInterface $form_state){
  return $form;
}
public function submitForm(array &$form, FormStateInterface $form_stste){

}
}
