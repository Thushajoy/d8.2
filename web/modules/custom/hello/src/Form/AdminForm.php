<?php
namespace Drupal\hello\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 *Implements a hello form
 */
class AdminForm extends ConfigFormBase{
  /**
   *{@inheritdoc}.
   */
  public function getFormID(){
    return 'admin-form';
  }
  /**
   *{@inheritdoc}.
   */

protected function getEditableConfigNames(){
  return ['hello.settings'];
}
  /**
   *{@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state){
    $form['list'] = array(
      '#type' => 'select',
      '#title'=> 'How Long To Keep User Activity Statistics',
      '#options'=>array(
        '0' => '0 day',
        '1'=> '1 day',
        '2'=> '2 days',
        '7'=> '7  days',
        '14'=> '14 days',
        '30'=> '30 days',
      ),
      '#default_value' => $this->config('hello.settings')->get('purge_days_number'),
      '#attributes'=>['class'=>['list']]
    );
    return parent::buildForm($form, $form_state);
  }
  /**
   *{@inheritdoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $purge_days_number = $form_state->getValue('list');
    $this->config('hello.settings')->set('purge_days_number', $purge_days_number)->save();
    parent::submitForm($form, $form_state);
  }
}
