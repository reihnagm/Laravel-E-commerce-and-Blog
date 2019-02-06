@extends('layouts.app')

@section('title', 'Basuketto | Order')

@section('content')
<div class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile', [
      "user" => request()->user()
      ])
      @include('_includes/menu_user_profile',[
      "user" => request()->user()
      ])
    </div>

  
   <div style="margin-top: 14.5%; height: 10%; overflow-x: scroll;">
    <table>
        <tr>
          <th>Email</th> 
          <th>Name</th>
          <th>Address</th>
          <th>City</th>
          <th>Province</th>
          <th>Postal Code</th>
          <th>Phone</th>
          <th>Name on Card</th>
          <th>Discount</th>
          <th>Discount Code</th>
          <th>Sub Total</th>
          <th>Tax</th>
          <th>Total</th>
          <th>Payment Gateway</th>
          <th>Shipped</th>
          <th>Date </th>
          <th>Date Updated </th>
          <th>User </th>
        </tr>
   
        @foreach($orders as $order)
       <tr>
        <td> {{ $order['billing_email']}}</td>
        <td> {{ $order['billing_name']}}</td>
        <td> {{ $order['billing_address']}}</td>
        <td> {{ $order['billing_city']}}</td>
        <td> {{ $order['billing_province']}}</td>
        <td> {{ $order['billing_postalcode']}}</td>
        <td> {{ $order['billing_phone']}}</td>
        <td> {{ $order['billing_name_on_card']}}</td>
        <td> {{ $order['billing_discount']}}</td>
        <td> {{ $order['billing_discount_code']}}</td>
        <td> {{ $order['billing_subtotal']}}</td>
        <td> {{ $order['billing_tax']}}</td>
        <td> {{ $order['billing_total']}}</td>
        <td> {{ $order['payment_gateway']}}</td>
        <td> {{ $order['shipped']}}</td>
        <td> {{ showDate($order['created_at']) }}</td>
        <td> {{ showDate($order['updated_at']) }}</td>
         @if($order['user']['name'] == null)
         <td> GUEST </td>
         @else 
         <td> {{ $order['user']['name'] }}</td>
         @endif   
        </tr>
         @endforeach
     </table>
    </div>


 </div>
</div>
@endsection