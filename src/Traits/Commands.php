<?php
namespace Avido\TeslaApiClient\Traits;

/**
 * Trait Commands
 * Commands related calls
 */
trait Commands
{
    /**
     * Wake up
     * @see https://tesla-api.timdorr.com/vehicle/commands/wake
     * @param string $id
     * @return array
     */
    public function cmdWakeUp(string $id): array
    {
        $response = $this->post("api/1/vehicles/{$id}/wake_up");
        return $response['response'] ?? [];
    }

    /**
     * Honk horn (twice)
     * @see https://tesla-api.timdorr.com/vehicle/commands/alerts#post-api-1-vehicles-id-command-honk_horn
     * @param string $id
     * @return array
     */
    public function cmdHonkHorn(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/honk_horn");
    }

    /**
     * Flash Lights
     * @see https://tesla-api.timdorr.com/vehicle/commands/alerts#post-api-1-vehicles-id-command-flash_lights
     * @param string $id
     * @return array
     */
    public function cmdFlashLights(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/flash_lights");
    }

    /**
     * Set Sentry Mode on|off
     * @see https://tesla-api.timdorr.com/vehicle/commands/sentrymode#post-api-1-vehicles-id-command-set_sentry_mode
     * @param string $id
     * @param bool $activated
     * @return array
     */
    public function cmdSetSentryMode(string $id, bool $activated): array
    {
        return $this->post("api/1/vehicles/{$id}/command/set_sentry_mode", [
            'on' => $activated
        ]);
    }

    /**
     * Activate Sentry Mode
     * @param string $id
     * @return array
     */
    public function cmdActivateSentryMode(string $id): array
    {
        return $this->cmdSetSentryMode($id, true);
    }

    /**
     * Deactivate Sentry Mode
     * @param string $id
     * @return array
     */
    public function cmdDeactivateSentryMode(string $id): array
    {
        return $this->cmdSetSentryMode($id, false);
    }

    /**
     * Unlock doors
     * @see https://tesla-api.timdorr.com/vehicle/commands/doors#post-api-1-vehicles-id-command-door_unlock
     * @param string $id
     * @return array
     */
    public function cmdUnlockDoors(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/door_unlock");
    }

    /**
     * Lock doors
     * @see https://tesla-api.timdorr.com/vehicle/commands/doors#post-api-1-vehicles-id-command-door_lock
     * @param string $id
     * @return array
     */
    public function cmdLockDoors(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/door_lock");
    }

    /**
     * Open/close frunk/trunk
     * @see https://tesla-api.timdorr.com/vehicle/commands/trunk#post-api-1-vehicles-id-command-actuate_trunk
     * @param string $id
     * @param string $target
     * @return array
     */
    public function cmdActuateTrunk(string $id, string $target): array
    {
        if (!in_array($target, ['rear', 'front'])) {
            throw new \InvalidArgumentException("Target needs to be rear or front");
        }

        return $this->post("api/1/vehicles/{$id}/command/actuate_trunk", [
            'which_trunk' => $target
        ]);
    }

    /**
     * Open Frunk
     * @param string $id
     * @return array
     */
    public function cmdOpenFrunk(string $id): array
    {
        return $this->cmdActuateTrunk($id, 'front');
    }

    /**
     * Open trunk
     * @param string $id
     * @return array
     */
    public function cmdOpenTrunk(string $id): array
    {
        return $this->cmdActuateTrunk($id, 'rear');
    }

    /**
     * Control window: vent or close
     * If command is close $location['lat'] & $location['lon'] need to be provided
     *
     * @see https://tesla-api.timdorr.com/vehicle/commands/windows#post-api-1-vehicles-id-command-window_control
     * @param string $id
     * @param string $command
     * @param array $location
     * @return array
     */
    public function cmdWindowControl(string $id, string $command, array $location = []): array
    {
        if (!in_array($command, ['vent', 'close'])) {
            throw new \InvalidArgumentException("Command needs to be: vent or close");
        }
        if ($command == 'close' &&
            (
                count($location) === 0 ||
                !isset($location['lat']) ||
                !isset($location['lon'])
            )
        ) {
            throw new \InvalidArgumentException("For the close command lat and lon need to be provided");
        }
        $arguments = [
            'command' => $command
        ];
        if ($command === 'close') {
            $arguments = array_merge($arguments, $location);
        }
        return $this->post("api/1/vehicles/{$id}/command/window_control", $arguments);
    }

    /**
     * Vent windows
     * @param string $id
     * @return array
     */
    public function cmdVentWindows(string $id): array
    {
        return $this->cmdWindowControl($id, 'vent');
    }

