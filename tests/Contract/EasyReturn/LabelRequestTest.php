<?php
namespace Peec\Bring\API\Contract\EasyReturn;
use Peec\Bring\API\Contract\EasyReturn\LabelRequest as Contract;

/**
 * Copyright (C) Markant Norge AS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @author petterk
 * @date 9/20/16 2:15 PM
 */
class LabelRequestTest extends \PHPUnit_Framework_TestCase
{

    /** @var  LabelRequest */
    protected $entity;

    public function setUp () {
        $this->entity = new LabelRequest();


        $recipient = new Contract\Recipient();
        $recipient->setName('y');
        $recipient->setStreet('x');
        $recipient->setCountryCode('z');
        $recipient->setCity('b');

        $sender = new Contract\Sender();
        $sender->setName('y');
        $sender->setStreet('x');
        $sender->setCountryCode('z');
        $sender->setCity('b');


        $shipment = new Contract\Shipment();
        $shipment->setPackageId('123');
        $shipment->setProductCode('1234');
        $shipment->setShipmentId('321');
        $shipment->setWeight(5);

        $this->entity->setRecipient($recipient);
        $this->entity->setSender($sender);
        $this->entity->setShipment($shipment);
    }


    public function testValidationPasses () {
        $e = $this->entity;
        $e->setCustomerId('x');
        $e->setRecipient(new Contract\Recipient());
        $e->setSender(new Contract\Sender());
        $e->setShipment(new Contract\Shipment());
        $e->setOrderDate(new \DateTime());
        $e->validate();
    }


    /**
     * @expectedException \Peec\Bring\API\Contract\ContractValidationException
     */
    public function testValidationNotPass () {
        $e = $this->entity;
        //$e->setCustomerId('x');
        $e->setRecipient(new Contract\Recipient());
        $e->setSender(new Contract\Sender());
        $e->setShipment(new Contract\Shipment());
        $e->setOrderDate(new \DateTime());
        $e->validate();


    }

    public function testDataIntegrity () {

        $date = new \DateTime('2014-05-05 11:00:00');
        $customerId = 'x';

        $e = $this->entity;
        $e->setCustomerId($customerId);
        $e->setOrderDate($date);
        $result = $e->toArray();

        $this->assertEquals('2014-05-05T11:00:00', $result['OrderDate']);
        $this->assertEquals('x', $result['CustomerId']);
    }

}