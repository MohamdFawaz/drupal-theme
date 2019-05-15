<?php
namespace Drupal\first\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteSubscriber extends RouteSubscriberBase
{
  protected function alterRoutes(RouteCollection $collection) {
      if ($route = $collection->get('<front>')){
        $route->setDefaults(
          ['_controller' => '\Drupal\first\Controller\FirstController::content']
        );
      }
  }
}