    /**
     * Close windows
     * @param string $id
     * @param array $location
     * @return array
     */
    public function cmdCloseWindows(string $id, array $location = [])
    {
        return $this->cmdWindowControl($id, 'close', $location);
    }

    /**
     * Vent/Close sunroof
     * @see https://tesla-api.timdorr.com/vehicle/commands/sunroof#post-api-1-vehicles-id-command-sun_roof_control
     * @param string $id
     * @param string $command
     * @return array
     */
    public function cmdSunroofControl(string $id, string $command): array
    {
        if (!in_array($command, ['vent', 'close'])) {
            throw new \InvalidArgumentException("Command needs to be: vent or close");
        }
        return $this->post("api/1/vehicles/{$id}/command/sun_roof_control", [
            'state' => $command
        ]);
    }

    /**
     * Open sunroof
     * @param string $id
     * @return array
     */
    public function cmdOpenSunroof(string $id): array
    {
        return $this->cmdSunroofControl($id, 'vent');
    }

    /**
     * Close sunroof
     * @param string $id
     * @return array
     */
    public function cmdCloseSunroof(string $id): array
    {
        return $this->cmdSunroofControl($id, 'close');
    }

    /**
     * Open Charge Port
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_port_door_open
     * @param string $id
     * @return array
     */
    public function cmdOpenChargePort(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_port_door_open");
    }

    /**
     * Close Charge Port
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_port_door_close
     * @param string $id
     * @return array
     */
    public function cmdCloseChargePort(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_port_door_close");
    }

    /**
     * Start Charging
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_start
     * @param string $id
     * @return array
     */
    public function cmdChargeStart(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_start");
    }

    /**
     * Stop Charging
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_stop
     * @param string $id
     * @return array
     */
    public function cmdChargeStop(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_stop");
    }

    /**
     * Set Charge Limit Standard ~90%
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_standard
     * @param string $id
     * @return array
     */
    public function cmdSetChargeLimitStandard(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_standard");
    }

    /**
     * Set Charge Limit Max
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-charge_max_range
     * @param string $id
     * @return array
     */
    public function cmdSetChargeLimitMax(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/charge_max_range");
    }

    /**
     * Set Charge Limit Percentage
     *
     * @see https://tesla-api.timdorr.com/vehicle/commands/charging#post-api-1-vehicles-id-command-set_charge_limit
     * @param string $id
     * @param int $percentage
     * @return array
     */
    public function cmdSetChargeLimit(string $id, int $percentage): array
    {
        if ($percentage < 1 || $percentage > 100) {
            throw new \InvalidArgumentException("Enter percentage between 1-100");
        }
        return $this->post("api/1/vehicles/{$id}/command/set_charge_limit");
    }

    /**
     * Start HVAC
     * @see https://tesla-api.timdorr.com/vehicle/commands/climate#post-api-1-vehicles-id-command-auto_conditioning_start
     * @param string $id
     * @return array
     */
    public function cmdStartClimateControl(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/auto_conditioning_start");
    }

    /**
     * Stop HVAC
     * @see https://tesla-api.timdorr.com/vehicle/commands/climate#post-api-1-vehicles-id-command-auto_conditioning_stop
     * @param string $id
     * @return array
     */
    public function cmdStopClimateControl(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/auto_conditioning_stop");
    }

    /**
     * Set Temperatures
     * @see https://tesla-api.timdorr.com/vehicle/commands/climate#post-api-1-vehicles-id-command-set_temps
     * @param string $id
     * @param float|null $driverTemperature
     * @param float|null $passengerTemperature
     * @return array
     */
    public function cmdSetTemperatures(
        string $id,
        ?float $driverTemperature = null,
        ?float $passengerTemperature = null
    ): array {
        $arguments = [];
        if (!is_null($driverTemperature)) {
            $arguments['driver_temp'] = number_format($driverTemperature, 1);
        }
        if (!is_null($passengerTemperature)) {
            $arguments['passenger_temp'] = number_format($passengerTemperature, 1);
        }
        return $this->post("api/1/vehicles/{$id}/command/set_temps", $arguments);
    }

    /**
     * Set airco/ condition to max or previous state ($on = max, !$on = previous)
     * @see https://tesla-api.timdorr.com/vehicle/commands/climate#post-api-1-vehicles-id-command-set_preconditioning_max
     * @param string $id
     * @param bool $on
     * @return array
     */
    public function cmdToggleDefrostMax(string $id, bool $on): array
    {
        return $this->post("api/1/vehicles/{$id}/command/set_preconditioning_max", [
            'on' => $on
        ]);
    }

