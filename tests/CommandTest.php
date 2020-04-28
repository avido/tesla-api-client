<?php
namespace Tests;

use Avido\TeslaApiClient\Exceptions\BadCredentialsException;
use Avido\TeslaApiClient\TeslaApiClient;

class CommandTest extends TestCase
{
    /**
     * @test
     */
    public function cmdWakeUp()
    {
        $this->setMock('Commands/wakeUpResponse.json');
        $response = $this->client->cmdWakeUp(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('id', $response);
    }

    /**
     * @test
     */
    public function cmdHonkHorn()
    {
        $this->setMock('Commands/honkHornResponse.json');
        $response = $this->client->cmdHonkHorn(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdFlashLights()
    {
        $this->setMock('Commands/flashLightsResponse.json');
        $response = $this->client->cmdFlashLights(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdActivateSentryModel()
    {
        $this->setMock('Commands/activateSentryModeResponse.json');
        $response = $this->client->cmdActivateSentryMode(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdDeactivateSentryModel()
    {
        $this->setMock('Commands/deactivateSentryModeResponse.json');
        $response = $this->client->cmdDeactivateSentryMode(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdUnlockDoors()
    {
        $this->setMock('Commands/unlockDoorsResponse.json');
        $response = $this->client->cmdUnlockDoors(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdLockDoors()
    {
        $this->setMock('Commands/lockDoorsResponse.json');
        $response = $this->client->cmdLockDoors(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function invalidTypeActuateTrunk()
    {
        $this->setMock('Commands/openFrunkResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdActuateTrunk(1, 'non-existing');
    }

    /**
     * @test
     */
    public function cmdOpenFrunk()
    {
        $this->setMock('Commands/openFrunkResponse.json');
        $response = $this->client->cmdOpenFrunk(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdOpenTrunk()
    {
        $this->setMock('Commands/openTrunkResponse.json');
        $response = $this->client->cmdOpenTrunk(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function invalidWindowsCommands()
    {
        $this->setMock('Commands/ventWindowsResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdWindowControl(1, 'non-existing');
    }

    /**
     * @test
     */
    public function missingLocationWindowsCommands()
    {
        $this->setMock('Commands/ventWindowsResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdWindowControl(1, 'close');
    }

    /**
     * @test
     */
    public function missingLocationArgumentWindowsCommands()
    {
        $this->setMock('Commands/ventWindowsResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdWindowControl(1, 'close', ['lat' => 1]);
    }

    /**
     * @test
     */
    public function cmdVentWindows()
    {
        $this->setMock('Commands/ventWindowsResponse.json');
        $response = $this->client->cmdVentWindows(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdCloseWindows()
    {
        $this->setMock('Commands/closeWindowsResponse.json');
        $response = $this->client->cmdCloseWindows(1, ['lat' => 1, 'lon' => 1]);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function invalidCommandSunroofCommand()
    {
        $this->setMock('Commands/ventSunroofResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdSunroofControl(1, 'invalid');
    }

    /**
     * @test
     */
    public function cmdVentSunroof()
    {
        $this->setMock('Commands/ventSunroofResponse.json');
        $response = $this->client->cmdOpenSunroof(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdCloseSunroof()
    {
        $this->setMock('Commands/closeSunroofResponse.json');
        $response = $this->client->cmdCloseSunroof(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdOpenChargePort()
    {
        $this->setMock('Commands/openChargePortResponse.json');
        $response = $this->client->cmdOpenChargePort(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdCloseChargePort()
    {
        $this->setMock('Commands/closeChargePortResponse.json');
        $response = $this->client->cmdCloseChargePort(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdStartCharge()
    {
        $this->setMock('Commands/startChargeResponse.json');
        $response = $this->client->cmdChargeStart(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdStopCharge()
    {
        $this->setMock('Commands/stopChargeResponse.json');
        $response = $this->client->cmdChargeStop(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdSetChargeLimitStandard()
    {
        $this->setMock('Commands/setChargeLimitStandardResponse.json');
        $response = $this->client->cmdSetChargeLimitStandard(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdSetChargeLimitMax()
    {
        $this->setMock('Commands/setChargeLimitMaxResponse.json');
        $response = $this->client->cmdSetChargeLimitMax(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function invalidChargeLimitPercentage()
    {
        $this->setMock('Commands/setChargeLimitResponse.json');
        $this->expectException(\InvalidArgumentException::class);
        $this->client->cmdSetChargeLimit(1, 150);
    }

    /**
     * @test
     */
    public function cmdSetChargeLimit()
    {
        $this->setMock('Commands/setChargeLimitResponse.json');
        $response = $this->client->cmdSetChargeLimit(1, 85);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdStartClimateControl()
    {
        $this->setMock('Commands/startClimateControlResponse.json');
        $response = $this->client->cmdStartClimateControl(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdStopClimateControl()
    {
        $this->setMock('Commands/stopClimateControlResponse.json');
        $response = $this->client->cmdStopClimateControl(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdSetTemperatures()
    {
        $this->setMock('Commands/setTemperaturesResponse.json');
        $response = $this->client->cmdSetTemperatures(1, 23.4, 23.4);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdSetDriverTemperatures()
    {
        $this->setMock('Commands/setTemperaturesResponse.json');
        $response = $this->client->cmdSetTemperatures(1, 23.4);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdSetPassengerTemperatures()
    {
        $this->setMock('Commands/setTemperaturesResponse.json');
        $response = $this->client->cmdSetTemperatures(1, 23.4);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdDefrostMaxOn()
    {
        $this->setMock('Commands/toggleDefrostMaxResponse.json');
        $response = $this->client->cmdToggleDefrostMax(1, true);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdDefrostMaxOff()
    {
        $this->setMock('Commands/toggleDefrostMaxResponse.json');
        $response = $this->client->cmdToggleDefrostMax(1, false);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function invalidSeatForSeatHeatOn()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->setMock('Commands/seatHeatResponse.json');
        $this->client->cmdSeatHeater(1, 9, 2);
    }

    /**
     * @test
     */
    public function invalidHeatForSeatHeatOn()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->setMock('Commands/seatHeatResponse.json');
        $this->client->cmdSeatHeater(1, 1, 12);
    }

    /**
     * @test
     */
    public function cmdSeatHeatOn()
    {
        $this->setMock('Commands/seatHeatResponse.json');
        $response = $this->client->cmdSeatHeater(1, 0, 2);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }
    /**
     * @test
     */
    public function cmdSeatHeatOff()
    {
        $this->setMock('Commands/seatHeatResponse.json');
        $response = $this->client->cmdSeatHeater(1, 0, 0);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdEnableSteeringWheelHeat()
    {
        $this->setMock('Commands/enableSteeringWheelHeatResponse.json');
        $response = $this->client->cmdEnableSteeringWheelHeat(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdDisableSteeringWheelHeat()
    {
        $this->setMock('Commands/disableSteeringWheelHeatResponse.json');
        $response = $this->client->cmdDisableSteeringWheelHeat(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdToggleMediaPlayback()
    {
        $this->setMock('Commands/toggleMediaPlaybackResponse.json');
        $response = $this->client->cmdMediaTogglePlayback(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaNextTrack()
    {
        $this->setMock('Commands/mediaNextTrackResponse.json');
        $response = $this->client->cmdMediaNextTrack(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaPrevTrack()
    {
        $this->setMock('Commands/mediaPrevTrackResponse.json');
        $response = $this->client->cmdMediaPrevTrack(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaPrevFavorite()
    {
        $this->setMock('Commands/mediaPrevFavoriteResponse.json');
        $response = $this->client->cmdMediaPrevFavorite(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaNextFavorite()
    {
        $this->setMock('Commands/mediaNextFavoriteResponse.json');
        $response = $this->client->cmdMediaNextFavorite(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaVolumeUp()
    {
        $this->setMock('Commands/mediaVolumeUpResponse.json');
        $response = $this->client->cmdMediaVolumeUp(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdMediaVolumeDown()
    {
        $this->setMock('Commands/mediaVolumeDownResponse.json');
        $response = $this->client->cmdMediaVolumeDown(1);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdShareNavigation()
    {
        $this->setMock('Commands/shareNavigationResponse.json');
        $response = $this->client->cmdShare(1, [
            'locale' => 'en-US',
            'value' => '123 Main St, City, ST 12345\n\nhttps://goo.gl/maps/X'
        ]);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdScheduleSoftwareUpdate()
    {
        $this->setMock('Commands/scheduleSoftwareUpdateResponse.json');
        $response = $this->client->cmdScheduleSoftwareUpdate(1, 7200);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }

    /**
     * @test
     */
    public function cmdCancelSoftwareUpdate()
    {
        $this->setMock('Commands/cancelSoftwareUpdateResponse.json');
        $response = $this->client->cmdCancelSoftwareUpdate(1, 7200);
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('result', $response);
    }
}
