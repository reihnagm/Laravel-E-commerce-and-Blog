@extends('layouts.app')

@section('css')

<style>
  #card-errors {
    display: none;
    margin-top: 5%;
  }
</style>

@endsection

@section('content')

<div class="columns">
  <div class="column is-one-quarter">
    <hr>
    <h3>Checkout</h3>
    <hr>
    <br>
    <h4> Billing Details </h4>
    <br>
    <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
      @csrf

      <div class="field">

        @if (Auth::check())
        <input id="email" type="email" name="email" value="" placeholder="E-mail Address" value="{{ auth()->user()->email }}">
        @else
        <input id="email" type="email" name="email" value="" placeholder="E-mail Address" value="{{ old('email') }}">
        @endif


        @if($errors->has('email'))
          <span class="is-error"> {!! $errors->first('email') !!} </span>
          @endif

          <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}">

          @if($errors->has('name'))
            <span class="is-error"> {{ $errors->first('name') }} </span>
            @endif

            <input id="address" type="text" name="address" placeholder="Address" value="{{ old('address')}}">

            @if($errors->has('address'))
              <span class="is-error"> {{ $errors->first('address') }} </span>
              @endif


              <div class="columns">
                <div class="column-form">
                  <input id="city" type="text" name="city" placeholder="City" value="{{ old('city') }}">

                  @if($errors->has('city'))
                    <span class="is-error"> {{ $errors->first('city') }} </span>
                    @endif
                </div>
                <div class="column-form">
                  <input id="province" type="text" name="province" placeholder="Province" value="{{ old('province') }}">

                  @if($errors->has('province'))
                    <span class="is-error"> {{ $errors->first('province') }} </span>
                    @endif
                </div>
              </div>

              <div class="columns">
                <div class="column-form">
                  <input id="phone" type="text" name="phone" placeholder="Phone" value="{{ old('show')}}">

                  @if($errors->has('phone'))
                    <span class="is-error"> {{ $errors->first('phone') }} </span>
                    @endif
                </div>
                <div class="column-form">
                  <input id="postalcode" type="text" name="postalcode" placeholder="Postal Code" value="{{ old('postalcode') }}">

                  @if($errors->has('postalcode'))
                    <span class="is-error"> {{ $errors->first('postalcode') }} </span>
                    @endif
                </div>
              </div>

              <input type="hidden" name="stripeToken">

      </div>

      <div class="columns">
        <div class="column-form">
          <hr>
          <h3>Payment Details</h3>
          <hr>
          <div class="field">
            <input type="text" id="name_on_card" name="name_on_card" placeholder="Name on card"> <br>
            <br>
            <h3> Credit or Debit Card </h3>
            <br>
            <br>
            <div id="card-element"> </div>
            <div id="card-errors" class="is-error"> </div>
          </div>
          <br>
          <button id="complete-order" class="button"> Complete Order </button>
        </div>
      </div>

    </form>
    <br>
    <div> or </div>
    <br>


    @if ($paypalToken)
    <h2>Pay with PayPal</h2>

    <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
      @csrf
      <section>
        <div class="bt-drop-in-wrapper">
          <div id="bt-dropin"></div>
        </div>
      </section>

      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <button class="button" type="submit"> Pay with PayPal </button>
    </form>
    @endif



  </div>

  <div class="column">
    <hr>
    <h3> Your Order </h3>
    <hr>

    <table id="table-cart">
      <thead>
        <tr>
          <th>Qty</th>
          <th>Name</th>
          <th>Price</th>
          <th>Desc</th>
          <th>Image</th>
        </tr>
      </thead>

      <tbody>
        @forelse(Cart::instance('default')->content() as $cart)
        @if(Auth::check())
        <tr>

          <td>
            <form action="{{ route('cart.update', $cart->rowId) }}" method="post">
              @csrf
              {{ method_field('PUT')}}
              <input type="number" name="qty" value="{{ $cart->qty }}"> <br> <br>
              <input class="button" type="submit" value="Ok">
            </form>
            <br> <br>
          </td>

          <td> {{ $cart->name }} </td>
          <td>

            @if(session()->has('coupon'))
              <span> Discount ({{ session()->get('coupon')['name'] }}) {{ $discount }} </span>
              <form action="{{ route('coupon.destroy') }}" method="post" style="display:inline;">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" value="x">
              </form>
              <br>
              <br>
              @foreach(\App\Models\Currency::all() as $currency)
              @if($currency['name'] == 'USD' && $currency['active'] == 1)
              <div> New Sub Total : $ {{ dollarPrice($newSubtotal) }} </div> <br>
              <div> New Tax: $ {{ dollarPrice($newTotal) }} </div>
              @elseif($currency['name'] == 'IDR' && $currency['active'] == 1)
              <div> New Sub Total : $ {{ changeToIdr($newSubtotal) }} </div> <br>
              <div> New Tax: Rp. {{ changeToIdr($newTotal) }} </div>
              @endif
              @endforeach
              <br>
              @endif

          </td>
          <td style="width: 150px; line-height: 30px;">{!! $cart->options->desc !!}</td>
          <td><img src="{{  showImage($cart->options->image) }}"></td>
          <td></td>
          <td>
            <form action="{{ route('cart.destroy', $cart->rowId) }}" method="post">
              @csrf
              {{ method_field('DELETE')}}
              <input class="button" type="submit" value="X">
            </form>
            <br>

            <div class="is-right">
              <form id="saveForLater" action="{{ route('cart.saveForLater', $cart->rowId) }}" method="post">
                @csrf
                <input type="hidden" name="img" value="{{ $cart->options->image }}">
              </form>
              <a class="button" href="#!" onclick="event.preventDefault(); document.getElementById('saveForLater').submit();"> Save for Later </a> &nbsp;

            </div>
          </td>
        </tr>

 
        <td>
          @if(!session()->has('coupon'))
            @if(count(Cart::instance('default')->content()))
            <h3> Have a Coupon? </h3>
            <form action="{{ route('coupon.store') }}" method="POST">
              @csrf
              <div class="field">
                <input type="text" name="coupon_code">
                <input type="submit" value="Apply">
              </div>
            </form>
            @endif
            @endif
        </td>
        <td> </td>
        <td>
          @foreach(\App\Models\Currency::all() as $currency)
          @if($currency['name'] == 'USD' && $currency['active'] == 1)
          <div> Tax : ({{ config('cart.tax') }}%) </div> <br>
          <div> Sub Total : $ {{ dollarPrice(Cart::instance('default')->subTotal()) }} </div> <br>
          <div> Total: $ {{ dollarPrice($newTotal) }} </div>
          @elseif($currency['name'] == 'IDR' && $currency['active'] == 1)
          <div> Tax : ({{ config('cart.tax') }}%) </div> <br>
          <div> Sub Total : Rp. {{ changeToIdr(Cart::instance('default')->subTotal()) }} </div> <br>
          <div> Total: Rp. {{ changeToIdr($newTotal) }} </div>
          @endif
          @endforeach
        </td>

        @endif
        @empty
        @if(Auth::check())
        <span> No items in Cart </span>
        <a class="button" href="{{ route('home') }}"> Continue Shopping </a> <br> <br>
        @endif
        @endforelse

        <tr>
          <td> </td>
          <td> </td>
          <td> </td>
          <td>
            @if(count(Cart::instance('default')->content()))
            <a href="{{ route('home') }}" class="button"> Back </a>
            @endif
          </td>
          <td></td>
        </tr>

        {{--------------------}}
        {{-- GUEST CHECKOUT --}}
        {{--------------------}}

        @forelse(Cart::instance('guest')->content() as $cart)
        @if(request()->is('guestCheckout'))
        <tr>

          <td>
            <form action="{{ route('cart.update', $cart->rowId) }}" method="post">
              @csrf
              {{ method_field('PUT')}}
              <input type="number" name="qty" value="{{ $cart->qty }}"> <br> <br>
              <input class="button" type="submit" value="Ok">
            </form>
            <br> <br>
          </td>

          <td> {{ $cart->name }} </td>
          <td>

            @if(session()->has('coupon'))
              <span> Discount ({{ session()->get('coupon')['name'] }}) {{ $guestDiscount }} </span>
              <form action="{{ route('coupon.destroy') }}" method="post" style="display:inline;">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" value="x">
              </form>
              <br>
              <br>
              @foreach(\App\Models\Currency::all() as $currency)
              @if($currency['name'] == 'USD' && $currency['active'] == 1)
              <div> New Sub Total : $ {{ dollarPrice($guestNewSubTotal) }} </div> <br>
              <div> New Tax: $ {{ dollarPrice($guestNewTotal) }} </div>
              @elseif($currency['name'] == 'IDR' && $currency['active'] == 1)
              <div> New Sub Total : $ {{ changeToIdr($guestNewSubTotal) }} </div> <br>
              <div> New Tax: Rp. {{ changeToIdr($guestNewTotal) }} </div>
              @endif
              @endforeach
              <br>
              @endif

          </td>
          <td style="width: 150px; line-height: 30px;">{!! $cart->options->desc !!}</td>
          <td><img src="{{  showImage($cart->options->image) }}"></td>
          <td></td>
          <td>
            <form action="{{ route('cart.destroy', $cart->rowId) }}" method="post">
              @csrf
              {{ method_field('DELETE')}}
              <input class="button" type="submit" value="X">
            </form>
            <br>

            <div class="is-right">
              <form id="saveForLater" action="{{ route('cart.saveForLater', $cart->rowId) }}" method="post">
                @csrf
                <input type="hidden" name="img" value="{{ $cart->options->image }}">
              </form>

            </div>
          </td>
        </tr>

        <td>
          @if(!session()->has('coupon'))
            @if(count(Cart::instance('guest')->content()))
            <h3> Have a Coupon? </h3>
            <form action="{{ route('coupon.store') }}" method="POST">
              @csrf
              <div class="field">
                <input type="text" name="coupon_code">
                <input type="submit" value="Apply">
              </div>
            </form>
            @endif
          
        </td>
        <td> </td>
        <td>
          @foreach(\App\Models\Currency::all() as $currency)
          @if($currency['name'] == 'USD' && $currency['active'] == 1)
          <div> Tax : ({{ config('cart.tax') }} %) </div> <br>
          <div> Sub Total : $ {{ dollarPrice(Cart::instance('guest')->subTotal()) }} </div> <br>
          <div> Total: $ {{ dollarPrice($guestNewTotal) }} </div>
          @elseif($currency['name'] == 'IDR' && $currency['active'] == 1)
          <div> Tax : ({{ config('cart.tax') }}%) </div> <br>
          <div> Sub Total : Rp. {{ changeToIdr(Cart::instance('guest')->subTotal()) }} </div> <br>
          <div> Total: Rp. {{ changeToIdr($guestNewTotal) }} </div>
          @endif
          @endforeach
        </td>
        @endif

        @endif
        @empty
        @if(Auth::guest())
        <span> No items in Cart </span>
        <a class="button" href="{{ route('home') }}"> Continue Shopping </a> <br> <br>
        @endif
        @endforelse
  
        <tr>
          <td> </td>
          <td> </td>
          <td> </td>
          <td>
            @if(count(Cart::instance('guest')->content()))
            <a href="{{ route('home') }}" class="button"> Back </a>
            @endif
          </td>
          <td></td>
        </tr>


        @if(Auth::guest() && Cart::instance('guest')->count() == 0)
        <tr>
          <td> </td>
          <td> </td>
          <td>
            <div> Tax (1%) 0.000 </div> <br>
            <div> Sub Total 0.000 </div> <br>
            <div> Total 0.000 </div> <br>
          </td>
          <td> </td>
          <td> </td>
        </tr>
        @endif

        @if(Auth::check() && Cart::instance('default')->count() == 0)
        <tr>
          <td> </td>
          <td> </td>
          <td>
            <div> Tax (1%) 0.000 </div> <br>
            <div> Sub Total 0.000 </div> <br>
            <div> Total 0.000 </div> <br>
          </td>
          <td> </td>
          <td> </td>
        </tr>
        @endif
        
      </tbody>

    </table>
  </div>


