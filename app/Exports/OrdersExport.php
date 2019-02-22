<?php

namespace App\Exports;

use App\Models\Order;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\Exportable;

class OrdersExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

    public function collection() {
      return Order::select('id', 'name', 'desc', 'price', 'created_at','user_id','slug')->get();
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

    public function map($order): array
    {
        return [
          $order->id,
          $order->billing_email,
          $order->billing_name,
          $order->billing_address,
          $order->billing_city,
          $order->billing_province,
          $order->billing_postalcode,
          $order->billing_phone,
          $order->billing_name_on_card,
          $order->billing_discount,
          $order->billing_discount_code,
          $order->billing_subtotal,
          $order->billing_tax,
          $order->billing_total,
          $order->payment_gateway,
          $order->shipped,
          $order->created_at,
          $order->user_id,
          $order->slug
          // Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
          '#',
          'Email',
          'Name',
          'Address',
          'City',
          'Province',
          'Postal Code',
          'Phone',
          'Name on Card',
          'Discount',
          'Discont Code',
          'Sub Total',
          'Tax',
          'Total',
          'Payment Gateway',
          'Shipped',
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
