<?php
require '../vendor/autoload.php';

use \Peec\Bring\API\Contract\ShippingGuide;
use \Peec\Bring\API\Data\ShippingGuideData;
use \Peec\Bring\API\Data\BringData;


// See http://developer.bring.com/api/booking/ ( Authentication section ) . You will need Client id, api key and client url.
$client = new \Peec\Bring\API\Client\ShippingGuideClient(new \Peec\Bring\API\Client\Credentials("http://mydomain.no"));

$request = new ShippingGuide\PriceRequest();

$request->setFromCountry('NO');
$request->setFrom('5097');

$request->setToCountry('NO');
$request->setTo('5155');

$request->setWeightInGrams(1500);

$request->addAdditional(ShippingGuideData::EVARSLING); // Makes it cheaper, and environment friendly! :)


// Set possible shipping products
$request->addProduct(BringData::PRODUCT_SERVICEPAKKE)
    ->addProduct(BringData::PRODUCT_MINIPAKKE)
    ->addProduct(BringData::PRODUCT_PA_DOREN);


// If we use EDI..
$request->setEdi(true);



try {

    $prices = $client->getPrices($request);

    print_r($prices);

} catch (\Peec\Bring\API\Client\ShippingGuideClientException $e) {
    throw $e; // just re-throw for testing.

} catch (\Peec\Bring\API\Contract\ContractValidationException $e) {
    throw $e;
}
