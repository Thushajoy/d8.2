<?php
/**
 * Created by PhpStorm.
 * User: POE3
 * Date: 02/05/2019
 * Time: 14:55
 */
namespace  Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\User\UserInterface;

class StatisticsController extends ControllerBase{

  public function content(UserInterface $user){
    $results = \Drupal::database()
      ->select('hello_user_statistics','hus')
      ->fields('hus',['action','time'])
      ->condition('uid', $user->id())
      ->execute();

    $rows=[];
    foreach ($results as $record){
      $rows[]=[
        $record->action =='1' ? $this->t('Login'): $this->t('Logout'),
        \Drupal::service('date.formatter')->format($record->time),
      ];
      #$rows[] =[$record -> action, $record -> time];
    }

    return [
      '#type' => 'table',
      '#header'=> [$this->t('Action'),$this->t('Time')],
      '#rows'=> $rows,
    ];
}
}
