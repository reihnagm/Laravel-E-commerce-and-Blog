<?php

namespace App\Exports;

use App\Models\User;

use PhpOffice\PhpSpreadsheet\Shared\Date;

use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeExport;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;


class UsersPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, WithEvents
{

    //  private $month;
    //  private $year;
    //
    // public function __construct(int $year, int $month)
    // {
    //
    //   $this->month = $month;
    //   $this->year = $year;
    //
    // }


    public function registerEvents(): array
    {

      $styleArray = [
          'font' => [
            'bold' => true,
          ]
      ];

        return [
            BeforeSheet::class => function(BeforeSheet $event) use($styleArray) {
              $event->sheet->getStyle('D1')->applyFromArray($styleArray);
              $event->sheet->setCellValue('D1', 'Data tambahan dengan font bold');
            },

             BeforeExport::class => function(BeforeExport $event) {
             $event->writer->getProperties()->setCreator('Taylor Otwell');
            },
        ];

    }

    public function query()
    {
        return User
           ::query();
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

    public function title(): string
    {
        return 'Month';
    }

}
