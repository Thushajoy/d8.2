<?php

namespace Drupal\hello\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class HelloEventSubscriber extends RouteSubscriberBase{

  protected function alterRoutes(RouteCollection $collection)
  {
    // TODO: Implement alterRoutes() method.
       $route = $collection->get('entity.user.canonical');
       $route->setRequirements(['_access_hello' => '10']);
       }
}
