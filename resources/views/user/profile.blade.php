@extends('layouts.app')

@section('content')

<div class="_container">
  <div class="_columns">

  @component('components/menu_in_profile_user/content',[
    'user' => $user
  ]); 
  @endcomponent

  {{-------------------------------------------------------------------}}
  
 <div class="_columns _is_multiline">
  @forelse ($products->chunk(4) as $chunk)
    @foreach ($chunk as $product)
      <div class="_column _is_one_quarter">
        <div class="_product">
            <img src="{{ asset('storage/products/images/'. $product->img) }}" alt="{{ $product->name }}">
            <div id="_wrapper_price">
              <img id="_board_price_img" src="{{ asset('/assets/icon/board-price.jpg')}}">
              <p id="_desc_price"> {{ money($product->price, 'USD') }}</p>
            </div>
            <h1> {{ title_case($product->name) }} </h1>
            <div>
              <span> {{ $user->username }} </span>
            </div>
            <div>
              <span> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product->created_at))  }} </span>
            </div>
            @foreach ($product->categories as $category)
            <span> {{ $category->name }} </span>
            @endforeach
            <p>{{ $product->desc }}</p>
            <a class="_button" href="{{ route('cart.add', $product->id) }}"> add to cart </a>
            
            <a href="{{ route('product.edit', $product->id) }}" target="_blank" class="_button" href="#!">edit</a>
         
            <form action="{{ route('product.update', $product->id) }}" method="post">
              {{-- CSRF --}}
              @csrf

              {{-- METHOD_FIELD --}}
              {{ method_field('DELETE') }}
              
              <input class="_button" type="submit" value="delete">
              
            </form>
          </div>
        </div>
        @endforeach 
      @empty
    @endforelse
    
      {{-- PAGINATION --}}
    
      <div style="width: 100%; flex: none;">
         {{ $products->links() }}
      </div>

      <div style="width: 100%; flex: none;">
        <hr>
      </div>

      {{----------------------------------------------------------------}}
   
      <div class="_column">
         <div class="_blog">

        @foreach ($user->blogs()->orderBy('id', 'desc')->limit(1)->get() as $blog) 
            <h2> {{ title_case($blog->title) }} </h2>
              @foreach ($blog->tags as $tag)
                <span> {{ $tag->name }} </span>
              @endforeach
              <span> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog->created_at)) }} </span> / 
              <span> Author : {{ $blog->user->username }} </span>
                <figure>
                  <img src="{{ asset('storage/blogs/images/'. $blog->img) }}" alt="{{ $blog->title }}">
                  <figcaption> {{ $blog->caption }} </figcaption>
                </figure>
          
                <p> {!! $blog->desc !!} </p>

                <form action="{{ route('blog.destroy', $blog->id) }}" method="post">
                  {{-- CSRF --}}
                  @csrf 
                  {{-- METHOD_FIELD --}}
                  {{ method_field('DELETE') }}
                  <input class="_button" type="submit" value="delete">
                </form>
                <a class="_button" target="_blank" href="{{ route('blog.edit', $blog->id) }}">edit</a>
           
    {{-----------------------------------------------------------------------------------}}

      @push('scripts')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
      @endpush
  
     <div id="emotionBox">
      <div class="_columns _is_multiline">

         @forelse($emotions as $emotion) 
          <div class="_column _is_one_third">
           <div id="_emotions" class="clearfix">

            <img style="float: left;" @click="vote(@php echo $emotion->id; @endphp)" src="{{ asset('assets/emotions/'. $emotion->name . '.png') }}">  
          
              <span v-if="totalIsZero">
                <span style="float: left; margin: 15px 0 0 10px; display: inline-block;"> 
                  0 %
                <div style="margin: 8px 0 0 0;">
                  total @{{  @php echo $emotion->name; @endphp }}
                </div> 
               </span>
              </span>
              <span v-else>
                <span style="float: left; margin: 15px 0 0 10px; display: inline-block;">
                  @{{ parseInt(@php echo $emotion->name; @endphp/total*100) }} % 
                  <div style="margin: 8px 0 0 0;">
                    total @{{  @php echo $emotion->name; @endphp }}
                  </div> 
               </span>
              </span>
              
            </div>
          </div>
          @empty
         @endforelse
        
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

            blog_id: @php echo $blog->id; @endphp
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
              url : '/emotion/' + this.blog_id,
              method: 'GET'
            }).then(function(response) {
              res = response.body;
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
            vote(emotionid) {
              this.$http({
                url: '/emotion/emotionid/' + emotionid + '/blogid/' + this.blog_id,
                method: 'GET'
              }).then(function(response) {
                res = response.body
            
                if(res.message == 'success') {
                  this.total++;
                  this.modify(emotionid, 1);
                } else if(res.message == 'unvote') {
                  this.total--;
                  this.modify(emotionid, -1)
                } else {
                  this.modify(parseInt(res.old_emotion), -1);
                  this.modify(emotionid, 1);
                }

              })
            },
          modify(val, point) {
            switch (val) {
              case 1: this.happy = this.happy + point; break;
              case 2: this.sad = this.sad + point; break;
              case 3: this.amazing = this.amazing + point; break;
              case 4: this.doubt = this.doubt + point; break;
              case 5: this.fear = this.fear + point; break;
              case 6: this.angry = this.angry + point; break;
              
              default:
              break;
            }
          }
        }
        })
     </script> 

    
 
    {{-- <emotion
     v-for='emotion in emotions'
     :emotion_id="emotion.id"
     :emotion_name="emotion.name"
     :blog_id="{{$blog['id']}}"
    ></emotion> --}}

    {{-------------------------------------------------------------------}}

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

    <div id="commentBox">
      @foreach($blogcomments as $comment)
       <div class="_column">
         <div id="_userComment">
              <img id="_imgComment" src="https://picsum.photos/200">
                 {{ $comment->user->username }}
                 <div id="_descComment">
                 
                   {{ $comment->subject }}
               
                  <div>
                  <span class="_option_like_unlike_wrapper">
                  <a class="{{ $comment->is_liked() ? '_after_liked' : '_before_liked' }}" href="#!" model-id="{{ $comment->id }}" model-type="2"> 
                    {{ $comment->is_liked() }}
                  </a>         
                    <span class="_total_like">
                      <span class="_like_number"> {{ $comment->likes->count() }} </span>
                    </span>
                  </span>
                  </div>
              
                 <div>
                  <span class="_option_unlike_wrapper">
                  <a class="{{ $comment->is_unliked() ? '_after_unliked' : '_before_unliked' }}" href="#!" model-id="{{ $comment->id }}" model-type="2"> 
                    {{ $comment->is_unliked() }}
                  </a>         
                    <span class="_total_unlike">
                      <span class="_unlike_number"> {{ $comment->unlikes->count() }} </span>
                    </span>
                  </span>
                  </div>
                
              
                @if(Auth::user()->id == $comment->user->id)
                <div id="_optionCommentBtn">
                  <a class="_button" href="{{ route('blog.comment.edit', $comment->id)}}"> edit </a>
                  <a class="_button" href="{{ route('blog.comment.destroy', $comment->id)}}"> delete </a> 
                </div>
                @endif
              </div>
          </div>
        @endforeach
      </div>

      {{-- <div id="_comment_content">

      </div> --}}

       {{ $blogcomments->links() }}

      <div class="_column">
        @if ($errors->has('subject'))
            <span class="_is_invalid"> {{ $errors->first('subject') }}</span>
        @endif
        <br>
        <form method="post" action="{{ route('blog.comment.store', $blog->id)}}">
          @csrf
          <textarea name="subject" class="_textareaComment"></textarea>
          <input id="_commentBtn"class="_button" type="submit" value="Comment">  
        </form>  
{{--         
        <textarea id="subject" cols="4" rows="4"></textarea>
      <input class="submitComment" type="submit" blog-id="{{ $blog->id }}" blog-comments="{{ $blogcomments }}"> --}}
      </div>
             
      @endforeach  

     
     
    </div> {{-- end of BLOG --}}
   </div> 



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

    
    
    {{--------------------------------------------------------------------------------------}}
    
    <div style="width: 100%; flex:none;">
      <div class="_columns _is_multiline">
        @forelse ($blogs as $blog)
          <div class="_column _is_one_third">
          
          <img src="{{ asset('storage/blogs/images/'. $blog->img) }}" alt="{{ $blog->title }}"> <br>
          <h2> <a class="_text_gray" href="{{ route('blog.show', $blog->id)}}"> {{ title_case($blog->title) }} </a></h2>

          </div>
        @empty
        @endforelse
      </div>{{-- end of COLUMNS --}}
    </div>

      {{-- PAGINATION --}}
      <div style="width: 100%; flex:none;">
        {{ $blogs->links() }}
      </div>
  
   </div> {{-- end of COLUMNS --}}
  </div> {{-- end of COLUMNS --}}
</div> {{-- end of CONTAINER --}}

@endsection