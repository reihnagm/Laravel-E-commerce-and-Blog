@extends('layouts.app')

@section('content')

<div class="_container">
  <div class="_columns">

  @component('components/menu_in_profile_user/content', [
    'user' => $user
  ]); 
  @endcomponent

  {{-------------------------------------------------------------------}}
  
  <div class="_columns _is_multiline">
    @forelse ($products->chunk(3) as $chunk)
    @foreach ($chunk as $product)
      <div class="_column _is_one_quarter">

        <div class="_products">
            <img src="{{ asset('storage/products/images/'. $product['img']) }}" alt="{{ $product['name'] }}" style="width: 100%;">
            
            <div class="_products_wrapper_price">
              <p class="_products_desc_price">Rp {{ number_format($product['price'], 2,",",".") }}</p>
            </div> <br>

            <h1 class="_products_name"> {{ title_case($product['name']) }} </h1> <br> 
        
            <span class="_products_users_username"> Owner : {{ $user['username'] }} </span> <br> <br>
            <span class="_products_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at'] ))  }} </span> <br> <br>
          
            @foreach ($product->categories as $category)
            <span class="_products_categories"> {{ $category['name'] }} </span> <br> <br>
            @endforeach 

            <p class="_products_desc"> {{ $product['desc'] }} </p> <br>
          
            <form class="_cart_add" action="{{ route('cart.add')}}" method="post">
              @csrf
             {{-- CSRF --}}

             <input type="hidden" name="id" value="{{ $product['id']}}">
             <input type="hidden" name="name" value="{{ $product['name']}}">
             <input type="hidden" name="price" value="{{ $product['price']}}">
             <input type="hidden" name="img" value="{{ $product['img']}}">

             <input class="_button _products_add_to_cart" type="submit" value="Add to Cart"> <br> <br>
            </form>
         
          @if(Auth::user()->id === $user->id)
            <a class="_button _products_edit"  target="_blank" href="{{ route('product.edit', $product['id']) }}">Edit</a> <br> <br> 
         
            <form action="{{ route('product.destroy', $product['id']) }}" method="post">
              {{-- CSRF --}}
              @csrf

              {{-- METHOD_FIELD --}}
              {{ method_field('DELETE') }}

              <input class="_button _products_delete" type="submit" value="Delete"> <br> <br>
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
    
      {{-------------------SINGLE BLOG-------------------------------------------}}
   
      @if($blog)
      <div class="_column _is_fullWidth">
        <div class="_blog">       
          <h2 class="_blog_title"> {{ title_case($blog['title']) }} </h2> <br>
            @foreach ($blog->tags as $tag)
              <span class="_blog_tags"> {{ $tag['name'] }} </span>
            @endforeach
            <span class="_blog_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }} </span> / 
            <span class="_blog_author"> Author : {{ $user['username'] }} </span>
              <figure>
                <img class="_blog_img" src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
                <figcaption> {{ $blog['caption'] }} </figcaption>
              </figure> <br>
        
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
              <br> <br>
              <a class="_button" target="_blank" href="{{ route('blog.edit', $blog['slug']) }}">Edit</a>
             @endif

         </div>
      </div>
    {{----------------------------------------EMOTIONS BLOG-------------------------------------------}}

    <emotion :blog_id="{{ $blog['id'] }}"></emotion>

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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
  
       <div id="emotionBox" class="_emotions">
          @php
           $emotions = ['happy', 'sad', 'angry','amazing', 'fear', 'doubt'];
          @endphp
          <div class="_mobile_columns _is_multiline">
          @for ($i = 0; $i <count($emotions); $i++)  
            <div class="_mobile_column _is_one_third">
              <img class="_emotions_img _mobile_column" @click="vote(@php echo $i; @endphp)" src="{{ asset('assets/emotions/'. $emotions[$i] . '.png') }}">  
              
                <span v-if="totalIsZero">
                  <div> 
                      0 % <br>
                    <span class="_emotions_total">
                      total @{{  @php echo  $emotions[$i]; @endphp }}
                    </span> 
                  </div>
                </span>
                <span v-else>
                  <div>
                    @{{ parseInt(@php echo $emotions[$i]; @endphp/total*100) }} % <br>
                    <span class="_emotions_total">
                      total @{{  @php echo  $emotions[$i]; @endphp }}
                    </span> 
                  </div>
                 </span>
              </div>
           @endfor
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
              this.$http({
                url : '/emotions/' + this.blog_id,
                method: 'GET'
              }).then(function(res) {
                  res = res.body;
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
                this.$http({
                  url: '/emotions/emotionid/' + emotion_id + '/blogid/' + this.blog_id,
                  method: 'GET'
                }).then(function(res) {
                   res = res.body
                
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
      </script>  --}}

      <br>

        {{-------------------------------------ALL COMMENTS SINGLE BLOG----------------------------------------------------}}

        <div class="_column _is_fullWidth">
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
              </span>   
          
                @if(Auth::user()->id == $comment->user->id)
                  <div class="_comments_options">
                    <a class="_button" href="{{ route('blog.comment.edit', $comment->id) }}"> Edit </a>
                    <form style="display: inline;" action="{{ route('blog.comment.destroy', $comment['id']) }}" method="post">
                      {{-- CSRF --}}
                      @csrf 
                      {{ method_field('DELETE') }}
                      {{-- METHOD_FIELD --}}

                      <input class="_button" type="submit" value="Delete">
                    </form>
                  </div>
                @endif
                @empty 
          @endforelse

        {{ $comments->links() }}

        {{----------------------------------TEXTAREA SINGLE BLOG COMMENTS----------------------------------------}}

        @if ($errors->has('subject'))
          <span class="_is_invalid"> {{ $errors->first('subject') }}</span>
        @endif
       
        <form class="_form_comments" method="post" action="{{ route('blog.comment.store', $blog['id'])}}">  <br>
          {{-- CSRF --}}
          @csrf
      
          <textarea name="subject" class="_comments_textarea"></textarea>
        </form> <br>
       
        <a class="_button" onclick="event.preventDefault(); document.getElementsByClassName('_form_comments')[0].submit();" href="#!"> Comment </a>  
      </div>
      
     
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
    <br> <br> <br>

        <div class="_column _is_fullWidth">
          <h2 class="_title_recently_blogs"> Recently Blog's </h2>  
        </div>
      
      <div class="_columns _is_multiline"> 
        @forelse ($blogs->chunk(3) as $chunk)
          @foreach ($chunk as $blog)
          <div class="_column _is_one_third">
            <img src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}"> <br>
            <h2> <a class="_text_gray" target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> {{ title_case($blog['title']) }} </a></h2>
          </div>
         @endforeach
         @empty
         @endforelse
      </div>

      {{-- PAGINATION --}}
      <div class="_column _is_fullWidth">
        {{ $blogs->links() }}
      </div>

       @endif

       </div> {{-- end of COLUMNS PRODUCT --}}    

   </div> {{-- end of COLUMNS --}}
  </div> {{-- end of CONTAINER --}}

@endsection