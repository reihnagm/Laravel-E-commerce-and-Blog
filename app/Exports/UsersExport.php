<?php

namespace App\Exports;

use App\Models\User;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new UsersPerMonthSheet();
        }

        return $sheets;
    }


    public function query()
    {
        return User::orderBy('id');
    }

    public function map($user): array
    {
        return [
          $user->name,
          $user->email,
          Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
          'Name',
          'Email',
          'Created At'
        ];
    }

    public function columnFormats(): array
    {
        return [
        'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      ];
    }
}
