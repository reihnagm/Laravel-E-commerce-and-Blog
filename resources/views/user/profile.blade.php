@extends('layouts.app')

@section('author', 'Basuketto')

@section('description', 'Profile Basuketto')

@section('title', 'Basuketto | Profile')

@section('content')

<div class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile', [
      "user" => $user
      ])
      @include('_includes/menu_user_profile',[
      "user" => $user
      ])
    </div>

    {{-- PRODUCTS --}}

    <div class="columns is-multiline" style="margin-top: 11.2%;">

      <div style="width: 100%;">
        <h3> {{ strtoupper($user['name']) }} Product's </h3>
        <hr>
      </div>

      @forelse ($products->chunk(3) as $chunk)
       @foreach ($chunk as $product)

      <div class="column is-one-third">

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

          <span class="products-users-username"> Owner : {{ $user['name'] }} </span>
          <span class="products-date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at'] ))  }} </span>

          @foreach ($product->category as $category)
          <span class="products-categories"> {{ $category['name'] }} </span>
          @endforeach

          <div class="products-desc"> {!! $product['desc'] !!} </div>

          <form class="cart-add" action="{{ route('cart.add')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $product['id'] }}">
            <input type="hidden" name="name" value="{{ $product['name'] }}">
            <input type="hidden" name="desc" value="{{ $product['desc'] }}">
            <input type="hidden" name="price" value="{{ $product['price'] }}">
            <input type="hidden" name="img" value="{{ $product['img'] }}">
            <input class="button products-add-to-cart" type="submit" value="Add to Cart">
          </form>

          @if(Auth::check())
          @if(Auth::user()->id === $user['id'])
            <a class="button products-edit" target="_blank" href="{{ route('product.edit', $product['slug']) }}">Edit</a>
            <form action="{{ route('product.destroy', $product['slug']) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <input class="button products-delete" type="submit" value="Delete">
            </form>

            {{-- <a onclick="event.preventDefault(); document.getElementsByClassName('_form_products_delete')[0].click();" class="button products-delete" href="#!"> Delete</a> <br> <br> error delete not based on id --}}
            @endif
            @endif
        </div>

      </div>
      @endforeach

      <div style="width: 100%;">
        {{ $products->links() }}
      </div>
      <br>
      <br>
      <br>


      @empty
      @endforelse

      <div style="width: 100%;">
        <h3> {{ strtoupper($user['name']) }} Blog's </h3>
        <hr>
      </div>


      {{-- SINGLE LATEST BLOG --}}

      @if($blog)
      <section class="blog">
        <h2 class="blog-title"> {!! title_case($blog['title']) !!} </h2>
        @foreach ($blog->tags as $tag)
        <span class="blog-tags"> {{ $tag['name'] }} </span>
        @endforeach
        <span class="blog-date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }} </span> /
        <span class="blog-author"> Author : <a href="{{ route('user.profile', $blog['user']['id']  )}}"></a> {{ $blog['user']['name'] }} </span>
        <figure>
          <img class="blog-img" src="{{ showImage($blog['img']) }}" alt="{!! $blog['title'] !!}">
          <figcaption> {!! $blog['caption'] !!} </figcaption>
        </figure>

        <div class="blog-desc"> {!! $blog['desc'] !!} </div>

        <form class="form-blog-delete" action="{{ route('blog.destroy', $blog['id']) }}" method="post">
          @csrf

          {{ method_field('DELETE') }}
        </form>
        <br>
        @if(auth()->check())
         @if(auth()->user()->id == $blog['user']['id'])
          <a href="#!" class="button" onclick="event.preventDefault(); document.getElementsByClassName('form-blog-delete')[0].submit();"> Delete </a>
          <a href="{{ route('blog.edit', $blog['slug']) }}" class="button" target="_blank">Edit</a>
         @endif
        @endif
      </section>

      {{-- EMOTIONS --}}

      <emotion :blog_id="{{ $blog['id'] }}"> </emotion>

      {{-- COMMENTS --}}

      <div class="column">
        <comment :blog_id="{{ $blog['id'] }}"> </comment>
      </div>


      {{-- RECENTLY BLOGS --}}

      <section class="recently-blogs" style="width: 100%;">
        <h2> Recently Blog's </h2>

        <div class="columns is-multiline">
          @forelse ($blogs->chunk(3) as $chunk)
          @foreach ($chunk as $blog)
          <div class="column is-one-third">

            <img src="{{ showImage($blog['img']) }}" alt="{{ $blog['title'] }}">
            <h2> <a href="{{ route('blog.show', $blog['slug'])}}" target="_blank"> {!! title_case($blog['title']) !!} </a></h2>

          </div>
          @endforeach
          @empty
          @endforelse
        </div>
      </section>

      <div class="column is-fullWidth">
        {{ $blogs->links() }}
      </div>
      @endif

      </div>


      </div>
    </div>

@endsection
