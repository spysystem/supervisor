<?php

namespace Indigo\Supervisor\Test\Connector;

use Indigo\Supervisor\Connector\InetConnector;

/**
 * @coversDefaultClass \Indigo\Supervisor\Connector\InetConnector
 */
class InetConnectorTest extends ConnectorTest
{
    public function setUp()
    {
        $this->connector = new InetConnector('localhost');
    }

    /**
     * @covers ::__construct
     * @covers ::isConnected
     * @group  Supervisor
     */
    public function testInstance()
    {
        $connector = new InetConnector('localhost');

        $this->assertInstanceOf(
            'Indigo\\Supervisor\\Connector\\InetConnector',
            $connector
        );

        $this->assertTrue($this->connector->isConnected());
    }

    /**
     * @covers ::setResource
     * @covers ::getResource
     * @group  Supervisor
     */
    public function testResource()
    {
        $connector = clone $this->connector;
        $this->assertInstanceOf(
            get_class($connector),
            $connector->setResource(null)
        );

        $this->assertNull($connector->getResource());
    }

    /**
     * @covers            ::__construct
     * @expectedException InvalidArgumentException
     * @group             Supervisor
     */
    public function testInvalidResource()
    {
        $connector = new InetConnector('xyz:\\\\_.?');
    }

    /**
     * @covers            ::call
     * @covers            ::prepareRequest
     * @covers            ::prepareClient
     * @expectedException RuntimeException
     * @group             Supervisor
     */
    public function testFaultyCall()
    {
        $this->connector->call('nothing', 'here');
    }

    /**
     * @covers            ::call
     * @covers            ::prepareRequest
     * @covers            ::prepareClient
     * @expectedException RuntimeException
     * @group             Supervisor
     */
    public function testCallFailure()
    {
        $this->connector->setResource(null);
        $this->connector->call('nothing', 'here');
    }
}