</div>

@endsection

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
  (function() {

    // STRIPE STUFF

    // CREATE A STRIPE CLIENT
    var stripe = Stripe('pk_test_LXRAmE3GEZwsjP7lPx55m8zn');

    // CREATE AN INSTANCE OF ELEMENTS
    var elements = stripe.elements();

    // CUSTOM STYLING CAN BE PASSED TO OPTIONS WHEN CREATING AN ELEMENT.
    // (NOTE THAT THIS DEMO USES A WIDER SET OF STYLES THAN THE GUIDE BELOW.)
    var style = {
      base: {
        color: 'rgba(54, 54, 54, 0.3)',
        lineHeight: '20px',
        fontFamily: 'serif',
        border: '1px solid rgba(37, 37, 37, 0.7)',
        fontSmoothing: 'serif',
        fontSize: '1rem',
        '::placeholder': {
          color: 'rgba(54, 54, 54, 0.3)'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
      }
    };

    // CREATE AN INSTANCE OF THE CARD ELEMENT
    var card = elements.create('card', {
      style: style,
      hidePostalCode: true,
    });

    // ADD AN INSTANCE OF THE CARD ELEMENT INTO THE `CARD-ELEMENT` <DIV>
    card.mount('#card-element');

    // HANDLE REAL-TIME VALIDATION ERRORS FROM THE CARD ELEMENT.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      console.log(displayError)
      if (event.error) {
        displayError.style.display = 'block';
        displayError.textContent = event.error.message;
      } else {
        displayError.style.display = 'none';
        displayError.textContent = '';
      }
    });

    // HANDLE FORM SUBMISSION
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      // DISABLE THE SUBMIT BUTTON TO PREVENT REPEATED CLICKS
      document.getElementById('complete-order').disabled = true;

      var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: document.getElementById('address').value,
        address_city: document.getElementById('city').value,
        address_state: document.getElementById('province').value,
        address_zip: document.getElementById('postalcode').value
      }

      stripe.createToken(card, options).then(function(result) {
        if (result.error) {
          // INFORM THE USER IF THERE WAS AN ERROR
          var errorElement = document.getElementById('card-errors');

          // ENABLE THE SUBMIT BUTTON
          document.getElementById('complete-order').disabled = false;
        } else {
          // SEND THE TOKEN TO YOUR SERVER
          stripeTokenHandler(result.token);
        }
      });

    });


    function stripeTokenHandler(token) {
      // INSERT THE TOKEN ID INTO THE FORM SO IT GETS SUBMITTED TO THE SERVER
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // SUBMIT THE FORM
      form.submit();
    }

    // PAYPAL STUFF
    var form = document.querySelector('#paypal-payment-form');
    var client_token = "{{ $paypalToken }}";

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      }
    }, function(createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }

      // REMOVE CREDIT CARD OPTION
      var elem = document.querySelector('.braintree-option__card');
      elem.parentNode.removeChild(elem);

      form.addEventListener('submit', function(event) {
        event.preventDefault();

        instance.requestPaymentMethod(function(err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }

          // ADD THE NONCE TO THE FORM AND SUBMIT
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });

  })();
</script>
@endsection
