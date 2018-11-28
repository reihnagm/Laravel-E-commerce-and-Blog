@extends('layouts.app')

@section('content')
    
<div class="_container">

  

    {{-----------------------ADMIN MENU-----------------------------------}}

      <div class="_columns _is_multiline">
        <div class="_column _is_one_quarter">
           <ul class="_menu_admin">
            <li>
              <div class="_wrapper_menu_admin">
               <a href="">Dashboard </a>      
               <i class="_admin_ico _dashboard_ico"></i>      
              </div>
            </li>
             <li>
              <div class="_wrapper_menu_admin">
                <a href="">Products </a>      
                <i class="_admin_ico _product_ico"></i>      
              </div>
             </li>
             <li>
              <div class="_wrapper_menu_admin">
                <a href="">Orders </a>      
                <i class="_admin_ico _order_ico"></i>      
              </div>
             </li>
             <li>
              <div class="_wrapper_menu_admin">
                <a href="{{ route('admin.logout') }} "> Logout </a>      
                <i class="_admin_ico _logout_ico"></i>      
              </div>
             </li>
           </ul>
          </div> 
     {{-----------------------------ORDERS-----------------------------}}

          <div class="_column">
            <a href="/admin/orders"> All Orders </a>  /
            <a href="/admin/orders/pending"> Pending Orders </a>  /
            <a href="/admin/orders/delivered"> Delivered Orders </a>
            <br> <br>
            <table>
             <thead>
                <tr>                    
                    <th> Name Product </th>
                    <th> Qty </th>
                    <th> Price </th>
                    <th> Order By </th>
                    <th> Total Price </th>
                    <th> Status </th>
                </tr>
             </thead>
            
                <tr>
             @forelse ($orders as $order)
             
               <tbody>  
                <tr>               
                    @foreach ($order->products as $item)
                    <td> {{ $item['name'] }} </td>
                    <td> {{ $item['pivot']['qty'] }}</td>
                    <td> {{ $item['pivot']['total'] }}</td>
                    <td> {{ $order['user']['username'] }} </td> 
                    <td> {{ $order['total'] }} </td>
                    <td>
                        <form action="{{ route('toggle.deliver', $order['id']) }} " method="post">
                            @csrf
                            {{--  CSRF  --}}
                            <label for="toggle-delivered"> Delivered </label>
                            <input id="toggle-delivered" type="checkbox" name="delivered" value="1" {{  $order->delivered == 1 ? "checked" : "" }}>
                            <input type="submit" value="Submit">
                        </form>
                    </td>
               
                    @endforeach
               
                </tr>
               </tbody>
            
                @empty
                   <p> No Orders Found. </p>
                   <br>
                @endforelse
             </tr>
            
            </table>
         </div> 

      </div>

</div>
@endsection