@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="columns is-center">
      <div class="column is-half">

        <h2> Checkout </h2>
        <hr>

        <form  action="" method="post" id="payment-form">
         @csrf
        <label for="email"> E-mail Address </label>
        <input id="email" type="text" name="email" value="{{ old('email') }}">

        <label for="name"> Name </label>
        <input id="name" type="text" name="name" value="{{ old('name') }}">

        <label for="address"> Address </label>
        <input id="address" type="password" name="password" value="{{ old('address') }}">

        <label for="city"> City </label>
        <input id="city" type="text" name="city" value="{{ old('city') }}">

        <label for="postal"> Postal Code </label>
        <input type="text" name="city" value="{{ old('psot') }}">

        <label for="city"> Province </label>
        <input id="city" type="text" name="city" value="{{ old('city') }}">

        <label for="phone"> Phone </label>
        <input type="number" name="phone" value="{{ old('phone') }}">

        <div class="form-row">
          <label for="card-element">
            <h2> Credit or Debit Card </h2>
          </label> <br>
          <div id="card-element"></div>

          <div id="card-errors" role="alert"></div>
         </div> <br>

          <input class="button" type="submit" value="Submit">
          <a class="button" href="{{ route('app.index') }}"> Back </a>
        </form>

    </div>
   </div>
  </div>
@endsection

@section('js')
  <script>

  const stripeTokenHandler = (token) => {
  const form = document.getElementById('payment-form');
  const hiddenInput = document.createElement('input');

  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);

  form.appendChild(hiddenInput);
  form.submit();
  }

  const form = document.getElementById('payment-form');

  form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {

    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;

  } else {

    stripeTokenHandler(token);

  }

  });

  var stripe = Stripe('pk_test_eHjYcVRuQR81p6O1lInHlVXc');

  var elements = stripe.elements();

  var style = {
    base: {
      color: '#32325d',
      lineHeight: '18px',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      },
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  var card = elements.create('card', {style: style});

  card.mount('#card-element');

</script>
@endsection
