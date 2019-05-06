<?php

namespace Drupal\hello\Plugin\Block;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a sessionblock block.
 *
 * @Block(
 * id = "session_block",
 * admin_label = @Translation("session!")
 *)
 */
class sessionblock extends BlockBase{
  /**
  *Implements Drupal\Core\Block\BlockBase::build().
  */
  public function build(){
    $database = \Drupal::database();
    $build = [
      '#markup' => $this->t('There is currently %session actives.', [
        '%session' => $database -> select('sessions')->countQuery()->execute()->fetchField(),
      ]),
      '#cache' => [
        'keys' => ['hello:sessionblock_block'],
        'max-age' => '0',
      ],
    ];

    return $build;
  }
  protected function blockAccess(AccountInterface $account){
    return AccessResult::allowedIfHasPermission($account,  'my permission');
  }
}

