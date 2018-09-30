@extends('layouts.app')

@section('title', 'Basuketto')

@section('content')

  @if(Auth::check()) 
    <p>tet</p>
  @endif

 

      {{---------------------------------------------------------------------------------------------------------------}}

       <div class="_column">
        <div class="_has_large_padding _back_gray">

         {{-- search --}}
          <div class="_field">
            <form id="_submit_search" action="{{ route('blog.and.product.search') }}" method="get">
              <input type="search" name="search">
        
               <div class="_is_left">
                <a onclick="event.preventDefault(); document.getElementById('_submit_search').submit()" class="_has_range_top" href="#"> <i class="_search _button"></i> </a>
               </div>
                 
                 <div>
                 <a class="_text_gray" href="/"> All  </a>
                 </div>
                 Filter Product Category : 
                @foreach ($categories as $category) /
                 <a class="_text_gray" href="{{ route('product.filter', $category['name']) }}"> {{ $category['name'] }} </a>      
                @endforeach 
                <div>
                 Filter Blog Category :
                 @foreach ($tags as $tag) /
                  <a class="_text_gray" href="{{ route('blog.filter', $tag['name']) }}"> {{ $tag['name'] }} </a>    
                 @endforeach 
                </div>
            </form>
          </div>

          {{----------------------------------------------------------------------------------------------------}}

          {{-- <div class="_slick" style="max-width: 500px;">
            @foreach ($products as $product)
             <div style="position: relative;">
              <img  style="height: 100px;" src="{{ asset('storage/products/images/'. $product->img )}}" alt=" {{ $product->name }}" />
              <p style="margin-top: 8px;">{{ $product->name }}</p>
             </div>
             @endforeach
             </div> --}}
           
          {{-----------------------------------------------------------------------------------------------------}}

            <h2> All Products </h2>
            <hr>

             @forelse ($products->chunk(4) as $chunk)
             <div class="_columns _is_multiline">
              @foreach ($chunk as $product)
                <div class="_column _is_one_quarter">

                  <div class="_products">
                      <img src="{{ asset('storage/products/images/'. $product['img']) }}" alt="{{ $product['name'] }}">
                      
                      <div class="_products_wrapper_price">
                        <img class="_products_img_price" src="{{ asset('/assets/icon/board-price.jpg')}}">
                        <p class="_products_desc_price"> {{ money($product['price'], 'IDR') }}</p>
                      </div> <br>

                      <h1 class="_products_name"> {{ title_case($product['name']) }} </h1> <br> 
                  
                      <span class="_products_users_username"> Owner :  {{ $product['user']['username'] }} </span> <br> <br>
                      <span class="_products_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at']))  }} </span> <br> <br>
                    
                      @foreach ($product->categories as $category)
                      <span class="_products_categories"> {{ $category['name'] }} </span> <br> <br>
                      @endforeach 

                      <p class="_products_desc"> {{ $product['desc'] }} </p> <br>

                      <a class="_button _products_add_to_cart" href="{{ route('cart.add', $product['id']) }}"> add to cart </a> <br> <br> 
                  
                    @auth
                    @if(Auth::user()->id === $product['user']['id'])
                      <a class="_button _products_edit" href="{{ route('product.edit', $product['id']) }}" target="_blank" href="#!">edit</a> <br> <br> 
                  
                      <form class="_form_products_delete" action="{{ route('product.update', $product['id']) }}" method="post">
                        {{-- CSRF --}}
                        @csrf

                        {{-- METHOD_FIELD --}}
                        {{ method_field('DELETE') }}
                      </form>

                      <a onclick="event.preventDefault(); document.getElementsByClassName('_form_products_delete').submit();" class="_button _products_delete" href="#!"> Delete</a> <br> <br>
                    @endif
                   @endauth
                    
                    </div>

                   </div>
                  @endforeach 
                 </div>
                @empty
              @endforelse

           {{ $products->links() }}

        {{-----------------------------------------------------------------------------------}}

          <h2> All Blogs </h2>
          <hr>
         
          <div class="_columns _is_multiline">
            @forelse ($blogs->chunk(4) as $chunk)
              @foreach ($chunk as $blog)
                <div class="_column _is_one_quarter">

                 <div class="_blogs_homepage">
                   <h2 class="_blogs_homepage_title"> {{ $blog['title'] }}</h2>
                   <br>
                    @foreach ($blog->tags as $tag)
                     <span class="_blogs_homepage_tags"> {{  $tag['name'] }} </span>
                    @endforeach 
                    <br> <br>
                   <span class="_blogs_homepage_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }}</span>
                    <br> <br>
                   <span class="_blogs_homepage_author"> Author : {{ $blog['user']['username'] }}</span> <br> <br>
                   <img src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
                   <br>      
                   <a class="_button" target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> Read more </a>
                 </div>
                
               </div>
              @endforeach
              @empty
              <div> 
                @auth
                 <br>
                  there are no blogs found    
                 <br>
                 <a class="_button" style="margin-top: 9px;" target="_blank" href="{{ route('blog.create') }}">  create a blog </a>
                @endauth
              </div>
                    @endforelse
          </div> {{-- end of BLOG --}}

          {{ $blogs->links() }}

        </div> {{-- end of BACKGROUND GRAY --}}

        {{-----------------------------------------------------------}}

        {{-- FOOTER --}}
         <div class="_footer">
            <p>
              Community to every writter and a merchantman.
            </p>
           <p> &copy; Basuketto {{ date('Y') }} </p>
         </div> 

       </div> {{-- end of COLUMN --}}

  </div> 
</div>

@endsection
