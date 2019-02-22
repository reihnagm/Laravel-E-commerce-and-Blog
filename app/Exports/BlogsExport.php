<?php

namespace App\Exports;

use App\Models\Blog;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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

class BlogsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
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

    Sheet::macro('blogs', function (Sheet $sheet) use ($styleHeader, $styleContent) {
      $headerRange = 'A1:H1';
      $contentRange = 'A1:H31';
      $sheet->getDelegate()->getStyle($headerRange)->applyFromArray($styleHeader);
      $sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleContent);
    });


    return [
      AfterSheet::class => function(AfterSheet $event) {$event->sheet->blogs();},
    ];


  }

    public function collection()
    {
      return Blog::select('id', 'title', 'caption', 'desc', 'draft', 'user_id', 'slug')->get();
    }


    public function map($blog): array
    {
        return [
          $blog->id,
          $blog->title,
          $blog->caption,
          $blog->desc,
          $blog->draft,
          showDate($blog->created_at),
          $blog->user_id,
          $blog->slug
        ];
    }

    public function headings(): array
    {
        return [
          '#',
          'Title',
          'Caption',
          'Desc',
          'Draft',
          'Created at',
          'User id',
          'Slug'
        ];
    }

}
