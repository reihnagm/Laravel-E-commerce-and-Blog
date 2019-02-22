<?php

namespace App\Exports;

use App\Models\User;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

    public function registerEvents(): array
    {

      $style =  [
          'font' => [
            'bold' => true,
            'color' => ['argb' => 'FFFFFFF']
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
          ],
          'fill' => [
             'fillType' => fill::FILL_SOLID,
             'startColor' => [
                 'argb' => '0000000',
             ],
          ]
    ];

      $style2 =  [
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
          ]
    ];

    Sheet::macro('users', function (Sheet $sheet) use ($style, $style2) {
      $rangeContent = 'A2:E5';
      $rangeHeader = 'A1:E1';

      $sheet->getDelegate()->getStyle($rangeHeader)->applyFromArray($style);
      $sheet->getDelegate()->getStyle($rangeContent)->applyFromArray($style2);
    });

        return [
        //     // BeforeSheet::class => function(BeforeSheet $event) use($styleArray) {
        //     //   $range = 'A1:E1';
        //     //   $color = '0000000';
        //     //   $event->sheet->getDelegate()->getStyle($range)->applyFromArray($styleArray);
        //     //   // ->getFill()
        //       // ->setFillType(Fill::FILL_SOLID)
        //       // ->getStartColor()->setARGB($color)
        //
        //
        //       // $event->sheet->setCellValue('D1', 'Data tambahan dengan font bold');
        //     // },
        //
        //     // AfterSheet::class => function(AfterSheet $event) use($styleArray) {
        //     //   $range = 'A1:E1';
        //     //   $color = '0000000';
        //     //   $event->sheet->getDelegate()->getStyle($range)->applyFromArray($styleArray);
        //       // ->getFill()
        //       // ->setFillType(Fill::FILL_SOLID)
        //       // ->getStartColor()->setARGB($color)
        //
        //
        //       // $event->sheet->setCellValue('D1', 'Data tambahan dengan font bold');
        //     },
        AfterSheet::class => function(AfterSheet $event) {$event->sheet->users();},
        ];

     }

    public function collection() {
      return User::select('id', 'name', 'email', 'created_at')->get();
    }

    // public function sheets(): array
    // {
    //     $sheets = [];
    //
    //     for ($month = 1; $month <= 12; $month++) {
    //         $sheets[] = new UsersPerMonthSheet();
    //     }
    //
    //     return $sheets;
    // }

    // public function query()
    // {
    //     return User::orderBy('id');
    // }

    public function map($user): array
    {
        return [
          $user->id,
          $user->name,
          $user->email,
          $user->provider,
          showDate($user->created_at),

          // Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
          '#',
          'Name',
          'Email',
          'Provider',
          'Created at'
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //     'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //   ];
    // }

}
