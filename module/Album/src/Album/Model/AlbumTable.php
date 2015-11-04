<?php

namespace Album\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class AlbumTable extends AbstractTableGateway
{
    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Album());

        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getAlbum($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = array(
            'artist' => $album->artist,
            'title'  => $album->title,
        );

        $id = (int)$album->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteAlbum($id)
    {
        $this->delete(array('id' => $id));
    }
    public function test()
    {
        /* 继承Zend\Db\TableGateway\AbstractTableGateway 类 增删改查 Demo */
//        增:INSERT INTO table `album` VALUES ('id','author','article');
//        $this->insert(array('id'=>'', 'artist'=>'hjm', 'title'=>'fist_book'));
//        删:DELETE FROM `album` WHERE  id = '111';
//        $this->delete(array('id'=>'10'));
//        改：UPDATE `album` SET artist='new_hjm', title='second_book';
//        $this->update(array('artist'=>'new_hjm', 'title'=>'second_book'),array('id'=>'11'));
//        查:SELECT artist,title from `album` WHERE id='11';返回的是 Zend\Db\ResultSet\ResultSet 对象
//        return $this->select(array('id'=>'11'));
    }

}
