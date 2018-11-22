<?php
namespace Markantnorge\Bring\API\Client;

use GuzzleHttp\Exception\RequestException;
use Markantnorge\Bring\API\Contract\ShippingGuide\PriceRequest;


/**
 * Class ShippingGuideClient
 *
 * @todo We can implement My bring credentials for shipping guide requests once Bring has fixed the API to work with RESTFUL and not SOAP. See http://developer.bring.com/api/shipping-guide/
 *
 * @package Markantnorge\Bring\API\Client
 */
class ShippingGuideClient extends Client
{
    const BRING_PRICES_API = 'https://api.bring.com/shippingguide/v2/products';

    protected $_apiBringPrices = self::BRING_PRICES_API;



    public function getPrices (PriceRequest $request) {
        $query = $request->toArray();

        $url = $this->_apiBringPrices;

        $options = [
            'query' => $this->getQueryParams($query)
        ];

        try {
            $request = $this->request('get', $url, $options);
            $json = json_decode($request->getBody(), true);
            return $json;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new ShippingGuideClientException("Could not retrieve prices.", null, $e);
        }
    }


    public function setBringPricesApi($api) {
        $this->_apiBringPrices = $api;
        return $this;
    }


}
