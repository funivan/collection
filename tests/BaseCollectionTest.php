<?php

  namespace Fiv\Collection\Test;

  class BaseCollectionTest extends \PHPUnit_Framework_TestCase {

    public function testInitialize() {
      $baseCollection = new \Fiv\Collection\BaseCollection();
      $this->assertEmpty($baseCollection);

      $baseCollection = new \Fiv\Collection\BaseCollection(array(1, 2, 3));
      $this->assertCount(3, $baseCollection);
    }

    public function testClone() {
      $object = new \stdClass();
      $object->title = 'title';

      $baseCollection = new \Fiv\Collection\BaseCollection(array($object));
      $this->assertCount(1, $baseCollection);

      $newCollection = clone $baseCollection;
      $firstObject = $newCollection->getFirst();
      $this->assertNotEmpty($firstObject);
      $this->assertEquals('title', $firstObject->title);

      $object->title = 'other title';
      $this->assertEquals('other title', $firstObject->title);
    }

    public function testPrepend() {

      $baseCollection = new \Fiv\Collection\BaseCollection(array('item'));
      $this->assertCount(1, $baseCollection);
      $this->assertEquals('item', $baseCollection->getFirst());

      $baseCollection->prepend(2);

      $this->assertCount(2, $baseCollection);
      $this->assertEquals(2, $baseCollection->getFirst());

    }

    public function testAppend() {

      $baseCollection = new \Fiv\Collection\BaseCollection(array('item'));
      $this->assertCount(1, $baseCollection);
      $this->assertEquals('item', $baseCollection->getLast());

      $baseCollection->append('other string');

      $this->assertEquals('other string', $baseCollection->getLast());

    }

    public function testAddAfter() {
      $items = array(1, 2, 3, 4);
      $collection = new \Fiv\Collection\BaseCollection($items);
      $this->assertCount(4, $collection);
      $addItems = array(5, 6);
      $collection->addAfter(2, $addItems);

      $this->assertEquals(
        array(1, 2, 3, 5, 6, 4),
        $collection->getItems()
      );

      $exception = null;
      try {
        $collection->addAfter(null, array('123'));
      } catch (\Exception $e) {
        $exception = $e;
      }

      $this->assertInstanceOf('InvalidArgumentException', $exception);

      $exception = null;
      try {
        $collection->addAfter(1, 'invalid item');
      } catch (\Exception $e) {
        $exception = $e;
      }

      $this->assertInstanceOf('InvalidArgumentException', $exception);

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetItems() {
      $collection = new \Fiv\Collection\BaseCollection();
      $collection->setItems('invalid items type');
    }

    public function testSlice() {
      $collection = new \Fiv\Collection\BaseCollection();
      $items = array(1, 2, 3, 4);
      $collection->setItems($items);

      $this->assertCount(4, $collection);

      $collection->slice(2);
      $this->assertCount(2, $collection);

      $collection->setItems($items);
      $collection->slice(2, 1);
      $this->assertCount(1, $collection);

      $collection->setItems($items);
      $collection->slice(1, -1);
      $this->assertCount(2, $collection);
      $this->assertEquals(
        array(2, 3),
        $collection->getItems()
      );

    }

    public function testExtractItems() {

      $collection = new \Fiv\Collection\BaseCollection();
      $collection->setItems(array(1, 2, 3, 4));

      $newCollection = $collection->extractItems(1);
      $this->assertCount(3, $newCollection);
      $this->assertCount(4, $collection);

      $object = new \stdClass();
      $object->title = 123;
      $collection = new \Fiv\Collection\BaseCollection();
      $collection->setItems(array($object));

      $newCollection = $collection->extractItems(0);
      $this->assertCount(1, $newCollection);
      $this->assertCount(1, $collection);

      $this->assertEquals($collection->getFirst()->title, $newCollection->getFirst()->title);
    }

    public function testGetNext() {
      $collection = new \Fiv\Collection\BaseCollection();
      $collection->setItems(array(0, 1, 2, 3));
      // current position is 0
      $this->assertEquals(1, $collection->getNext());

      $collection->next();
      $collection->next();
      // current position is 2

      $this->assertEquals(3, $collection->getNext());

    }

    public function testGetPrevious() {
      $collection = new \Fiv\Collection\BaseCollection();
      $collection->setItems(array(0, 1, 2, 3));
      // current position is 0
      $this->assertEquals(null, $collection->getPrevious());

      $collection->next();
      // current position is 1
      $this->assertEquals(0, $collection->getPrevious());
      
      $collection->next();
      $collection->next();
      // current position is 3

      $this->assertEquals(1, $collection->getPrevious(2));
      

    }

  }
