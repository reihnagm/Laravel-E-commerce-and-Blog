@extends('layouts.app')

@section('content')
  <div class="_container">
    <div class="_columns _is_center">
      <div class="_column _is_half">

        <form action="{{ route('payment.store') }}" method="post" id="payment-form">
          @csrf
        <div class="form-row">
          <label for="card-element">
            <h2> Credit or debit card </h2>  
          </label> <br>
          <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
          </div>

             <!-- Used to display form errors. -->
             <div id="card-errors" role="alert"></div>
          </div> <br>
          <input class="_button" type="submit" value="Submit">
        </form>

    </div>
   </div>
  </div>
@endsection

@section('js')
  <script>

  const stripeTokenHandler = (token) => {
  // Insert the token ID into the form so it gets submitted to the server
  const form = document.getElementById('payment-form');
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
  }

  // Create a token or display an error when the form is submitted.
  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {
    // Inform the customer that there was an error.
    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(token);
  }
  });

  // Create a Stripe client.
  var stripe = Stripe('pk_test_eHjYcVRuQR81p6O1lInHlVXc');

  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
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

  // Create an instance of the card Element.
  var card = elements.create('card', {style: style});

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  </script>
@endsection
