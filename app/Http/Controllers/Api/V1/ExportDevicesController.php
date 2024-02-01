<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class ExportDevicesController extends Controller
{
    /**
     * GET Export Devices
     *
     * Exports all devices as CSV.
     */
    public function __invoke(Request $request)
    {
        $devices = Device::all();

        $csv_filename = 'devices.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$csv_filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate',
            'Expires' => '0',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, config('constants.device_columns'));

        foreach ($devices as $device) {
            $device_data = [
                $device->id,
                $device->form_factor,
                $device->serial_number,
                $device->imei,
                $device->device_manufacturer->name,
                $device->device_model->name,
                $device->operating_system,
                $device->user->name,
                $device->sim_card->phone_number->number,
                $device->deactivated_at,
                $device->created_at,
                $device->updated_at,
            ];
            fputcsv($handle, $device_data);
        }

        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers
        );
    }
}
