<?php
/**
 * Topic class.
 * 
 * @author Will Entriken <WillEntriken @gmail.com>
 * @access public
 * @copyright Copyright (c) 2001-2009 Will Entriken
 * @extends Search
 */
class Topic extends Search
{
  public $name;

  public function topic($name)
  {
    global $cameralife;

    $this->name = $name;

    Search::Search('');
    $this->mySearchAlbumCondition = "topic = '".mysql_real_escape_string($this->name)."'";
    $this->mySearchPhotoCondition = "FALSE";
    $this->mySearchFolderCondition = "FALSE";
  }

//TODO DEPRECATED?
  public function getName()
  {
    return htmlentities($this->name);
  }

  public function get($item)
  {
    return $this->$item;
  }

  public static function getTopics()
  {
    global $cameralife;
    $retval = array();
    $result = $cameralife->Database->Select('albums','DISTINCT topic');
    while ($topic = $result->FetchAssoc())
      $retval[] = new Topic($topic['topic']);
    return $retval;
  }

  public function getOpenGraph()
  {
    global $cameralife;
    $retval = array();
    $retval['og:title'] = $this->name;
    $retval['og:type'] = 'website';
    $retval['og:url'] = $cameralife->base_url.'/topics/'.rawurlencode($this->name);
    if ($cameralife->GetPref('rewrite') == 'no')
      $retval['og:url'] = $cameralife->base_url.'/topic.php?name='.rawurlencode($this->name);
    $retval['og:image'] = $cameralife->iconURL('topic');
    $retval['og:image:type'] = 'image/png';
    //$retval['og:image:width'] = 
    //$retval['og:image:height'] = 
    return $retval;    
  }
}
