<?php
/**
 * Created by PhpStorm.
 * User: Markantnorge
 * Date: 5/24/16
 * Time: 6:50 PM
 */

namespace Markantnorge\Bring\API\Client;


/**
 * Class Credentials
 * @package Markantnorge\Bring\API
 */
class Credentials {

    private $clientId;

    private $apiKey;

    private $clientUrl;

    /**
     * Creates bring credentials object.
     *
     * @param string $clientUrl Identifier ( your domain ).
     * @param string $clientId Bring Client ID ( e.g. myuser@mydomain.no )
     * @param string $apiKey ( e.g. xxxxxxxxxx-xxxx-xxxxx-xxxxx ) Get it from My Bring settings.
     */
    public function __construct ($clientUrl, $clientId = null, $apiKey = null) {
        if (!$clientUrl) {
            throw new \InvalidArgumentException('$clientUrl must not be empty.');
        }
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
        $this->clientUrl = $clientUrl;
    }


    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getClientUrl()
    {
        return $this->clientUrl;
    }


    public function hasAuthorizationData () {
        return $this->clientId !== null && $this->apiKey !== null;
    }


}