    /**
     * Set Seat Heater
     * Seat config:
     *  0 - driver
     *  1 - passenger
     *  2 - Rear left
     *  4 - Rear Center
     *  5 - Rear right
     * @param string $id
     * @param int $seat
     * @param int $level
     * @return array
     */
    public function cmdSeatHeater(string $id, int $seat, int $level): array
    {
        if ($seat < 0 || $seat > 5 || $seat === 3) {
            throw new \InvalidArgumentException("Invalid Seat, choose between 0,1,2,4,5");
        }
        if ($level < 0 || $level > 3) {
            throw new \InvalidArgumentException("Invalid heat, choose between 0-3");
        }

        return $this->post("api/1/vehicles/{$id}/command/remote_seat_heater_request", [
            'seat' => $seat,
            'heater' => $level
        ]);
    }

    /**
     * Enable/disable steering wheel heat
     * @see https://tesla-api.timdorr.com/vehicle/commands/climate#post-api-1-vehicles-id-command-remote_steering_wheel_heater_request
     * @param string $id
     * @param bool $on
     * @return array
     */
    public function cmdSteeringWheelHeat(string $id, bool $on): array
    {
        return $this->post("api/1/vehicles/{$id}/command/remote_steering_wheel_heater_request", [
            'on' => $on
        ]);
    }

    /**
     * Enable Steering Wheel Heat
     * @param string $id
     * @return array
     */
    public function cmdEnableSteeringWheelHeat(string $id): array
    {
        return $this->cmdSteeringWheelHeat($id, true);
    }

    /**
     * Disable Steering Wheel Heat
     * @param string $id
     * @return array
     */
    public function cmdDisableSteeringWheelHeat(string $id): array
    {
        return $this->cmdSteeringWheelHeat($id, false);
    }

    /**
     * Toggle media playback (mute/unmute)
     * @param string $id
     * @return mixed
     */
    public function cmdMediaTogglePlayback(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_toggle_playback");
    }

    /**
     * Skips to the next track in the current playlist.
     * @param string $id
     * @return array
     */
    public function cmdMediaNextTrack(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_next_track");
    }

    /**
     * Skips to the previous track in the current playlist.
     * @param string $id
     * @return array
     */
    public function cmdMediaPrevTrack(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_prev_track");
    }

    /**
     * Skips to the next saved favorite in the media system.
     * @param string $id
     * @return array
     */
    public function cmdMediaNextFavorite(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_next_fav");
    }

    /**
     * Skips to the previous saved favorite in the media system.
     * @param string $id
     * @return array
     */
    public function cmdMediaPrevFavorite(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_prev_fav");
    }

    /**
     * Turns up the volume of the media system.
     * @param string $id
     * @return array
     */
    public function cmdMediaVolumeUp(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_volume_up");
    }

    /**
     * Turns down the volume of the media system.
     * @param string $id
     * @return array
     */
    public function cmdMediaVolumeDown(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/media_volume_down");
    }

    /**
     * Sends a location for the car to start navigation or play a video in theatre mode.
     *
     * @param string $id
     * @param array $parameters
     * @return array
     */
    public function cmdShare(string $id, array $parameters): array
    {
        $locale = $parameters['locale'] ?? 'en-US';
        if (!preg_match("/^[a-z]{2}\-[A-Z]{2}$/", $locale)) {
            throw new \InvalidArgumentException("Invalid locale. Locale should be: en-US");
        }
        if (!isset($parameters['value'])) {
            throw new \InvalidArgumentException("Value is missing");
        }
        return $this->post("api/1/vehicles/{$id}/command/share", [
            'type' => 'share_ext_content_raw',
            'locale' => $locale,
            'timestamp_ms' => time(),
            'value' => [
                'android.intent.extra.TEXT' => $parameters['value']
            ]
        ]);
    }

    /**
     * Schedule software update (if applicable)
     * @param string $id
     * @param int $offsetSeconds - seconds in the future
     * @return array
     */
    public function cmdScheduleSoftwareUpdate(string $id, int $offsetSeconds): array
    {
        return $this->post("api/1/vehicles/{$id}/command/schedule_software_update", [
            'offset_sec' => $offsetSeconds
        ]);
    }

    /**
     * Cancel software update
     * @param string $id
     * @return array
     */
    public function cmdCancelSoftwareUpdate(string $id): array
    {
        return $this->post("api/1/vehicles/{$id}/command/cancel_software_update");
    }
}
