@extends('layouts.app')

@section('content')
  <div class="_container">
   <div class="_columns">
    <div class="_column _is_two_thirds">

        <table id="_table_cart">

         <thead>
          <tr>
            <th>Qty</th>
            <th>Name</th>
            <th>Price</th>
            <th></th>
           </tr>
          </thead> 

         <tbody>

           @forelse ($carts as $cart)
            <tr>
             <td>
               {{-- EDIT QUANTITY --}}
               <form action="{{ route('cart.update', $cart->rowId) }}" method="post">
                @csrf
                {{ method_field('PUT')}}
                <input type="number" name="qty" value="{{ $cart->qty }}" style="width: 30px; text-align: center;">
                <input class="_button _has_range_top" type="submit" value="Ok">
              </form>
             </td>

            <td>{{ $cart->name }}</td>
            <td>{{ money($cart->price, 'USD') }}</td>
            <td><img src="{{ asset('storage/products/images/'. $cart->options->image  ) }}" style="width: 100px;"> </td>
            <td>
              {{-- DELETE cART --}}
              <form action="{{ route('cart.destroy', $cart->rowId) }}" method="post">
               @csrf
               {{ method_field('DELETE')}}
               <input class="_button" type="submit" value="X">
             </form>
            </td>
          </tr>

          <tr>
            <td> </td>
            <td> </td>
            <td></td>

            <td>
              <div class="_is_right">
                <a href="/address" class="_button"> Checkout </a>
                  {{--- CART SAVE FOR LATER  --}}
                  <form id="saveForLater" action="{{ route('cart.ToSaveForLater', $cart->rowId) }}" method="post">
                    @csrf
                   <input type="hidden" name="img" value="{{ $cart->options->image }}">
                  </form>
                <a onclick="event.preventDefault(); document.getElementById('saveForLater').submit();" href="#!" class="_button _has_range_left"> Save for Later </a>
                <a href="{{ route('user.profile') }}" class="_button _has_range_left"> Back </a>
              </div>
            </td>

            <td></td>
          </tr>
           @empty
           <span class="_text_gray"> No items in Cart </span>
           <a class="_button _has_range_bottom" href="/profile"> Continue Shopping </a>
          @endforelse {{--  END FOREACH CART --}}
          <tr>
            <td> items {{ Cart::count() }}</td>
            <td></td>
            <td>
              <div> Tax : {{ money(Cart::tax(), 'USD') }} </div>
              <div class="_has_range_top"> Sub Total : {{ money(Cart::subtotal(), 'USD') }} </div>
              <div class="_has_range_top"> Grand Total : {{ money(Cart::total(), 'USD') }} </div>
            </td>
            <td></td>
            <td></td>
          </tr>
         </tbody>

         </table>
        
       @if (Cart::instance('saveForLater')->count() > 0)

         {{-- WISHLIST --}}

        <div class="_columns">
          <div class="_column _is_one_quarter">

            <h2 class="_text_gray _has_range_bottom"> Wishlist </h2>

            <table id="_table_cart">
        
              <thead>
                <tr>
                  <th>Qty</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                @foreach (Cart::instance('saveForLater')->content() as $cart)
                <tr>
                  <td>{{ $cart->qty }}</td>
                  <td>{{ $cart->name }}</td>
                  <td>{{ $cart->price }}</td>
                  <td><img src="{{ asset('storage/products/images/'. $cart->options->image) }}" style="width: 100px;"></td>
                  <td> {{-- Delete CART Save For Later --}}
                  <form id="destroySaveForLater" action="/emptySaveForLater" method="get">
                    @csrf
                  </form>
                  <a onclick="event.preventDefault(); document.getElementById('destroySaveForLater').submit();" href="#!" class="_button"> x </a></td>
                </tr>
                @endforeach
                
                <tr>
                  <td></td> 
                  <td></td> 
                  <td></td>
                  <td><a href="#!" class="_button"> Move to Cart </a></td>  
                  <td>
                  
                  </td>  
                </tr>
              </tbody>

            </table>

           </div>
         </div>

        @else

        @endif


    </div> {{-- end column --}}
  </div> {{-- end columns --}}
</div> {{-- end container --}}
@endsection
