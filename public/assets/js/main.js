$(document).ready(function() {

  $('.richTextBox').summernote();

  // tinymce.init({
  //   selector: '.richTextBox',
  //   image_caption: true,
  //   image_title: true,
  //   menubar: false,

  // OPTION 2
  // images_upload_handler: function(blobInfo, success, failure) {
  //   var xhr, formData
  //   var xhr = new XMLHttpRequest();
  //   xhr.withCredentials = false;
  //   xhr.open('POST', '/user/uploadTinymce');
  //   var token = Laravel.csrfToken;
  //   xhr.setRequestHeader("X-CSRF-Token", token);
  //   xhr.onload = function() {
  //     var json;
  //     if (xhr.status != 200) {
  //       failure('HTTP Error: ' + xhr.status);
  //       return
  //     }
  //
  //     json = JSON.parse(xhr.responseText);
  //
  //     if (!json || typeof json.location != "string") {
  //       failure('Invalid JSON: ' + xhr.responseText);
  //       return
  //     }
  //     success(json.location);
  //   }
  //   formData = new FormData();
  //   formData.append('image', blobInfo.blob(), blobInfo.filename());
  //   xhr.send(formData);
  // },

  // OPTION 1
  // file_browser_callback: function(field_name, url, type, win) {
  //
  //     if(type =='image') {
  //         $('#upload_file').trigger('click');
  //     }
  // },
  //   file_browser_callback: function(field_name, url, type, win) {
  //       win.document.getElementById(field_name).value = 'my browser value';
  //    }
  //   extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
  //   min_height: 400,
  //   resize: 'vertical',
  //   plugins: 'link, image, table, textcolor, lists, jbimage',
  //   toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code jbimage',
  // });


  // AJAX SETUP
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': Laravel.csrfToken
    }
  });

  $(document).on('click touchstart', '.before-liked', function() {
    let _this = $(this)

    let model_type = _this.attr('model-type')
    let model_id = _this.attr('model-id')
    let url = "/like/" + model_id + "/" + model_type

    $.get(url, () => {

      _this.addClass('after-liked').removeClass('before-liked')
      let likeNumber = _this.parents('.option-like-unlike-wrapper').find('.like-number')
      likeNumber.html(parseInt(likeNumber.html()) + 1)

    })

  })

  $(document).on('click touchstart', '.after-liked', function() {
    let _this = $(this)
    let model_type = _this.attr('model-type')
    let model_id = _this.attr('model-id')
    let url = "/cancel-like/" + model_id + "/" + model_type

    $.get(url, () => {

      _this.removeClass('after-liked').addClass('before-liked')
      let likeNumber = this.parents('.option-like-unlike-wrapper').find('.like-number')
      likeNumber.html(parseInt(likeNumber.html()) - 1)

    })

  })

  $(document).on('click touchstart', '.before-unliked', function() {
    var _this = $(this)

    var model_type = _this.attr('model-type')
    var model_id = _this.attr('model-id')
    var url = "/unlike/" + model_id + "/" + model_type

    $.get(url, () => {

      _this.removeClass('before-unliked').addClass('after-unliked')
      var unlikeNumber = _this.parents('.option-unlike-wrapper').find('.unlike-number')
      unlikeNumber.html(parseInt(unlikeNumber.html()) + 1)

    })

  })

  $(document).on('click touchstart', '._after_unliked', function() {
    let _this = $(this)

    let model_type = _this.attr('model-type')
    let model_id = _this.attr('model-id')
    let url = "/cancel-unlike/" + model_id + "/" + model_type

    $.get(url, () => {

      _this.removeClass('_after_unliked').addClass('before-unliked')
      let unlikeNumber = _this.parents('.option-unlike-wrapper').find('.unlike-number')
      unlikeNumber.html(parseInt(unlikeNumber.html()) - 1)

    });

  });

  $(document).on('click touchstart', '.submitComment', function() {
    let html = '';
    let subject = $('#subject').val();
    let blog_id = $(this).attr('blog-id');
    let data = [subject, blog_id, html];
    sendToAjax(...data)
  });

  // MARK AS READ NOTIFICATION

  $(document).on('click touchstart', '.get-notif', function() {
    let _this = $(this);
    let id = _this.attr('notif-id');
    markAsRead(id);
  });

  $(document).on('click touchstart', '#change-username', function() {
    let id = $('#value-change-username').attr('data-user-id');
    $('.show-change-username').css('display', 'block');
    submitChangeUsername(id)
  })

  function submitChangeUsername(id) {
    $(document).on('click touchstart', '#submit-change-username', function() {
      let name = $('#value-change-username').val();
      $.ajax({
        method: 'PUT',
        url: '/user/' + id + '/change-username/update',
        data: {
          name: name
        },
      }).done((success) => {
        toastr.info('Successfully Updated a Name!');
        location.reload();
      }).fail((error) => {
        console.log(error);
      })
    })
  }

  function markAsRead(id) {
    $.ajax({
      url: '/mark-as-read/' + id,
      method: 'GET',
    }).done(function(success) {
      console.log(success);
    }).fail(function(error) {
      console.log(error);
    })
  }

  // CONFIG SLICK
  $(".slick").slick({
    dots: true,
    infinite: false,
    fade: true,
    speed: 500,
    cssEase: 'linear'
  });

  // PASSWORD EYE
  $(".eye-icon").click(function() {
    $(this).toggleClass("eye-icon eye-icon-slash");
    let input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

  $("input[class='_inputfile']").change(function() {
    $(this).html($(this).val());
  });

  // CONFIG JQUERY MASK MONEY
  $("#price-usd").maskMoney({
    precision: 2,
    thousands: '.',
    decimal: '.',
    prefix: '$ ',
    allowNegative: false,
    affixesStay: false
  });

  $("#price-idr").maskMoney({
    precision: 3,
    thousands: '.',
    decimal: '.',
    prefix: 'Rp. ',
    allowNegative: false,
    affixesStay: false
  });

  var price_usd = $("#price-usd");
  var price_rp = $("#price-rp");

  $("#currency").on("change", function() {
    var currency = this.value;
    switch (currency) {
      case "usd":
        var string = numeral(price_usd);
        console.log(string);
        price_usd.css('display', 'block');
        price_rp.css('display', 'none');
        break;
      case "rupiah":
        price_usd.css('display', 'none');
        price_rp.css('display', 'block');
        break;
      default:
    }
    // var prefix = currency == "usd"; // or ["usd","yen",...].indexOf(curr); for more
    // var sign = currency == "usd" ? "$" : "rupiah";

  }).change();

  // JQUERY TICKER
  // $('.ticker').ticker();

  // ACCORDION
  let accordion = $(".accordion");
  for (i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener("click", function() {
      this.classList.toggle("active");
      if (this.previousElementSibling.style.maxHeight) {
        this.previousElementSibling.style.maxHeight = null;
      } else {
        this.previousElementSibling.style.maxHeight = this.previousElementSibling.scrollHeight + "px";
      }
    });
  }

  // MOBILE MENU
  $(document).on('click', '.hamburger-menu', function(e) {
    $('.hamburger-menu').toggleClass('change');
    $('.mobile-nav-menu').toggleClass('left');
  })

});
