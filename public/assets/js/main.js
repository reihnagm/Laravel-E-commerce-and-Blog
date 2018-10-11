$(document).ready(function() {

    $.ajaxSetup({
        cache: false,
        headers: { 
            'X-CSRF-TOKEN': Laravel.token 
        }
     });

    $(document).on('click touchstart', '._before_liked' , function() {
        let _this = $(this)

        let model_type = _this.attr('model-type')
        let model_id = _this.attr('model-id')
        let url = "/like/" + model_id + "/" + model_type

        $.get(url, () => {
            
        _this.addClass('_after_liked').removeClass('_before_liked')
        let likeNumber = _this.parents('._option_like_unlike_wrapper').find('._like_number')
        likeNumber.html(parseInt(likeNumber.html()) + 1)

        })
        
    })

    $(document).on('click touchstart','._after_liked',  function () {
        let _this = $(this)

        let model_type = _this.attr('model-type')
        let model_id = _this.attr('model-id')
        let url = "/cancel_like/" + model_id + "/" + model_type

        $.get(url, () => {

        _this.removeClass('_after_liked').addClass('_before_liked')
        let likeNumber = _this.parents('._option_like_unlike_wrapper').find('._like_number')
        likeNumber.html(parseInt(likeNumber.html()) - 1)
           
        })

    })

    $(document).on('click touchstart', '._before_unliked', function () {
        let _this = $(this)

        let model_type = _this.attr('model-type')
        let model_id  = _this.attr('model-id')
        let url = "/unlike/" + model_id + "/" + model_type

        $.get(url, () => {

            _this.removeClass('_before_unliked').addClass('_after_unliked')
            let unlikeNumber = _this.parents('._option_unlike_wrapper').find('._unlike_number')
            unlikeNumber.html(parseInt(unlikeNumber.html()) + 1)

        })

    })

    $(document).on('click touchstart', '._after_unliked', function () {
        let _this = $(this)

        let model_type = _this.attr('model-type')
        let model_id = _this.attr('model-id')
        let url = "/cancel_unlike/" + model_id + "/" + model_type

        $.get(url, () => {

            _this.removeClass('_after_unliked').addClass('_before_unliked')
            let unlikeNumber = _this.parents('._option_unlike_wrapper').find('._unlike_number')
            unlikeNumber.html(parseInt(unlikeNumber.html()) - 1)

        });

    });

    $(document).on('click touchstart','.submitComment', function() {
        let html = '';
        let subject  = $('#subject').val();
        let blog_id  = $(this).attr('blog-id');
        let data = [subject, blog_id, html];
        sendToAjax(...data)
    });

    function sendToAjax(subject, blog_id, comments, html) {
    $.ajax({
        method: "POST",
        url: "/blog-comment/" + blog_id,
        data: {
          subject: subject
        }
    }).done(function(success) {
        console.log(comment_subject)
            html += 
                "<div class='_column'>" +
                    "<div id='_userComment'>" +
                        "<img id='_imgComment' src='https://picsum.photos/200'>" +
                             comment.user.username +
                            "<div id='_descComment'>" +

                            comment.subject +
                    
                                "<div>" +
                                    "<span class='_option_like_unlike_wrapper'>" +
                                       "<a class="+ comment.is_liked + "'?' '_after_liked' : '_before_liked' href='#!' model-id=" + comment.id + 'model-type = 2' + ">"+
                                          'comment.is_liked' +
                                        "</a>" +
                                        "<span class='_total_like'>"+
                                            "<span class='_like_number'>"+ comment.likes.length + "</span>" +
                                        "</span>" +
                                    "</span>" +
                                "</div>" +

                               "<div>" +
                                    "<span class='_option_unlike_wrapper'>" +
                                        "<a class=" + comment.is_unliked + "'?' '_after_unliked' : '_before_unliked'  href='#!' 'model-id=" + comment.id + 'model-type=2' + ">" +
                                            comment.is_unliked +
                                        "</a>" +
                                        "<span class='_total_unlike'>"+
                                          "<span class='_unlike_number'> " + comment.unlikes.length + "</span>" +
                                       "</span>" +
                                    "</span>" +
                                "</div>" + 
 
                        
                        "<div id='_optionCommentBtn'>" +
                            "<a class='_button' href='/blog-comment/'"+ comment.id + "'> edit </a>" +
                            "<a class='_button' href='/blog-comment/'"+ comment.id + "'> delete </a>" +
                        "</div>"+
                       
              "</div>"+
          "</div>"
       
  
      
        $('#_comment_content').append(html);
    }).fail(function(error) { 
        console.log(error)
    });
  }
 

    // $(document).on('click touchstart','._see_Notif', function() {
    //     $('._wrapper_box_Notif').show(500)
    // })

    // $(document).on('click touchstart', '._exit_Notif', function () {
    //     $('._wrapper_box_Notif').hide(500)
    // });

    $(document).on('click touchstart', '._mark_as_read', function () {
        let _this = $(this)
        let id = _this.attr('notif-id')
        markAsRead(id)
    });

    function markAsRead(id) {  
        $.ajax({
            url: '/mark_as_read/' + id,
            method: "GET",
        }).done(function (success) {
            console.log(success)
        }).fail(function (error) {
            console.log(error)
        })
    }

    // summernote
    $('#summernote').summernote();

    // slick
    $("._slick").slick({
        dots: true,
        infinite: false,
        fade: true,
        speed: 500,
        cssEase: 'linear'
    });

    // password eye
    $("._eye_icon").click(function () {
        $(this).toggleClass("_eye_icon _eye_icon_slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        }
        else {
            input.attr("type", "password");
        }
    });

    // mode price money input text
    $("input[class='_inputfile']").change(function () {
        $(this).html($(this).val());
    });

    // config jquery mask money
    // $("#_price").maskMoney({
    //     precision: 3,
    //     thousands: '.',
    //     decimal: '.',
    //     allowNegative: false,
    //     affixesStay: false
    // });

    // Jquery Ticker 
    $('.ticker').ticker();
    
    // Accordion
    let accordion = $(".accordion");
    for (i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener("click", function () {
            this.classList.toggle("active");
            if (this.previousElementSibling.style.maxHeight) {
                this.previousElementSibling.style.maxHeight = null;
            } else {
                this.previousElementSibling.style.maxHeight = this.previousElementSibling.scrollHeight + "px";
            }
        });
    }

    // Mobile menu
    $(document).on('click', '._hamburger_menu', function(e) {
        $('._hamburger_menu').toggleClass('change')
         $('._mobile_nav_menu').toggleClass('lft')
    })

})


  