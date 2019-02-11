<?php

use Illuminate\Database\Seeder;

use App\Models\Product;

use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;

class ProductTableSeeder extends Seeder
{

    public function run()
    {

       for ($i=1; $i <= 30; $i++) {
            Product::create([
            'name' => 'products '.$i,
            'slug' => 'products-'.$i,
            'price' => 5.00,
            'desc' =>'Lorem '. $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'img' => 'products/dummy/shoes.jpg',
            'user_id' => 1,
        ])->category()->sync([1]);

    }

  }

}
