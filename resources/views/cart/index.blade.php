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
           @auth
            <tr>
             <td>
               <form action="{{ route('cart.update', $cart->rowId) }}" method="post">
                @csrf
                 {{-- CSRF --}}
                {{ method_field('PUT')}}
                 {{-- METHOD_FIELD --}}

                <input type="number" name="qty" value="{{ $cart->qty }}" style="width: 30px;"> <br> <br>
                <input class="_button" type="submit" value="Ok">
              </form>
             </td>

            <td>{{ $cart->name }}</td>
            <td>Rp {{ $cart->options->money }}</td>
            <td><img src="{{ asset('storage/products/images/'. $cart->options->image) }}" width="100"></td>
            <td>
              <form action="{{ route('cart.destroy', $cart->rowId) }}" method="post">
               @csrf
               {{-- CSRF --}}
               {{ method_field('DELETE')}}
               {{-- METHOD_FIELD --}}

               <input class="_button" type="submit" value="X">
             </form>
            </td>
           </tr>

           <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td>
              <div class="_is_right">
                <form id="saveForLater" action="{{ route('cart.SaveForLater', $cart->rowId) }}" method="post">
                  @csrf
                  {{-- CSRF --}}
                  <input type="hidden" name="img" value="{{ $cart->options->image }}">
                </form>
                <a class="_button" href="#!" onclick="event.preventDefault(); document.getElementById('saveForLater').submit();"> Save for Later </a> &nbsp;
                <a href="{{ route('user.profile') }}" class="_button"> Back </a>
              </div>
            </td>
            <td></td>
          </tr>
           @endauth
            @empty
            @endforelse 
            @guest
            <span> No items in Cart </span>
            <a class="_button" href="/profile"> Continue Shopping </a> <br> <br>
            @endguest
            @auth
            <tr>
              <td> items {{ Cart::count() }}</td>
              <td></td>
              <td>
                <div> Tax (13%) Rp {{ Cart::tax() }} </div> <br>
                <div> Sub Total Rp {{ Cart::subtotal() }} </div> <br>
                <div> Total  Rp {{ Cart::total() }} </div> <br>
                <a href="{{ route('address.index') }}" class="_button"> Checkout </a> &nbsp;
              </td>
              <td></td>
              <td></td>
            </tr>
            @endauth
            @guest 
              <tr>
                <td> items 0</td>
                <td></td>
                <td>
                  <div> Tax (13%) Rp 0.000 </div> <br>
                  <div> Sub Total Rp 0.000 </div> <br>
                  <div> Total  Rp 0.000  </div> <br>
                  @auth
                  <a href="{{ route('address.index') }}" class="_button"> Checkout </a> &nbsp;
                  @endauth
                </td>
                <td></td>
                <td></td>
              </tr>
            @endguest
         
         </tbody>
        </table>

         {{----------------------------------------WISHLIST------------------------------------------------------------}}

        
       @if (Cart::instance('saveForLater')->count() > 0)

        <div class="_columns">
          <div class="_column">

            <h2> Wishlist </h2> <br>

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
                  <td>Rp {{ Cart::subtotal() }}</td>
                  <td><img src="{{ asset('storage/products/images/'. $cart->options->image) }}" width="100"></td>
                  <td> 
                    <form id="destroySaveForLater" action="emptySaveForLater" method="get"></form>
                    <a class="_button" href="#!" onclick="event.preventDefault(); document.getElementById('destroySaveForLater').submit();"> x </a> <br> <br>
                    <form class="moveToCart" action="{{ route('move.to.cart', $cart->rowId) }}" method="post">
                     @csrf 
                     {{-- CSRF --}}
                     <input type="hidden" name="img" value="{{ $cart->options->image }}">
                    </form>
                    <a class="_button" href="#!" onclick="event.preventDefault(); document.getElementsByClassName('moveToCart')[0].submit();"> Move to Cart </a>
                  </td>
                </tr>
                @endforeach
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
