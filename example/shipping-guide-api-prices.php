<?php
require '../vendor/autoload.php';

use \Markantnorge\Bring\API\Contract\ShippingGuide;
use \Markantnorge\Bring\API\Data\ShippingGuideData;
use \Markantnorge\Bring\API\Data\BringData;


// See http://developer.bring.com/api/booking/ ( Authentication section ) . You will need Client id, api key and client url.
$client = new \Markantnorge\Bring\API\Client\ShippingGuideClient(new \Markantnorge\Bring\API\Client\Credentials("http://mydomain.no"));

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

} catch (\Markantnorge\Bring\API\Client\ShippingGuideClientException $e) {
    throw $e; // just re-throw for testing.

} catch (\Markantnorge\Bring\API\Contract\ContractValidationException $e) {
    throw $e;
}
