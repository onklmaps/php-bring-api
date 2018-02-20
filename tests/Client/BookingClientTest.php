<?php
namespace Markantnorge\Bring\API\Client;

use GuzzleHttp\Exception\RequestException;
use Markantnorge\Bring\API\Contract\Booking\BookingRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class BookingClientTest extends \PHPUnit_Framework_TestCase {



    /** @var  \Markantnorge\Bring\API\Client\BookingClient */
    protected $entity;

    public function setUp () {
        $credentials = new \Markantnorge\Bring\API\Client\Credentials("http://mydomain.no", getenv('BRING_UID'), getenv('BRING_API_KEY'));
        $client = new BookingClient($credentials);


        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], json_encode(['customers' => [1,2,3,4,5,6,7,8,9,10]])),
        ]);
        $handler = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handler]);

        $client->setClient($guzzleClient);


        $this->entity = $client;
    }




    public function testGetCustomers () {

        $customers = $this->entity
            ->getCustomers();

        $this->assertCount( 10, $customers );

    }



}