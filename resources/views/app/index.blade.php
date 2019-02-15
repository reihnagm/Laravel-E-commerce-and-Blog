@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">
    <div class="column is-one-quarter">

      @include('_includes/menu_user_mobile')
      @include('_includes/menu_user_index')

      <div class="home-page column">

        <div class="field clearfix">
          <form id="search" action="{{ route('blog.and.product.search') }}" method="get">
            <input class="search" type="search" name="search">
            <a onclick="event.preventDefault(); document.getElementById('search').submit()" href="#!"> <i class="search-icon button"></i> </a>
            <div class="container-categories">
              Filter All :<a href="/"> All </a> <br>
              Filter Product Category :
              @foreach ($categories as $category) /
              <a href="{{ route('product.filter', $category['name']) }}"> {{ $category['name'] }} </a>
              @endforeach
              <div>
                Filter Blog Category :
                @foreach ($tags as $tag) /
                <a href="{{ route('blog.filter', $tag['name']) }}"> {{ $tag['name'] }} </a>
                @endforeach
              </div>
            </div>
          </form>
        </div>

        {{-- PRODUCTS --}}
        <h2> All Products </h2>

        <hr>

        @forelse ($products->chunk(4) as $chunk)
        <div class="columns is-multiline">
          @foreach ($chunk as $product)
          <div class="column is-one-quarter">

            <div class="products">
              <img src="{{ showImage($product['img']) }}" alt="{!! $product['name'] !!}">

              <div class="products-wrapper-price">
                <p class="products-desc-price">
                  @foreach(\App\Models\Currency::all() as $currency)

                  @if($currency['name'] == 'USD' && $currency['active'] == 1)
                  $ {{ dollarPrice($product['price']) }}
                  @elseif($currency['name'] == 'IDR' && $currency['active'] == 1)
                  Rp. {{ changeToIdr($product['price']) }}
                  @endif

                  @endforeach
                </p>
              </div>

              <h1 class="products-name"> {!! title_case($product['name']) !!} </h1>
              <span class="products-users-username"> Owner : <a href="{{ route('user.profile', $product['user']['slug']) }}"> {{ $product['user']['slug'] }} </a> </span>
              <span class="products-date"> {{ showDate($product['created_at'])  }} </span>

              @foreach ($product->category as $category)
              <span class="products-categories"> {{ $category['name'] }} </span>
              @endforeach

              <div class="products-desc"> {!! $product['desc'] !!} </div>

              <form class="cart-add" action="{{ route('cart.add')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $product['id']}}">
                <input type="hidden" name="name" value="{{ $product['name']}}">
                <input type="hidden" name="desc" value="{{ $product['desc']}}">
                <input type="hidden" name="price" value="{{ $product['price']}}">
                <input type="hidden" name="img" value="{{ $product['img']}}">
                <input class="button products-add-to-cart" type="submit" value="Add To Cart"> <br> <br>
              </form>

              @if(Auth::check())
              @if(Auth::user()->id === $product['user']['id'])
                <a class="button products-edit" target="_blank" href="{{ route('product.edit', $product['slug']) }}">Edit</a>
                <form action="{{ route('product.destroy', $product['slug']) }}" method="post">
                  @csrf

                  {{ method_field('DELETE') }}

                  <input class="button products-delete" type="submit" value="Delete">
                </form> <br>
                @endif
                @endif

            </div>

          </div>
          @endforeach
        </div>
        @empty
        <p> Products is empty </p>
        @endforelse

        {{ $products->links() }}
        <br>

        <h2> All Blogs </h2>

        <hr>

        @forelse ($blogs->chunk(4) as $chunk)
        <div class="columns is-multiline">
          @foreach ($chunk as $blog)
          <div class="column is-one-quarter">

            <div class="blogs-homepage">
              <h2 class="blogs-homepage-title"> {!! $blog['title'] !!}</h2>

              @foreach ($blog->tags as $tag)
              <span class="blogs-homepage-tags"> {{ $tag['name'] }} </span>
              @endforeach

              <span class="blogs-homepage-date"> {{ showDate($blog['created_at']) }} </span>

            <span class="blogs-homepage-author"> Author : <a href="{{ route('user.profile', $blog['user']['slug']) }}"> {!! $blog['user']['name'] !!} </a></span>

              <img src="{{ showImage($blog['img']) }}" alt="{!! $blog['title'] !!}">

              <br>
              <a class="button" target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> Read more </a>
            </div>

          </div>
          @endforeach
          @empty
          <p> Blogs is empty </p>
        </div>
        @endforelse

        <div>
          {{ $blogs->links() }}
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
