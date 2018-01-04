<?php
/**
 * Created by PhpStorm.
 * User: peec
 * Date: 5/24/16
 * Time: 6:50 PM
 */

namespace Peec\Bring\API\Client;


/**
 * Class Credentials
 * @package Peec\Bring\API
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase {

    /** @var  \Peec\Bring\API\Client\Credentials */
    protected $entity;

    public function setUp () {
        $stub = new Credentials('http://example.com', '123', 'XYZ');
        $this->entity = $stub;
    }

    public function testUrlSet () {
        $this->assertEquals('http://example.com', $this->entity->getClientUrl());
    }

    public function testClientIdSet () {
        $this->assertEquals('123', $this->entity->getClientId());
    }

    public function testApiKeySet () {
        $this->assertEquals('XYZ', $this->entity->getApiKey());
    }

    public function testNoneAuthenticationCrendentials () {
        $this->assertEquals(true, $this->entity->hasAuthorizationData());

        $credentials = new Credentials('http://example.com');
        $this->assertEquals(false, $credentials->hasAuthorizationData());
    }
}