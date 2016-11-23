<?php namespace Shell\Offers\Models;

/**
 * Export Model
 */
class ProvinceExport extends \Backend\Models\ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $records = \Shell\Offers\Models\Province::all();
        $records->each(function($record) use ($columns) {
            $record->addVisible($columns);
        });
        return $records->toArray();
    }
}