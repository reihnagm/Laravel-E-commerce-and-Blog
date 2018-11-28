@extends('layouts.app')

@section('content')

<div class="_container">
  <div class="_columns">
        <div class="_column _is_one_quarter">

      <div class="_hamburger_menu">
        <span class="bar1"></span> 
        <span class="bar2"></span>
        <span class="bar3"></span>
      </div>

      <div class="_mobile_nav_menu">
        <a class="_cart" href="{{ route('cart.index') }}">
          @auth
          <h2 class="_cart_count">{{ Cart::count() }}</h2>
          <div class="_cart_wrapper">
            <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
            @if(!empty(Cart::count()))
            <img class="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
            @endif
          </div>
          @endauth

          @guest
          <h2 class="_cart_count"> 0 </h2>
          <div class="_cart_wrapper">
              <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
          </div>
          @endguest
        </a>

     @if(Auth::check())   
        @if (empty($user['provider']))
         
        <div class="_is_left">
          <img class="_profile_menu_ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ $user['username'] }}">
          <h2  class="_profile_menu_users_username"> <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a> </h2>
         </div>  
        
        <ul class="_mobile_menu">
          @if($user['id'] === Auth::user()->id) 
            <li><a target="_blank" href="/chat"> Chat </a></li> 
            <li><a target="_blank" href="{{ route('notifications.index')}}" class="_see_Notif"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
            <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>   
            <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
          @endif
          <li><a href="{{ route('app.index') }}"> Back to homepage </a></li> 
          <li><a href="/social/account/logout/"> Logout </a></li> 
        </ul>
        
        @else 

        <div class="_is_left">
          <img class="_profile_menu_ava" src="" alt="{{ $user['username'] }}">
          <h2 class="_profile_menu_users_username"> <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a> </h2>
        </div>

        <ul class="_mobile_menu">
        @if($user['id'] === Auth::user()->id)
          <li><a href="/chat" target="_blank"> Chat </a></li>
          <li><a target="_blank" href="/notification" class="_see_Notif"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
          <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>     
          <li><a target="_blank" href="/blog/create"> Create a Blog</a></li>
        @endif
        <li><a href="/"> Back to homepage </a></li>
        <li><a href="/social/account/logout/"> Logout </a></li>
        </ul> 

        @endif
       @else

      <form id="_form_login_mobile" action="{{ route('login') }}" method="POST">
        {{-- CSRF --}}
        @csrf

        <div class="_field">
        <input type="text" name="email" placeholder="E-Mail Address">

        @if ($errors->has('email'))
        <span class="_is_invalid">{{ $errors->first('email') }}</span>
        @endif

        <div class="_wrapper_input_password">
        <input id="password_field_mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_mobile" class="_eye_icon"> </i>
        </div>

        @if ($errors->has('password'))
        <span class="_is_invalid">{{ $errors->first('password') }}</span>
        @endif
        <br> 
        <a  class="_button" onclick="event.preventDefault(); document.getElementById('_form_login_mobile').submit();">Login </a> 
        </div> 
      
        <input type="checkbox" name="remember" id="remember_label_mobile" {{ old('remember') ? 'checked' : '' }}>
        <label id="_remember_label_mobile"  for="remember"> Remember Me </label>
      </form> 

        <span class="_dont_have_account"> don't have a account? </span>

        <div class="panel">
          <form action="{{ route('register')}}" method="POST">
              {{-- CSRF --}}
              @csrf

              <div class="_field">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                
                @if ($errors->has('username'))
                  <span class="_is_invalid">{{ $errors->first('username') }}</span>
                @endif

                <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
        
                @if ($errors->has('email'))
                  <span class="_is_invalid">{{ $errors->first('email') }}</span>
                @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_register_mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register_mobile" class="_eye_icon"> </i>
                </div>

                @if ($errors->has('password'))
                  <span class="_is_invalid">{{ $errors->first('password') }}</span>
                @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_confirmation_mobile" type="password" name="password_confirmation" placeholder="Password Confirmation"> <i toggle="#password_field_confirmation_mobile" class="_eye_icon"> </i>
                </div>

                @if ($errors->has('password_confirmation'))
                <span class="_is_invalid">{{ $errors->first('password_confirmation') }}</span>
                @endif

                <input class="_button" type="submit" value="Submit Register">
              </div>

            </form>
          </div>

          <a id="trigger-button-register" class="accordion _button"> Register </a>
          <br>
          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>
          @endif
        
        </div>

      {{-- MOBILE --}}
  
       <a class="_cart _hidden_in_mobile" href="{{ route('cart.index') }}">
          @auth
          <h2 class="_cart_count">{{ Cart::count() }}</h2>
          <div class="_cart_wrapper">
            <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
            @if(!empty(Cart::count()))
            <img class="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
            @endif
          </div>
          @endauth 
          @guest
            <h2 class="_cart_count"> 0 </h2>
            <div class="_cart_wrapper">
              <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
            </div>
          @endguest
       </a>

      <hr class="_hidden_in_mobile">

      @if(Auth::check())
        @if(empty($user['provider']))
        <nav class="nav">
          
          <div class="_is_left">
            <img class="_profile_menu_ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ $user['username'] }}"> <br> <br>
            <h2 class="_profile_menu_users_username"> {{ $user['username'] }} </h2>
          </div>  
            <a href="{{ route('app.index') }}"> back to homepage </a>
        
          @else 
          <ul>
            <li><img src="" alt=""></li>
            <li><a href="{{ route('user.profile') }}"> {{ $user['username'] }}</a></li>
            <li><a href="{{ route('social.logout') }}">Logout</a></li>
          </ul>
         </nav>
        @endif
      @else 

      <nav class="nav">
       <form id="_form_login" action="{{ route('login') }}" method="POST">
          {{-- CSRF --}}
          @csrf

        <div class="_field">
          <input type="text" name="email" placeholder="E-Mail Address">

          @if ($errors->has('email'))
           <span class="_is_invalid">{{ $errors->first('email') }}</span>
          @endif

          <div class="_wrapper_input_password">
           <input id="password_field" type="password" name="password" placeholder="Password"> <i toggle="#password_field" class="_eye_icon"> </i>
          </div>

          @if ($errors->has('password'))
           <span class="_is_invalid">{{ $errors->first('password') }}</span>
          @endif

          <br> 
          <a class="_button" onclick="event.preventDefault(); document.getElementById('_form_login').submit();">Login </a> 
        </div> 
        
          <input type="checkbox" name="remember" id="remember_label_mobile" {{ old('remember') ? 'checked' : '' }}>
          <label id="_remember_label_mobile"  for="remember"> Remember Me </label> <br> <br>
       </form> 
       
        <span class="_dont_have_account"> don't have a account? </span>  <br>

          <div class="panel">
            <form action="{{ route('register')}}" method="POST">
                {{-- CSRF --}}
                @csrf

                <div class="_field">
                  <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                  
                    @if ($errors->has('username'))
                    <span class="_is_invalid">{{ $errors->first('username') }}</span>
                  @endif

                  <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
          
                  @if ($errors->has('email'))
                    <span class="_is_invalid">{{ $errors->first('email') }}</span>
                  @endif

                  <div class="_wrapper_input_password">
                    <input id="password_field_register" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register" class="_eye_icon"> </i>
                  </div>

                  @if ($errors->has('password'))
                    <span class="_is_invalid">{{ $errors->first('password') }}</span>
                  @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_confirmation" type="password" name="password_confirmation" placeholder="Password Confirmation"> <i toggle="#password_field_confirmation" class="_eye_icon"> </i>
                </div>

                  @if ($errors->has('password_confirmation'))
                  <span class="_is_invalid">{{ $errors->first('password_confirmation') }}</span>
                  @endif

                  <input class="_button" type="submit" value="Submit Register">
              </div>

              </form>
            </div>
            
          <a id="trigger-button-register" class="accordion _button"> Register </a>
          <br> <br>
          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>
          </nav>

          @endif

         </div>
      

  {{------------------------------PRODUCTS-----------------------------------}}
  
  <div class="_columns _is_multiline">
    @forelse ($products->chunk(3) as $chunk)
    @foreach ($chunk as $product)
      <div class="_column _is_one_quarter">

        <div class="_products">
            <img src="{{ asset('storage/products/images/'. $product['img']) }}" alt="{{ $product['name'] }}" style="width: 100%;">
            
            <div class="_products_wrapper_price">
              <p class="_products_desc_price">Rp {{ number_format($product['price'], 2,",",".") }} </p>
            </div> 

            <h1 class="_products_name"> {{ title_case($product['name']) }} </h1> 
        
            <span class="_products_users_username"> Owner : {{ $product['user']['username'] }} </span> 
            <span class="_products_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at'] ))  }} </span> 
          
            @foreach ($product->categories as $category)
            <span class="_products_categories"> {{ $category['name'] }} </span> 
            @endforeach 

            <p class="_products_desc"> {{ $product['desc'] }} </p>
          
            <form class="_cart_add" action="{{ route('cart.add')}}" method="post">
              @csrf
             {{-- CSRF --}}

             <input type="hidden" name="id" value="{{ $product['id'] }}">
             <input type="hidden" name="name" value="{{ $product['name'] }}">
             <input type="hidden" name="price" value="{{ $product['price'] }}">
             <input type="hidden" name="img" value="{{ $product['img'] }}">

             <input class="_button _products_add_to_cart" type="submit" value="Add to Cart"> <br> <br>
            </form>
         
          @if(Auth::user()->id === $user->id)
            <a class="_button _products_edit"  target="_blank" href="{{ route('product.edit', $product['id']) }}">Edit</a>  
         
            <form action="{{ route('product.destroy', $product['id']) }}" method="post">
              {{-- CSRF --}}
              @csrf

              {{-- METHOD_FIELD --}}
              {{ method_field('DELETE') }}

              <input class="_button _products_delete" type="submit" value="Delete"> 
            </form>

            {{-- <a onclick="event.preventDefault(); document.getElementsByClassName('_form_products_delete')[0].click();" class="_button _products_delete" href="#!"> Delete</a> <br> <br> 
              error delete not based on id
            --}}
          @endif
          </div>

        </div>
        @endforeach 
        
        <div class="_column _is_fullWidth">
          <hr>
        </div>

      @empty
    @endforelse
  
      {{-- PAGINATION --}}
  
      <div class="_column _is_fullWidth">
         {{ $products->links() }}
      </div>
    
    {{-------------------SINGLE LATEST BLOG------------------------}}
   
    @if($blog)
      <div class="_column _is_fullWidth">
        <div class="_blog">     
            
          <h2 class="_blog_title"> {{ title_case($blog['title']) }} </h2> 
            @foreach ($blog->tags as $tag)
              <span class="_blog_tags"> {{ $tag['name'] }} </span>
            @endforeach
            <span class="_blog_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }} </span> / 
            <span class="_blog_author"> Author : {{ $user['username'] }} </span>
              <figure>
                <img class="_blog_img" src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
                <figcaption> {{ $blog['caption'] }} </figcaption>
              </figure> 
        
              <p class="_blog_desc"> {!! $blog['desc'] !!} </p>

              <form class="_form_blog_delete" action="{{ route('blog.destroy', $blog['id']) }}" method="post">
                {{-- CSRF --}}
                @csrf 
                {{-- METHOD_FIELD --}}
                {{ method_field('DELETE') }}
              </form>
              <br>
             @if(Auth::user()->id == $blog['user']['id'])
              <a class="_button" onclick="event.preventDefault(); document.getElementsByClassName('_form_blog_delete')[0].submit();" href="#!"> Delete </a>
          
              <a class="_button" target="_blank" href="{{ route('blog.edit', $blog['slug']) }}">Edit</a>
             @endif

         </div>
      </div>

    {{-----------------------EMOTIONS BLOG-------------------}}
    
     <emotion :blog_id="{{ $blog['id'] }}"> </emotion>

     <div class="_column">
       <comment :blog_id="{{ $blog['id'] }}" :user_id="{{ Auth::user()->id }}"> </comment>
     {{-- <comment-textarea :blog_id="{{ $blog['id'] }}" :user_id="{{ Auth::user()->id }}"> </comment-textarea> --}}
     </div>    

    {{--    
   <div class="_mobile_columns _is_multiline">
      @foreach ($emotions as $emotion)  
      <div class="_mobile_column _is_one_third">
       <img class="_emotions_img" src="{{ asset('/assets/emotions/'. $emotion['name'] . '.png') }}" alt="{{ $emotion['name'] }}" emotion-id="{{ $emotion['id'] }}" blog-id="{{ $blog['id'] }}">
        @if(!empty($emotion->emotionOptions->count()))  
          <span class="_emotions_percentage"> {{ round($emotion->emotionOptions->count()/$totalEmotions*100) }} % </span> 
          <span class="_emotions_total"> Total : {{ $emotion->emotionOptions->count() }}  </span>
          @else 
          <span class="_emotions_percentage"> 0 %</span> 
          <span class="_emotions_total"> Total : 0 </span>
         @endif
       </div>
      @endforeach
    </div>  --}}
      
    {{-- <comment
     v-for='comment in comments'
     :username="comment.user.username"
     :subject="comment.subject"
     :like="comment.likes.length"
     :unlike="comment.unlikes.length"
     :blog_id="comment.blog.id"
     :comment_id="comment.id"
     :key="comment.id"
     ></comment>
   
     <commenttextarea
     :blog_id="{{ $blog['id'] }}"
     ></commenttextarea> --}}
    

   {{-- <div class="_column">  
     <div id="commentBox">

       <div id="_wrapperComment" class="clearfix" v-for="comment in comments"> --}}
        
            {{-- <div v-for="comment in blogcomment.comments" id="_wrapperComment">  --}}

              {{-- <div id="_userComment">
              <img id="_imgComment" src="https://picsum.photos/200">
                  @{{ comment.user.username }}
               <div id="_descComment">
                 <div> 
                    @{{ comment.subject }}      
                 </div> --}} 

                {{-- <div v-if="comment.likes && comment.likes.length">
                  @{{ comment.likes.length }}
                 </div> --}}

                  {{-- <div>  
                    <a id="_like" @click.prevent="like(comment.id, comment.likes.length)" href="#!">  </a>                
                    @{{ likeCount }}
                    <a id="_unlike" @click.prevent="unlike(comment.id)" href="#!"> </a>  
                    @{{ comment.unlikes.length }}
                  </div> 
                </div>
              </div> --}}

             {{-- <transition v-on:after-enter="afterEnter" name="fade"> 
              <div v-if="edit">
                <textarea ref="subjectEdit" class="_textareaComment" v-model="comment.subject"></textarea>
                <input id="_commentBtn" @click.prevent="editComment(comment.id)" class="_button" type="submit" value="Update Comment">
              </div>
            </transition> --}}
            {{-- <div id="_optionCommentBtn" v-if="{{ Auth::user()->id }} == comment.user.id">
              <a @click.prevent="edit = !edit" class="_button" href="#!"> edit </a>
              <a @click.prevent="deleteComment(comment.id)" class="_button" href=""> delete </a> 
            </div>

              <textarea ref="subject" class="_textareaComment"></textarea>
              <input id="_commentBtn" @click.prevent="submitComment()" class="_button" type="submit" value="Comment">

            </div>
     
       </div> 

      </div>
    </div> --}}
  
    
       {{-- <div id="emotionBox" class="_emotions">
          <div class="_mobile_columns _is_multiline">
          @foreach ($emotions as $emotion)  
            <div class="_mobile_column _is_one_third">
              <img class="_emotions_img _mobile_column" @click="vote(@php echo $emotion['id']; @endphp)" src="{{ asset('assets/emotions/'. $emotion['name'] . '.png') }}">  
              
                <span v-if="totalIsZero">
                  <div> 
                      0 % <br>
                    <span class="_emotions_total">
                      total @{{  @php echo  $emotion['name']; @endphp }}
                    </span> 
                  </div>
                </span>
                <span v-else>
                  <div>
                    @{{ parseInt(@php echo $emotion['name']; @endphp/total*100) }} % <br>
                    <span class="_emotions_total">
                      total @{{  @php echo  $emotion['name']; @endphp }}
                    </span> 
                  </div>
                 </span>
              </div>
           @endforeach
          </div>
         </div>
      
         <script>
           
            new Vue({
            el: "#emotionBox",
            data: {
              total: 0,
              happy: 0,
              sad: 0,
              amazing: 0,
              doubt: 0,
              fear: 0,
              angry: 0,

              blog_id: @php echo $blog['id']; @endphp
            },
            computed: {
              totalIsZero: function() {
                if (this.total == 0) {
                  return true
                } else {
                  return false 
                }
              },
            },
            created: function () {    
              axios.get('/emotions/' + this.blog_id).then((res) => {
                  res = res.data;
                  
                if (res.total != 0 ) {
                  this.total = res.total;
                  this.happy = res.happy;
                  this.sad = res.sad;
                  this.amazing = res.amazing;
                  this.doubt = res.doubt;
                  this.fear = res.fear;
                  this.angry = res.angry;
                }
              })
            },
            methods: {
              vote(emotion_id) {
                axios.get('/emotions/emotionid/' + emotion_id + '/blogid/' + this.blog_id).then((res) => {
                   res = res.data
                
                  if(res.message == 'success') {
                    this.total++;
                    this.modify(emotion_id, 1);
                  } else if(res.message == 'unvote') {
                    this.total--;
                    this.modify(emotion_id, -1)
                  } else {
                    this.modify(parseInt(res.old_emotion), -1);
                    this.modify(emotion_id, 1);
                  }
                })
              },
            modify(val, point) {
              switch (val) {
                case 0: this.happy += point; break;
                case 1: this.sad += point; break;
                case 2: this.angry += point; break;
                case 3: this.amazing += point; break;
                case 4: this.fear += point; break;
                case 5: this.doubt += point; break;
                
                default:
                break;
              }
            }

          }
          })
      </script>--}}

     {{-------------------------------------ALL COMMENTS SINGLE BLOG----------------------------------------------------}}

      {{-- <div class="_column _is_fullWidth">
         @forelse($blog->comments as $comment) 
              <img class="_comments_ava" src="https://picsum.photos/200">
              <span class="_comments_username"> {{ $comment['user']['username'] }}  </span>
              <p class="_comments_subject"> {{ $comment['subject'] }} </p>
                          
              <span class="_option_like_unlike_wrapper">
              <a class="{{ $comment->is_liked() ? '_after_liked' : '_before_liked' }}" href="#!" model-id="{{ $comment['id'] }}" model-type="2"> 
                {{ $comment->is_liked() }}
              </a>         
                <span class="_like_number"> {{ $comment->likes->count() }} </span>
              </span>            
            
              <span class="_option_unlike_wrapper">
              <a class="{{ $comment->is_unliked() ? '_after_unliked' : '_before_unliked' }}" href="#!" model-id="{{ $comment['id'] }}" model-type="2"> 
                {{ $comment->is_unliked() }}
              </a>         
               <span class="_unlike_number"> {{ $comment->unlikes->count() }} </span>
              </span>    --}}
          
                {{-- @if(Auth::user()->id == $comment->user->id) --}}
                  {{-- <div class="_comments_options"> --}}
                    {{-- <a class="_button" href="{{ route('blog.comment.edit', $comment->id) }}"> Edit </a> --}}
                    {{-- <form style="display: inline;" action="{{ route('blog.comment.destroy', $comment['id']) }}" method="post"> --}}
                      {{-- CSRF --}}
                      {{-- @csrf  --}}
                      {{-- {{ method_field('DELETE') }} --}}
                      {{-- METHOD_FIELD --}}
                      {{-- <input class="_button" type="submit" value="Delete"> </form> </div> @endif @empty @endforelse  --}}
          {{-- @empty 
        @endforelse --}}
        {{-- {{ $comments->links() }}  --}}

        {{----------------------------------TEXTAREA SINGLE BLOG COMMENTS----------------------------------------}}

        {{-- @if ($errors->has('subject'))
          <span class="_is_invalid"> {{ $errors->first('subject') }}</span>
        @endif --}}
       
        {{-- <form class="_form_comments" method="post" action="{{ route('blog.comment.store', $blog['id'])}}">  --}}
          {{-- CSRF --}}
          {{-- @csrf
          <textarea name="subject" class="_comments_textarea"></textarea>
        </form>  --}}
       
        {{-- <a  href="#!" class="_button" onclick="event.preventDefault(); document.getElementsByClassName('_form_comments')[0].submit();"> Comment </a>  
      </div>  --}}
      
       {{-- 
      <div class="_columns _is_multiline">
        @foreach(App\Models\Emotion::All() as $emotion)
         <div class="_column _is_one_third">
           <img width="80" src="{{ asset('assets/emotions/'. $emotion['name'] .'.png') }}" alt="{{ $emotion['name'] }}">     
         </div>
         @endforeach 
      </div> --}}

      {{------------------------------------------------------------------------------------------}}
      
      {{-- AJAX COMMENT --}}
      {{-- <div id="_comment_content">
      </div> --}}
      
       {{-- AJAX COMMENR --}}
      {{-- <textarea id="subject" cols="4" rows="4"></textarea>
      <input class="submitComment" type="submit" blog-id="{{ $blog->id }}" blog-comments="{{ $blogcomments }}"> --}}
      
      {{-- <script>
         new Vue ({
          el: '#commentBox',
          data: {
            subject: '',
  
            edit: false,
            comments: [],
            blog_id: @php echo $blog->id; @endphp
          },
           mounted() {
              this.viewComment()
           },
          methods: {  
            viewComment() {
              this.$http({
                url: '/api/blog-comment/',
                method: 'GET'
               }).then(function(res) {
                this.comments = res.body.data
               })
            },
            like(id){
              this.$http({  
                url: '/like/' + id +'/2',
                method:'GET'
              }).then(function(res) { 
              })
            },
            unlike(id) {
              this.$http({
                url: '/unlike/' + id + '/2',
                method:'GET'
              }).then(function(res) {

              })
            },
            afterEnter: function (el) {
              this.$refs.subjectEdit[0].value
            },
            deleteComment(id) {
              this.$http({
                url: '/api/blog-comment/' + id,
                method: 'DELETE'
              }).then(function (res) {
                this.viewComment()
                this.subject = ''
              })
            },
            editComment(id) {
              this.$http({
                url: '/api/blog-comment/' + id + '/update',
                method: 'PUT',
                body: {
                  'subject': this.$refs.subjectEdit[0].value
                }
              }).then(function(res){
                this.viewComment()
                this.$refs.subjectEdit[0].value = ''
              })
            },
            submitComment() {
              this.$http({
                url:'/api/blog-comment/'+ this.blog_id,
                method: 'POST',
                body: {
                'subject': this.$refs.subject.value,
                'user_id': {{ Auth::user()->id }} 
                }
              }).then(function(res){
                this.viewComment()
                this.$refs.subject.value = ''
              })
            }
          }
        })
      </script> --}}

    {{----------------------------------------RECENTLY BLOGS----------------------------------------------}}
 
        <div class="_column _is_fullWidth">
          <h2> Recently Blog's </h2>  
        </div>
      
      <div class="_columns _is_multiline"> 
        @forelse ($blogs->chunk(3) as $chunk)
          @foreach ($chunk as $blog)
          <div class="_column _is_one_third">

            <img src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
            <h2> <a target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> {{ title_case($blog['title']) }} </a></h2>
          
          </div>
         @endforeach
         @empty
         @endforelse
      </div>

      {{-- PAGINATION --}}
      
      <div class="_column _is_fullWidth">
        {{ $blogs->links() }}
      </div>

       @endif {{-- end of CHECK BLOG IS EMPTY --}}

       </div> {{-- end of COLUMNS PRODUCT --}}    

   </div> {{-- end of COLUMNS --}}
  </div> {{-- end of CONTAINER --}}

@endsection