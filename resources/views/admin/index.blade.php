@extends('layouts.app')

@section('content')

<div class="_container">

    <div class="_column _is_fullWidth">
     <div class="_header_admin">      
     </div>      
    </div>

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
                <a href="/admin/orders">Transaction</a>      
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
     {{----------------------------------------------------------}}

          <div class="_column">
           
         </div> {{-- end of COLUMN --}}
         
     </div> {{-- end of COLUMNS --}}

</div>

@endsection
