<?php

/*
 * This file is part of Geokit.
 *
 * (c) Jan Sorgalla <jsorgalla@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geokit\Tests\Geocoding;

use Geokit\Geocoding\YahooPlaceFinderGeocoder;
use Geokit\Geocoding\LocationFactory;
use Geokit\Geocoding\LocationInterface;
use Geokit\Geocoding\Response;
use Geokit\LatLng;
use Geokit\Bounds;
use Buzz\Browser;

/**
 * @author  Jan Sorgalla <jsorgalla@googlemail.com>
 * @version @package_version@
 *
 * @covers Geokit\Geocoding\YahooPlaceFinderGeocoder
 */
class YahooPlaceFinderGeocoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Buzz\Browser
     */
    private $browser;

    /**
     * @var \Geokit\Geocoding\YahooPlaceFinderGeocoder
     */
    private $geocoder;

    public function setUp()
    {
        parent::setUp();

        $this->browser = $this->getMockBuilder('\Buzz\Browser')
                               ->getMock();

        $this->geocoder = new YahooPlaceFinderGeocoder('appId', new LocationFactory(), $this->browser);
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->geocoder = null;
    }

    public function testEmptyAppIdThrowsException()
    {
        $this->setExpectedException('\InvalidArgumentException', 'The application id is empty');
        new YahooPlaceFinderGeocoder(null);
    }

    public function testCustomUrlAndParameters()
    {
        $browser = $this->getMockBuilder('\Buzz\Browser')
                        ->getMock();

        $response = new \Buzz\Message\Response();
        $response->addHeader('HTTP/1.0 404 Not Found');

        $this->browser->expects($this->once())
                      ->method('get')
                      ->with('http://example.com?q=742+Evergreen+Terrace&locale=de_DE&foo=bar&appid=appId&flags=JX')
                      ->will($this->returnValue($response));

        $this->geocoder->setApiUri('http://example.com');
        $this->geocoder->setRequestParams(array('locale' => 'de_DE', 'foo' => 'bar'));

        $this->geocoder->geocodeAddress('742 Evergreen Terrace');
    }

    public function testJFlagAutomaticallyAdded()
    {
        $browser = $this->getMockBuilder('\Buzz\Browser')
                        ->getMock();

        $response = new \Buzz\Message\Response();
        $response->addHeader('HTTP/1.0 404 Not Found');

        $this->browser->expects($this->once())
                      ->method('get')
                      ->with('http://example.com?q=742+Evergreen+Terrace&flags=XJ&appid=appId&locale=en_US')
                      ->will($this->returnValue($response));

        $this->geocoder->setApiUri('http://example.com');
        $this->geocoder->setRequestParams(array('flags' => 'X'));

        $this->geocoder->geocodeAddress('742 Evergreen Terrace');
    }

    public function testGeocodeAddressZeroResultsResponse()
    {
        $response = \Geokit\Tests\TestHelper::createBuzzResponseFromString('HTTP/1.0 200 OK
Content-Type: application/json; charset=UTF-8

{"ResultSet":{"version":"1.0","Error":0,"ErrorMessage":"No error","Locale":"us_US","Quality":10,"Found":0}}');

        $this->browser->expects($this->once())
                      ->method('get')
                      ->will($this->returnValue($response));

        $response = $this->geocoder->geocodeAddress('742 Evergreen Terrace');

        $this->assertInstanceOf('\Geokit\Geocoding\Response', $response);
        $this->assertEquals(404, $response->getCode());
        $this->assertNull($response->getLocation());
    }

    public function testGeocodeAddressInvalidRequestResponse()
    {
        $response = \Geokit\Tests\TestHelper::createBuzzResponseFromString('HTTP/1.0 200 OK
Content-Type: application/json; charset=UTF-8

{"ResultSet":{"version":"1.0","Error":100,"ErrorMessage":"No location parameters","Locale":"us_US","Quality":0,"Found":0}}');

        $this->browser->expects($this->once())
                      ->method('get')
                      ->will($this->returnValue($response));

        $response = $this->geocoder->geocodeAddress('742 Evergreen Terrace');

        $this->assertInstanceOf('\Geokit\Geocoding\Response', $response);
        $this->assertEquals(400, $response->getCode());
        $this->assertNull($response->getLocation());
    }

    public function testGeocodeAddress()
    {
        $response = \Geokit\Tests\TestHelper::createBuzzResponseFromString(file_get_contents(__DIR__.'/Fixtures/yahooplacefindergeocoder_response_1.txt'));

        $this->browser->expects($this->once())
                      ->method('get')
                      ->will($this->returnValue($response));

        $response = $this->geocoder->geocodeAddress('1600 Amphitheatre Parkway, Mountain View, CA');

        $this->assertInstanceOf('\Geokit\Geocoding\Response', $response);
        $this->assertEquals(200, $response->getCode());
        $this->assertSame($this->geocoder, $response->getGeocoder());

        $location = $response->getLocation();

        $this->assertInstanceOf('\Geokit\Geocoding\LocationInterface', $location);
        $this->assertEquals(new LatLng(37.423232, -122.085569), $location->getLatLng());
        $this->assertEquals(LocationInterface::ACCURACY_PRECISE, $location->getAccuracy());
        $this->assertEquals(new Bounds(new LatLng(37.423232, -122.085569), new LatLng(37.423232, -122.085569)), $location->getBounds());
        $this->assertEquals(null, $location->getViewport());
        $this->assertEquals(null, $location->getFormattedAddress());
        $this->assertEquals('1600', $location->getStreetNumber());
        $this->assertEquals('Amphitheatre Pky', $location->getStreetName());
        $this->assertEquals('94043-1351', $location->getPostalCode());
        $this->assertEquals('Mountain View', $location->getLocality());
        $this->assertEquals('California', $location->getRegion());
        $this->assertEquals('United States', $location->getCountryName());
        $this->assertEquals('US', $location->getCountryCode());
    }

    public function testReverseGeocodeLatLng()
    {
        $response = \Geokit\Tests\TestHelper::createBuzzResponseFromString(file_get_contents(__DIR__.'/Fixtures/yahooplacefindergeocoder_response_2.txt'));

        $this->browser->expects($this->once())
                      ->method('get')
                      ->will($this->returnValue($response));

        $response = $this->geocoder->reverseGeocodeLatLng(new LatLng(40.714224, -73.961452));

        $this->assertInstanceOf('\Geokit\Geocoding\Response', $response);
        $this->assertEquals(200, $response->getCode());
        $this->assertSame($this->geocoder, $response->getGeocoder());

        $location = $response->getLocation();

        $this->assertInstanceOf('\Geokit\Geocoding\LocationInterface', $location);

        $this->assertEquals(new LatLng(40.714129, -73.961407), $location->getLatLng());
        $this->assertEquals(LocationInterface::ACCURACY_PRECISE, $location->getAccuracy());
        $this->assertEquals(new Bounds(new LatLng(40.714129, -73.961407), new LatLng(40.714129, -73.961407)), $location->getBounds());
        $this->assertEquals(null, $location->getViewport());
        $this->assertEquals(null, $location->getFormattedAddress());
        $this->assertEquals('285', $location->getStreetNumber());
        $this->assertEquals('Bedford Ave', $location->getStreetName());
        $this->assertEquals('11211-4203', $location->getPostalCode());
        $this->assertEquals('Brooklyn', $location->getLocality());
        $this->assertEquals('New York', $location->getRegion());
        $this->assertEquals('United States', $location->getCountryName());
        $this->assertEquals('US', $location->getCountryCode());

        $this->assertCount(0, $response->getAdditionalLocations());
    }
    
    public function testGeocodeIp()
    {
        $response = \Geokit\Tests\TestHelper::createBuzzResponseFromString(file_get_contents(__DIR__.'/Fixtures/yahooplacefindergeocoder_response_3.txt'));

        $this->browser->expects($this->once())
                      ->method('get')
                      ->will($this->returnValue($response));

        $response = $this->geocoder->geocodeIp('12.215.42.19');

        $this->assertInstanceOf('\Geokit\Geocoding\Response', $response);
        $this->assertEquals(200, $response->getCode());
        $this->assertSame($this->geocoder, $response->getGeocoder());

        $location = $response->getLocation();

        $this->assertInstanceOf('\Geokit\Geocoding\LocationInterface', $location);
        $this->assertEquals(new LatLng(41.346561, -88.842659), $location->getLatLng());
        $this->assertEquals(LocationInterface::ACCURACY_CENTER, $location->getAccuracy());
        $this->assertEquals(new Bounds(new LatLng(41.308990, -88.875221), new LatLng(41.389130, -88.795303)), $location->getBounds());
        $this->assertEquals(null, $location->getViewport());
        $this->assertEquals(null, $location->getFormattedAddress());
        $this->assertEquals(null, $location->getStreetNumber());
        $this->assertEquals(null, $location->getStreetName());
        $this->assertEquals('61350', $location->getPostalCode());
        $this->assertEquals('Ottawa', $location->getLocality());
        $this->assertEquals('Illinois', $location->getRegion());
        $this->assertEquals('United States', $location->getCountryName());
        $this->assertEquals('US', $location->getCountryCode());
    }
}
