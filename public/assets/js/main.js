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

    $(document).on('click touchstart', '._mark_as_read', function () {
        let _this = $(this)
        let id = _this.attr('notif-id')
        markAsRead(id)
    });


    // MARK AS READ
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

    // SUMMERNOTE
    // $('#summernote').summernote();

    // CONFIG SLICK
    $("._slick").slick({
        dots: true,
        infinite: false,
        fade: true,
        speed: 500,
        cssEase: 'linear'
    });

    // PASSWORD EYE
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

    // JQUERY TICKER
    $('.ticker').ticker();
    
    // ACCORDION
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

    // MOBILE MENU
    $(document).on('click', '._hamburger_menu', function(e) {
        $('._hamburger_menu').toggleClass('change')
         $('._mobile_nav_menu').toggleClass('lft')
    })    

});



  