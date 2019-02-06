<header class="header">
  <div class="container">
    <img class="logo-header" src="{{ asset('assets/logo/logo.png') }}" alt="Logo Basuketto">

    @php
      $currency = \App\Models\Currency::first();
    @endphp

    <div class="clearfix">
      <form action="/switch/id?" method="get" style="width: 48%; margin-bottom: 2%; float: right;">
        <label for="change-currency"> Change Currency : </label>
        <select id="change-currency" class="prices" name="switch_currency" onchange="this.form.submit();">
          <option value="USD" @if($currency['active']) selected @endif> USD </option>
          <option value="IDR" @if($currency['active']) selected @endif> IDR </option>
        </select>
      </form>
    </div>

  </div>
</header>