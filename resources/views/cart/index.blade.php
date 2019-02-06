@extends('layouts.app')

@section('content')
  <div class="container">
   <div class="columns">
    <div class="column is-two-thirds">

        <table id="table-cart">
         <thead>
          <tr>
            <th>Qty</th>
            <th>Name</th>
            <th>Price</th>
            <th>Desc</th>
            <th>Image</th>
            <th></th>
           </tr>
          </thead>

         <tbody>
          @forelse ($carts as $cart)
           @if(Auth::check())
            <tr>
             <td>
               <form action="{{ route('cart.update', $cart->rowId) }}" method="post">
                @csrf
                {{ method_field('PUT')}}
				<div class="field">
					<input type="number" name="qty" value="{{ $cart->qty }}"> <br> <br>
				</div>
                <input class="button" type="submit" value="Ok">
               </form>
             </td>

            <td>{{ $cart->name }}</td>
            <td>{{ dollarPrice(Cart::subtotal()) }}</td>
			<td>{!! $cart->options->desc !!} </td>
			 <td><img src="{{  showImage($cart->options->image) }}"></td>
            <td>
              <form action="{{ route('cart.destroy', $cart->rowId) }}" method="post">
               @csrf
               {{ method_field('DELETE')}}
               <input class="button" type="submit" value="X">
             </form>
            </td>
			 
           </tr>

           <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td>
              <div class="is-right">
                <form id="saveForLater" action="{{ route('cart.saveForLater', $cart->rowId) }}" method="post">
                  @csrf
                  <input type="hidden" name="img" value="{{ $cart->options->image }}">
                </form>
                <a class="button" href="#!" onclick="event.preventDefault(); document.getElementById('saveForLater').submit();"> Save for Later </a> &nbsp;
                <a href="{{ route('checkout.index') }}" class="button"> Checkout </a> &nbsp;
                <a href="{{ route('user.profile') }}" class="button"> Back </a>
              </div>
            </td>
            <td></td>
          </tr>
           @endif
            @empty
             <span> No items in Cart </span>
             <a class="button" href="/profile"> Continue Shopping </a> <br> <br>
            @endforelse

            @if(Auth::guest())
              <tr>
                <td> items 0 </td>
                <td> </td>
                <td>
                  <div> Tax (13%) 0.000 </div> <br>
                  <div> Sub Total 0.000 </div> <br>
                  <div> Total 0.000  </div> <br>
                </td>
                <td> </td>
                <td> </td>
              </tr>
            @endif

         </tbody>
        </table>
      </div>
    </div>

       {{-- WISHLIST --}}

       @if (Cart::instance('saveForLater')->count() > 0)

         <div class="columns">
          <div class="column is-two-thirds">

            <h2> Wishlist </h2> <br>

            <table id="table-cart">

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
                  <td><img src="{{ asset('/storage/'. $cart->options->image) }}"></td>
                  <td>
                    <form id="destroySaveForLater" action="emptySaveForLater" method="get"></form>
                    <a class="button" href="#!" onclick="event.preventDefault(); document.getElementById('destroySaveForLater').submit();"> x </a> <br> <br>
                    <form class="moveToCart" action="{{ route('move.to.cart', $cart->rowId) }}" method="post">
                     @csrf
                     <input type="hidden" name="img" value="{{ $cart->options->image }}">
                     </form>
                    <a class="button" href="#!" onclick="event.preventDefault(); document.getElementsByClassName('moveToCart')[0].submit();"> Move to Cart </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              
            </table>

           </div>
         </div>

        @else

        @endif

</div>
@endsection
