<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Currency;

class CurrencyController extends Controller
{
    public function switch(Request $request)
    {
        if (isset($_GET['switch-currency'])) {
            switch ($_GET['switch-currency']) {

                case 'IDR':
                    $this->changeToIdr();
                break;
                case 'USD':
                    $this->changeToUsd();
                break;

            }
        }

        return back();
    }

    protected function changeToIdr()
    {
        Currency::where('name', 'IDR')->where('active', 0)->update(['active' => 1]);
        Currency::where('name', 'USD')->where('active', 1)->update(['active' => 0]);
    }

    protected function changeToUsd()
    {
        Currency::where('name', 'IDR')->where('active', 1)->update(['active' => 0]);
        Currency::where('name', 'USD')->where('active', 0)->update(['active' => 1]);
    }
}
