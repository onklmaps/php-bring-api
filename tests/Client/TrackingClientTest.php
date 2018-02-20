<?php
namespace Markantnorge\Bring\API\Client;

use Markantnorge\Bring\API\Contract\Tracking\TrackingRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class TrackingClientTest extends \PHPUnit_Framework_TestCase {


    /** @var  \Markantnorge\Bring\API\Client\TrackingClient */
    protected $entity;

    public function setUp () {
        $credentials = new \Markantnorge\Bring\API\Client\Credentials("http://mydomain.no", getenv('BRING_UID'), getenv('BRING_API_KEY'));
        $client = new TrackingClient($credentials);


        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], json_encode(['ok' => 'unittest'])),
        ]);
        $handler = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handler]);

        $client->setClient($guzzleClient);


        $this->entity = $client;
    }



    public function testTrack () {


        $request = new TrackingRequest();
        $request->setQuery('TESTPACKAGELOADEDFORDELIVERY');
        $request->setLanguage(\Markantnorge\Bring\API\Data\BringData::LANG_NORWEGIAN);

        $trackingInfo = $this->entity->getTracking($request);

        $this->assertEquals('unittest',$trackingInfo['ok']);

    }




}