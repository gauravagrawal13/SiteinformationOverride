<?php

namespace Drupal\ax_siteinfo_override\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defines the ApiAccess controller.
 */
class ApiAccessController extends ControllerBase {

 /**
  * Function to return node json response
  *
  * @param nid
  * Variable that holds the Node Id from the URL
  */
 public function api_access($nid) {
   $is_valid_node = $this->page_node_exists($nid);
   // Don’t allow access if node is invalid or siteapikey is not set.
   $siteapikey = \Drupal::config('system.site')->get('siteapikey');
   if (!$is_valid_node || empty($siteapikey)) {
     // Return 403 Access Denied page.
     throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }else{
      $node_json = $this->serialize_node($nid);
      $response = new Response();
      $response->setContent($node_json);
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
  }

  /**
  * Function to check if node exists
  *
  * @param nid
  * Variable that holds the Node Id from the URL
  */
  public function page_node_exists($nid){
    $node = \Drupal\node\Entity\Node::load($nid);
    if(empty($node)){
      return false;
    }
    $type = $node->getType();
    if(empty($type) || $type!='page'){
      return false;
    }
    return true;
  }

  /**
  * Function to serialize node in JSON format
  *
  * @param nid
  * Variable that holds the Node Id from the URL
  */
  public function serialize_node($nid)
  {
      $serializer = \Drupal::service('serializer');
      $node = \Drupal\node\Entity\Node::load($nid);
      $node_json = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
      return $node_json;
  }
}
