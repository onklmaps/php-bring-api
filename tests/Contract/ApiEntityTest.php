<?php
namespace Peec\Bring\API\Contract;


class ApiEntityTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Peec\Bring\API\Contract\ApiEntity */
    protected $entity;

    public function setUp () {
        $stub = $this->getMockForAbstractClass('\Peec\Bring\API\Contract\ApiEntity');
        $this->entity = $stub;
    }

    public function testToArray () {
        $this->assertEquals([], $this->entity->toArray());
    }

    public function testToXml () {
        $result = str_replace(["\r", "\n"], '', $this->entity->toXml('test'));
        $this->assertEquals('<?xml version="1.0"?><test/>', $result);


        $result = str_replace(["\r", "\n"], '', $this->entity->toXml());
        $this->assertEquals('<?xml version="1.0"?><root/>', $result);

    }



}
