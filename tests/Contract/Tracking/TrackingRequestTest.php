<?php
namespace Peec\Bring\API\Contract\Tracking;

use Peec\Bring\API\Contract\ApiEntity;
use Peec\Bring\API\Contract\ContractValidationException;

class TrackingRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Peec\Bring\API\Contract\Tracking\TrackingRequest */
    protected $entity;

    public function setUp () {
        $stub = new TrackingRequest();
        $this->entity = $stub;
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetLanguageNotSupported () {
        $this->entity->setLanguage('ch');
    }

    /**
     * @expectedException \Peec\Bring\API\Contract\ContractValidationException
     * @expectedExceptionMessage TrackingRequest requires "q" attribute to be set.
     */
    public function testValidationOfQ () {
        $this->entity->setLanguage('no');
        $result = $this->entity->toArray();
    }


    public function testQuery () {
        $this->entity->setLanguage('no');
        $this->entity->setQuery('HELLOWORLD');
        $result = $this->entity->toArray();

        $this->assertEquals('no', $result['lang']);
        $this->assertEquals('HELLOWORLD', $result['q']);
    }

}