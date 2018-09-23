// REGISTER FORM DIALOG

$(document).ready(function() {

    var dialog, form,

    emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,

    name = $("#username"),

    email = $("#email"),

    password = $("#password"),

    confirmPassword = $("#password-confirm"),

    allFields = $([]).add(name).add(email).add(password),

    tips = $(".validateTips");

    function updateTips(t) {

      tips.text(t).addClass("ui-state-highlight");
      setTimeout(function() {
        tips.removeClass("ui-state-highlight", 1000);
      }, 1000 );

    }

    function checkRequired(o, n) {

      if ( o.val().length == '' ) {
        o.addClass( "ui-state-error" );
        updateTips( n + ' required ' );
        return false;
      }
      else {
        return true;
      }

    }

    function checkSameConfirmPassword(password, passwordconfirm) {

      if ( password.val().length != passwordconfirm.val().length ) {
        passwordconfirm.addClass( "ui-state-error" );
        updateTips( 'Password confirm must be match password field' );
        return false;
      }
      else {
        return true;
      }

    }

    function checkMinimalPassword(o, min) {

      if ( o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips(  "Length of password" + " minimal " + min + "." );
        return false;
      }
      else {
        return true;
      }

    }

    function checkLength( o, n, max ) {

      if ( o.val().length > max ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " maximal " + max + "." );
        return false;
      }
      else {
        return true;
      }

    }

    function checkRegexp( o, regexp, n) {

    if ( !(regexp.test(o.val())) ) {
      o.addClass( "ui-state-error" );
      updateTips( n );
      return false;
      }
      else {
        return true;
      }

    }


    function addUser() {

      var valid = true;
      allFields.removeClass( "ui-state-error" );

      valid = valid && checkRequired( name, "username");
      valid = valid && checkRequired( email, "email");
      valid = valid && checkRequired( password, "password");

      valid = valid && checkLength( name, "username", 15);
      valid = valid && checkLength( email, "email", 50);
      valid = valid && checkLength( password, "password", 255);

      valid = valid && checkMinimalPassword(password, 6);

      valid = valid && checkSameConfirmPassword( password, confirmPassword);

      valid = valid && checkRegexp( name, /^(?=[^A-Z0-9])[a-z_0-9]+$/, "Username may consist of a-z, 0-9, allow underscores without spaces and must begin with a lowercase letter." );
      valid = valid && checkRegexp( email, emailRegex, "Email invalid format. eg. Basuketto@hello.io" );
      valid = valid && checkRegexp( password, /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$#!%*?&])[A-Za-z\d$@$#!%*?&]/, "Minimum 6 characters, at least one uppercase letter, one lowercase letter, one number and one special character" );

      if(valid) {
        $('#form-register').submit();
      }

    }

    $( "#register-form" ).dialog({
       autoOpen: false,
       height: "auto",
       width: 400,
       modal: true,
       buttons: {
         "Register": addUser,
         Cancel: function() {
            document.forms[0].reset();
           $(this).dialog( "close" );
         }
       }
    });

    $("#trigger-button-register").click(function() {
      $("#register-form").dialog('open');
    });

    $('#showPassword').click(function(){
      var password = document.getElementById("password");
      var passwordConfirm = document.getElementById("password-confirm");
      if (password.type === "password" && passwordConfirm.type === "password") {
          password.type = "text";
          passwordConfirm.type = "text";
      } else {
          password.type = "password";
          passwordConfirm.type = "password";
      }
    });

});
