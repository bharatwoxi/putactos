<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('public/assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/star_rating/css/star-rating.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('public/assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- <link href="{{URL::asset('public/assets/registration/css/styles.css')}}" media="all" rel="stylesheet">-->
    <link href="{{URL::asset('public/assets/registration/css/jquery.nstSlider.css')}}" rel="stylesheet">


</head>
<style type="text/css">
    #buttonGroupForm .btn-group .form-control-feedback {
        top: 0;
        right: -30px;
    }

    select {
        background-color: #fff!important;
        color: #333!important;
        padding-right: 16px;
        width: auto;
        height: 22px;

        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;

    }
    input:first-child, input#f {
        -webkit-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -moz-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        left: -5px!important;
    }
    .mini_nav a{
        color:#ff9a9a;
        font-family:Calibri;
        font-size:16px;
    }

    .mini_nav a:hover{
        color:#fff;
        font-weight:bold;
        text-decoration:none;


    }
    /*.lan_nav a{
        color:#ff9a9a;
        font-size:36px;
        }

    .lan_nav a:hover{
        text-decoration:underline;

        }
    */
    .txt{ height:55px; width:285px;; font-size:28px; border-radius: 5px 0px 0px 5px;
        -moz-border-radius: 5px 0px 0px 5px;
        -webkit-border-radius: 5px 0px 0px 5px;
        border: 3px solid #f74d4d; float:left; outline:none; padding:0 5px}
    .search{ float:left; margin:0 0 0}

    #tabs ul{ list-style:none;width:40%; float:left; margin:3% 0 0 1%; padding:0;height: 700px;overflow-x: hidden;}
    #tabs ul li{ float:left; width:100%;border-bottom: 1px solid #c6c6c6;}
    #tabs ul li a{ text-decoration:none; outline:none; width:100%; float:left; color:#000}
    #tabs ul li a:hover{ background:#f74d4d; color:#fff}
    #details{width:55%}
    #profile_img{ float:left; padding:5px 15px 5px 5px}
    #profile_name{ font-size:32px; margin:4% 0 0; color:#f94d4d}
    #last_date{ float:right}
    #detai_msg{float:left; width:100%; margin:0 0 0 8%; }
    #msg_name{font-size:30px; float:left; width:100%;border-bottom:1px solid #c6c6c6; line-height:60px}
    #msg_detail{float:left;width:100%;margin:2% 0 0}
    #profile_name_inner{font-size:24px; float:left; margin:1% 0 0; line-height:18px; color:#f74d4d }
    #text_detail{float:left; width:100%; margin:2% 0 0}
    #msg_area{width: 100%;height: 100px;resize: none;outline:none}
    input[type="file"]{display:initial}
    #attach{ background:url(img/atach.png) no-repeat;}
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .btn-primary{color: #6c6c6c;  background:none;  border:none; }
    #reply_msg{float:left; width:100%; background:#f74d4d; margin:-1% 0 0;color:#fff }
    .btn-primary:hover{color: #6c6c6c;  background:none;  border:none; }
    #reply{float:right; margin:1.5% 1% 0 0}
    #msg_desc{float:left; width:100%; height:510px; overflow-x:hidden}

    #profile_details{float:left; font-family:Roboto Th;  }

    #profile_description{  font-size:20px; line-height:28px;font-family:Roboto Th  }
    #border_bottom{border-bottom:1px solid #c6c6c6;; float:left;width: 100%;margin: 3% 0;font-family:Roboto Th}
    #profile_time td{padding:0 5px}
    #msg_search{padding:0}
    #profile_decp{ float:left;  padding:0}
    #personal_detail{padding:0; float:left}
    #user_profile{ float:left; padding:0}
    #day{border:1px solid #ccc; border-radius:5px;font-weight:bold; padding:0 5px}
    #days{border:1px solid #ccc; border-radius:5px; background:#ccc; font-weight:bold;padding:0 5px}
    #time td{  padding:0 10px 0 0}
    #time_head{color:#f94d4d}
    #feed_img{float: left;width: 20%;}
    #feed_detail{float:left; width:48%}
    #feed_detail p{margin: 0 0 15px;line-height: 14px;}
    #feed_rate{ float:left;}
    #feedback_customer{ border-bottom:2px solid #ab4a5b; float:left; }
    #msg{margin:5% 0 0}
    #star_rating{margin:2% 0 0; width:100%}
    #availability{ float:left}
    #profile_thumb{ float:left; padding:0}
    #feed_detail_txt textarea{width:100%; height:150px; resize:none;overflow: scroll;overflow-x: hidden;}
    #feedback_customer_txt{ float:left;}
    #submit_feedback{border:2px solid #fa4d51; padding:2px 6px; text-align:center;font-weight: bold;color: #fa4d51;border-radius: 5px; float:left; font-size:12px; }
    #feed_rating{padding:0 ; float:left}
    #customer_feedback{ height:390px;overflow: scroll;overflow-x: hidden;}
    .rating-cancel{display:none !important}
    #tab-Overview{float:left; padding:5px 0; width:120px}

    #mask {
        display: none;
        position: fixed; left: 0; top: 0;
        z-index: 10;
        width: 100%; height: 100%;
        z-index: 999;
        background:#000; opacity:0.7;
    }

    .login-popup{
        display:none;
        padding: 0;
        float: left;
        font-size: 1.2em;
        position: fixed;
        top: 50%; left: 50%;
        z-index: 99999;
        background:#fff;
        border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */

    }
    fieldset{border:none}
    img.btn_close {
        float: right;
        margin: 0;
    }

    form.signin .textbox input {
        color:#fff;
        border-radius: 3px 3px 3px 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        font:13px;
        padding:6px 6px 4px;
        width:200px;
    }
    #reply_msg{ margin:-2% 0 0}
    .new_msg{ background:#f74d4d; padding:3px 0 3px 5px;color:#fff}
    .to_name{ border:none; outline:none; }
</style>
<script src="{{URL::asset('public/assets/registration/js/jquery.js')}}" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

<script>
//    $(function() {
//        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
//        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
//    });
</script>
<body>
@yield('content')
@include('footer.index')

<!-- 4. Add nstSlider.js after jQuery -->

<script src="{{URL::asset('public/assets/registration/js/jquery-1.11.0.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/star_rating/js/star-rating.min.js')}}" type="text/javascript"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script>
    $(document).ready(function(){
        // initialize with defaults
        //http://plugins.krajee.com/star-rating
        $(".original_star").rating();

        // with plugin options
        $('.original_star').on('rating.change', function(event, value, caption) {
            $('#star_rating_original').val(value);
        });
        $('.original_star').on('rating.clear', function(event) {
            $('#star_rating_original').val(0);
        });
        $('.original_star').on('rating.reset', function(event) {
            $('#star_rating_original').val(0);
        });
        $('#submit_feedback').click(function(e){
            e.preventDefault();
            $('#saveFeedback').submit();
        });
        $('#star_rating').find('.clear-rating').remove();
        $('.feed_rate').find('.clear-rating').remove();
        $('.feed_rate').find('.caption').remove();
        var lastScrollTop = 0;
        $('#customer_feedback').on('scroll', function(){//.box is the class of the div
            if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
                $('#feedback_loader').show();
                $.ajax({
                    type: "GET",
                    async:false,
                    url: "{{URL::to('/more/feedbacks')}}", //Where to make Ajax calls
                    dataType:"html", // Data type, HTML, json etc.
                    success: function (result) {
                        $('#feedback_loader').hide();
                        $('#customer_feedback').append(result);
                        $(".original_star").rating();
                        $('.feed_rate').find('.clear-rating').remove();
                        $('.feed_rate').find('.caption').remove();
                    },
                    error: function (error) {
                        $('#feedback_loader').hide();
                        alert(error);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('a.login-window').click(function() {

            // Getting the variable's value from a link
            var loginBox = $(this).attr('href');

            //Fade in the Popup and add close button
            $(loginBox).fadeIn(300);

            //Set the center alignment padding + border
            var popMargTop = ($(loginBox).height() + 24) / 2;
            var popMargLeft = ($(loginBox).width() + 24) / 2;

            $(loginBox).css({
                'margin-top' : -popMargTop,
                'margin-left' : -popMargLeft
            });

            // Add the mask to body
            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);

            return false;
        });
        $('#send_new_msg').click(function(e) {
            e.preventDefault();
            var message = $.trim($('#msg_area').val());
            var toUserId = $('#to_id').val();
            if(message==''){
                $('#msg_area').val('');
                alert('Please enter message');
            }else{
                var customerData = 'to_id='+toUserId+'&message='+message;
                $('#msg_area').val('');
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('/').'/messages/addnew'}}", //Where to make Ajax calls
                    data:customerData,
                    //dataType:"html", // Data type, HTML, json etc.
                    success: function (result) {
                        $('#mask').remove();
                        $('#login-box').hide();
                        $('#myModal').modal('show');
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
            }
        });

    });
    // When clicking on the button close or the mask layer the popup closed
    $('a.close, #mask').on('click', function() {
        $('#mask , .login-popup').fadeOut(300 , function() {
            $('#mask').remove();
        });
        return false;
    });
    $('#no_feedback').on('click', function(ev) {
        ev.preventDefault();
        alert(1);
        $('#myModal').modal('show');


        // $("#results").text(data);


    });
</script>
@include('toastr.index')
</body>
</html>