<?php

namespace App\Exports;

use App\Models\User;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;



class UsersPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, WithEvents
{


    public function registerEvents(): array
    {

      $styleArray = [
          'font' => [
            'bold' => true,
          ],
          'borders' => [
              'outline' => [
                  'borderStyle' => Border::BORDER_THICK,
                  'color' => ['argb' => '0000000'],
              ],
          ]
      ];

        return [
            BeforeExport::class => function(BeforeExport $event) {
                $event->writer->getProperties()->setAuthor('Reihan Agam');
            },

            BeforeWriting::class => [self::class, 'beforeWriting'],

            BeforeSheet::class => function(BeforeSheet $event) use($styleArray) {
              $event->sheet->getStyle('D1')->applyFromArray($styleArray);
              $event->sheet->setCellValue('D1', 'Data tambahan dengan font bold');
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
