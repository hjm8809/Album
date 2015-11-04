<?php

namespace Demo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Demo\Model\Demo;
//use Demo\Form\AlbumForm;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $view = new ViewModel();
//        $view->albums = $this->getAlbumTable()->fetchAll();
//        var_dump($this->getAlbumTable()->test());
        return $view;
    }
    public function testAction()
    {
        $view = new ViewModel();
//        $view->albums = $this->getAlbumTable()->fetchAll();
//        var_dump($this->getAlbumTable()->test());
        return $view;
    }
}
