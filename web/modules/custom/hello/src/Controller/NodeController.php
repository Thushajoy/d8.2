<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class NodeController extends ControllerBase{

#  public function content() {
#    return ['#markup'=> $this->t('You are in Page Nodelist. Your Name is '.$this->currentUser()->getDisplayName().'!')];
#  }
#  public function content($param = ''){
#    $message=$this->t('You are in Page Nodelist. Your Name is @username! @param',[
#      '@username' => $this->currentUser()->getDisplayName(),
#      '@param'=>$param,
#    ]);
#    return ['#markup' => $message];
#}
#}


public function content($nodetype = NULL){
  $storage = $this->entityTypeManager()->getStorage('node');
  $query = $storage->getQuery();
  if($nodetype) {
  $query->condition('type', $nodetype);
  }
  $ids = $query->pager(10)->execute();
  $nodes = $storage->loadMultiple($ids);
  $items = [];
  foreach ($nodes as $node){
    $items[]= $node->toLink();
  }
$list = [
    '#theme' => 'item_list',
    '#items' => $items,
    ];
    $pager = ['#type' => 'pager'];
  return[
    'list' => $list,
    'pager' => $pager,
    '#cache' => [
      'keys'=>['hello:nodelist_controller'],
      'tags' => ['node_list'],
      'contexts'  => ['url'],
    ],
  ];
  }
}
