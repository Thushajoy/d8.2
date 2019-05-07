<?php
namespace Drupal\hello\Access;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessCheckInterface;
use Symfony\Component\Routing\Route;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\Request;

class HelloAccessCheck implements AccessCheckInterface{
  public function applies(Route $route){
    return null;
  }

public function access (Route $route, Request $request = Null, AccountInterface $account){
 $param = $route->getRequirement('_access_hello');

  if (!$account->isAnonymous()&&
    (\Drupal::time()->getCurrentTime() - $account->getAccount()->created > $param * 3600)){

 return AccessResult::allowed()->cachePerUser();
}
return AccessResult::forbidden()->cachePerUser();
}
}
