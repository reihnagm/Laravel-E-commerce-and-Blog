<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;

use PDF;
use Excel;
use URL;

use App\Exports\UsersExport;
use App\Exports\BlogsExport;
use App\Exports\ProductsExport;
use App\Exports\OrdersExport;

use App\Models\User;
use App\Models\Export;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class ExportController extends Controller
{
    use BreadRelationshipParser;

    public function selectExport()
    {

        if (isset($_GET['select-export'])) {
            switch ($_GET['select-export']) {
            case '0':
            $this->changeToExcel();
            break;
            case '1':
            $this->changeToPdf();
            break;
            case '2':
            $this->changeToCsv();
            break;
          }
        }

        return back();

    }


    public function index(Request $request)
    {
        return view('export.index');
    }

    public function changeToExcel()
    {
      Export::where('type', 'EXCEL')->where('active', 0)->update(['active' => 1]);
      Export::where('type', 'PDF')->where('active', 1)->update(['active' => 0]);
      Export::where('type', 'CSV')->where('active', 1)->update(['active' => 0]);
    }

    public function changeToPdf()
    {
      Export::where('type', 'EXCEL')->where('active', 1)->update(['active' => 0]);
      Export::where('type', 'PDF')->where('active', 0)->update(['active' => 1]);
      Export::where('type', 'CSV')->where('active', 1)->update(['active' => 0]);
    }

    public function changeToCsv()
    {
      Export::where('type', 'EXCEL')->where('active', 1)->update(['active' => 0]);
      Export::where('type', 'PDF')->where('active', 1)->update(['active' => 0]);
      Export::where('type', 'CSV')->where('active', 0)->update(['active' => 1]);
    }

    // EXCEL

    public function usersDownloadExcel() {
      return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function blogsDownloadExcel() {
      return Excel::download(new BlogsExport, 'blogs.xlsx');
    }

    public function productsDownloadExcel() {
      return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function ordersDownloadExcel() {
      return Excel::download(new OrdersExport, 'orders.xlsx');
    }


    // PDF

    public function usersDownloadPdf() {
      return PDF::loadView('pdf/users')-> download('users.pdf');
    }

    public function blogsDownloadPdf() {
      return PDF::loadView('pdf/blogs')-> download('blogs.pdf');
    }

    public function productsDownloadPdf() {
      return PDF::loadView('pdf/products')-> download('products.pdf');
    }

    public function ordersDownloadPdf() {
      return PDF::loadView('pdf/orders')-> download('orders.pdf');
    }

    // CSV

    public function usersDownloadCsv() {
      return Excel::download(new UsersExport, 'users.csv');
    }

    public function blogsDownloadCsv() {
      return Excel::download(new BlogsExport, 'blogs.csv');
    }

    public function productsDownloadCsv() {
      return Excel::download(new ProductsExport, 'products.csv');
    }

    public function ordersDownloadCsv() {
      return Excel::download(new OrdersExport, 'orders.csv');
    }


}
