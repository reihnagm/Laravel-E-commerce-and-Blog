<?php

namespace App\Exports;

use App\Models\Product;


use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\Exportable;

class ProductsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

      public function registerEvents(): array
      {
          $styleHeader =  [
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

           $styleContent =  [
               'alignment' => [
                 'horizontal' => Alignment::HORIZONTAL_CENTER,
               ]
            ];

            Sheet::macro('products', function (Sheet $sheet) use ($styleHeader, $styleContent) {
              $headerRange = 'A1:H1';
              $contentRange = 'A1:H31';
              $sheet->getDelegate()->getStyle($headerRange)->applyFromArray($styleHeader);
              $sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleContent);
            });

        return [
            AfterSheet::class => function (AfterSheet $event)  {
              $event->sheet->products();
            }
        ];

      }

    public function collection()
    {
        return Product::select('id', 'name', 'desc', 'price', 'created_at', 'user_id', 'slug')->get();
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

    public function map($product): array
    {
        return [
          $product->id,
          $product->name,
          $product->desc,
          $product->price,
          showDate($product->created_at),
          $product->user_id,
          $product->slug
          // Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
          '#',
          'Name',
          'Desc',
          'Price',
          'Created at',
          'User id',
          'Slug'
        ];
    }


    // public function columnFormats(): array
    // {
    //     return [
    //     'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //   ];
    // }
}
