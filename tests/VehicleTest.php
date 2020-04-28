<?php
namespace Tests;

use Avido\TeslaApiClient\Exceptions\BadCredentialsException;
use Avido\TeslaApiClient\TeslaApiClient;

class VehicleTest extends TestCase
{

    /**
     * @test
     */
    public function listVehicles()
    {
        $this->setMock('State/listVehiclesResponse.json');
        $response = $this->client->getVehicles();
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('id', $response[0]);
        return $response[0]['id'];
    }

    /**
     * @test
     */
    public function vehicleDetails()
    {
        $this->setMock('State/vehicleDetailsResponse.json');
        $response = $this->client->getVehicle(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('id', $response);
    }

    /**
     * @test
     */
    public function getVehicleData()
    {
        $this->setMock('State/getVehicleDataResponse.json');
        $response = $this->client->getVehicleData(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('id', $response);
    }

    /**
     * @test
     */
    public function getVehicleStateMobileEnabled()
    {
        $this->setMock('State/getVehicleMobileEnabledResponse.json');
        $response = $this->client->getVehicleMobileEnabled(1);
        $this->assertTrue(is_bool($response));
    }

    /**
     * @test
     */
    public function getVehicleGuiSettings()
    {
        $this->setMock('State/getVehicleGuiSettingsResponse.json');
        $response = $this->client->getVehicleGuiSettings(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('gui_distance_units', $response);
    }

    /**
     * @test
     */
    public function getVehicleConfig()
    {
        $this->setMock('State/getVehicleConfigResponse.json');
        $response = $this->client->getVehicleConfig(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('car_type', $response);
    }

    /**
     * @test
     */
    public function getNearbyChargingSites()
    {
        $this->setMock('State/getNearbyChargingSitesResponse.json');
        $response = $this->client->getNearbyChargingSites(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('congestion_sync_time_utc_secs', $response);
    }
}
