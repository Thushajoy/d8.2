<?php

namespace Drupal\perf\Service;
use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Session\AccountProxy;

/**
 * Class PerfService.
 */
class PerfLazyBuilderService {
  protected $current_user;

  /**
   * Constructs a new PerfService object.
   */
  public function __construct(AccountProxy $current_user) {
    $this->current_user=$current_user;
  }
  public function render(){
    return ['#markup' => 'Perf Block Created For D8.2'];

  }
}
