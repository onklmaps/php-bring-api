<?php
require '../vendor/autoload.php';

use \Markantnorge\Bring\API\Contract\Tracking;

// Mybring credentials are not required can be null. See rate limiting in bring developer docs.
$bringUid = getenv('BRING_UID') ?: null;
$bringApiKey = getenv('BRING_API_KEY') ?: null;

$client = new \Markantnorge\Bring\API\Client\TrackingClient(new \Markantnorge\Bring\API\Client\Credentials("http://mydomain.no", $bringUid, $bringApiKey));




$request = new Tracking\TrackingRequest();
$request->setQuery('TESTPACKAGELOADEDFORDELIVERY');
$request->setLanguage(\Markantnorge\Bring\API\Data\BringData::LANG_NORWEGIAN);


try {

    $trackingInfo = $client->getTracking($request);

    foreach ($trackingInfo['consignmentSet'] as $consignmentSet) {
        // There was an error in this consignment set.
        if (isset($consignmentSet['error'])) {

            print_r($error);

        } else {
            print_r($consignmentSet);
        }
    }

} catch (\Markantnorge\Bring\API\Client\TrackingClientException $e) {

    throw $e->getRequestException();

} catch (\Markantnorge\Bring\API\Contract\ContractValidationException $e) {
    throw $e;
}
