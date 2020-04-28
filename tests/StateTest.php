<?php
namespace Tests;

use Avido\TeslaApiClient\Exceptions\BadCredentialsException;
use Avido\TeslaApiClient\TeslaApiClient;

class StateTest extends TestCase
{
    /**
     * @test
     */
    public function getVehicleState()
    {
        $this->setMock('State/getVehicleStateResponse.json');
        $response = $this->client->getVehicleState(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('api_version', $response);
    }

    /**
     * @test
     */
    public function getVehicleChargeState()
    {
        $this->setMock('State/getVehicleChargeStateResponse.json');
        $response = $this->client->getVehicleChargeState(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('charging_state', $response);
    }

    /**
     * @test
     */
    public function getVehicleClimateState()
    {
        $this->setMock('State/getVehicleClimateStateResponse.json');
        $response = $this->client->getVehicleClimateState(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('inside_temp', $response);
    }

    /**
     * @test
     */
    public function getVehicleDriveState()
    {
        $this->setMock('State/getVehicleDriveStateResponse.json');
        $response = $this->client->getVehicleDriveState(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('speed', $response);
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
}
