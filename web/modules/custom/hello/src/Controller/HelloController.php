<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase{

#  public function content() {
#    return ['#markup'=> $this->t('You are in Page Hello. Your Name is '.$this->currentUser()->getDisplayName().'!')];
  #}
  public function content($param = ''){
    $message=$this->t('You are in Page Hello. Your Name is @username! @param',[
      '@username' => $this->currentUser()->getDisplayName(),
      '@param'=>$param,
    ]);
    return ['#markup' => $message];
}
}
