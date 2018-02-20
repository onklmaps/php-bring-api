<?php
namespace Markantnorge\Bring\API\Client;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use \Markantnorge\Bring\API\Contract\ShippingGuide;
use Markantnorge\Bring\API\Data\BringData;
use Markantnorge\Bring\API\Data\ShippingGuideData;


/**
 * Class ShippingGuideClient
 *
 * @todo We can implement My bring credentials for shipping guide requests once Bring has fixed the API to work with RESTFUL and not SOAP. See http://developer.bring.com/api/shipping-guide/
 *
 * @package Markantnorge\Bring\API\Client
 */
class ShippingGuideClientTest extends \PHPUnit_Framework_TestCase {


    /** @var  \Markantnorge\Bring\API\Client\ShippingGuideClient */
    protected $entity;

    public function setUp () {
        $credentials = new \Markantnorge\Bring\API\Client\Credentials("http://mydomain.no", getenv('BRING_UID'), getenv('BRING_API_KEY'));
        $client = new ShippingGuideClient($credentials);


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

        $client = $this->entity;

        $request = new ShippingGuide\PriceRequest();

        $request->setFromCountry('NO');
        $request->setFrom('5097');
        $request->setToCountry('NO');
        $request->setTo('5155');
        $request->setWeightInGrams(1500);
        $request->addAdditional(ShippingGuideData::EVARSLING); // Makes it cheaper, and environment friendly! :)


        $request->addProduct(BringData::PRODUCT_SERVICEPAKKE)
            ->addProduct(BringData::PRODUCT_MINIPAKKE)
            ->addProduct(BringData::PRODUCT_PA_DOREN);

        $request->setEdi(true);


        $prices = $client->getPrices($request);

        $this->assertEquals('unittest', $prices['ok']);


    }


}