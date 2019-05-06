<?php
namespace Drupal\hello\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 *Implements a hello form
 */
class HelloForm extends FormBase{
  /**
   *{@inheritdoc}.
   */
  public function getFormID(){
    return 'hello-form';
  }
  /**
   *{@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state){
    if(isset($form_state->getRebuildInfo()['result'])){
      $form['form_state']=array(
        '#type' => 'html_tag',
        '#tag' =>'h2',
        '#value' => 'Result '.$form_state->getRebuildInfo()['result']
      );
    }
    $form['first_value'] = array(
      '#type' => 'textfield',
      '#title'=> 'FirstValue',
    );
    $form['operations'] = array(
      '#type' => 'radios',
      '#title'=> 'Operations',
      '#options'=>array(
        'Add' => 'Add',
        'Subtraction'=> 'Subtraction',
        'Multiplication'=>'Multiplication',
        'Division'=>'Division',
        ),
      '#default_value'=>'10',
      '#attributes'=>['class'=>['Operations']]
    );
    $form['second_value'] = array(
      '#type' => 'textfield',
      '#title'=> 'SecondValue',
    );
    $form['button'] = array(
      '#type' => 'submit',
      '#value'=> $this->t('Calculate'),
    );
    return $form;
  }

  /**
   *{@inheritdoc}.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $First_Value = $form_state->getValue('first_value');
    if (!is_numeric($First_Value)){
      $form_state->setErrorByName('first_value', $this->t('First value Should Be Numeric!'));
    }

    $Second_Value = $form_state->getValue('second_value');
    if (!is_numeric($Second_Value)) {
      $form_state->setErrorByName('second_value', $this->t('Value 2 should Be Numeric!'));
    }

    $operation = $form_state->getValue('operations');
    if ($Second_Value == '0' && $operation == 'Division') {
      $form_state->setErrorByName('Second_Value', $this->t('Should Be not zero.'));
    }

    if (isset($form['result'])) {
      unset($form['result']);
    }
  }

  /**
   *{@inheritdoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $First_Value=$form_state->getValue('first_value');
    $Second_Value=$form_state->getValue('second_value');
    $Operations=$form_state->getValue('operations');

    if ($Operations == 'Add'){
      $result = $First_Value + $Second_Value;
    }elseif ($Operations == 'Subtraction'){
      $result = $First_Value - $Second_Value;
      }elseif ($Operations == 'Multiplication') {
      $result = $First_Value * $Second_Value;
    }else ($Operations == 'Division'){
      $result = $First_Value / $Second_Value
    };
    $form_state->addRebuildInfo('result',$result);
    $form_state->setRebuild();
    #Save a given State with State API
    \Drupal::state()->set('hello_form_submission_time',\Drupal::service('datetime.time')->getCurrentTime());
  }

}
