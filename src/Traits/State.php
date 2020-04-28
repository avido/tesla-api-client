<?php
namespace Avido\TeslaApiClient\Traits;

/**
 * Trait Vehicle
 * Vehicle related calls
 */
trait State
{
    /**
     * Get list of available vehicles.
     * @see https://tesla-api.timdorr.com/api-basics/vehicles#get-api-1-vehicles
     * @return array
     */
    public function getVehicles(): array
    {
        $response = $this->get("api/1/vehicles");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle details
     * @see https://tesla-api.timdorr.com/api-basics/vehicles#get-api-1-vehicles-id
     * @param string $id
     * @return array
     */
    public function getVehicle(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Data
     * @ee https://tesla-api.timdorr.com/vehicle/state/data
     * @param string $id
     * @return array
     */
    public function getVehicleData(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Service Data
     * @see https://www.teslaapi.io/vehicles/state-and-settings#vehicle-service-data
     * @param string $id
     * @return array
     */
    public function getVehicleServiceData(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/service_data");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Mobile Enabled
     * see https://tesla-api.timdorr.com/vehicle/state/mobileenabled
     * @param string $id
     * @return bool
     */
    public function getVehicleMobileEnabled(string $id): bool
    {
        $response = $this->get("api/1/vehicles/{$id}/mobile_enabled");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle State
     * @see https://tesla-api.timdorr.com/vehicle/state/vehiclestate
     * @param string $id
     * @return array
     */
    public function getVehicleState(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/vehicle_state");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Charge State
     * @see https://tesla-api.timdorr.com/vehicle/state/chargestate
     * @param string $id
     * @return array
     */
    public function getVehicleChargeState(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/charge_state");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Climate State
     * @see https://tesla-api.timdorr.com/vehicle/state/climatestate
     * @param string $id
     * @return array
     */
    public function getVehicleClimateState(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/climate_state");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Climate State
     * @see https://tesla-api.timdorr.com/vehicle/state/drivestate
     * @param string $id
     * @return array
     */
    public function getVehicleDriveState(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/drive_state");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle GUI Settings
     * @see https://tesla-api.timdorr.com/vehicle/state/guisettings
     * @param string $id
     * @return array
     */
    public function getVehicleGuiSettings(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/gui_settings");
        return $response['response'] ?? [];
    }

    /**
     * Get Vehicle Config
     * @see https://tesla-api.timdorr.com/vehicle/state/vehicleconfig
     * @param string $id
     * @return array
     */
    public function getVehicleConfig(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/data_request/vehicle_config");
        return $response['response'] ?? [];
    }

    /**
     * Get Nearby Charging Sites
     * @see https://tesla-api.timdorr.com/vehicle/state/nearbychargingsites
     * @param string $id
     * @return array
     */
    public function getNearbyChargingSites(string $id): array
    {
        $response = $this->get("api/1/vehicles/{$id}/nearby_charging_sites");
        return $response['response'] ?? [];
    }
}
