@extends('layouts.app')

@section('content')

<div class="_container">

    <div class="_column _is_fullWidth">
     <div class="_header_admin">            
     </div>      
    </div>

    {{----------------------------------------------------------}}
    
      <div class="_columns _is_multiline">
        <div class="_column _is_one_quarter">
           <ul id="_menu_admin">
            <li>
              <div class="_wrapper_menu_admin">
               <a href="">Dashboard </a>      
               <i id="_dashboard"></i>      
              </div>
            </li>
             <li>
              <div class="_wrapper_menu_admin">
                <a href="">Product </a>      
                <i id="_product"></i>      
              </div>
             </li>
              <li>
              <div class="_wrapper_menu_admin">
                <a href="{{ route('admin.logout') }} "> Logout </a>      
                <i id="_logout"></i>      
              </div>
             </li>
           </ul>
          </div> {{-- end of COLUMN --}}

     {{----------------------------------------------------------}}

          <div class="_column">
           
         </div> {{-- end of COLUMN --}}
         
     </div> {{-- end of COLUMNS --}}

</div>

@endsection
