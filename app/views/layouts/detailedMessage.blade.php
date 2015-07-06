<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messaging</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/jquery.nstSlider.css')}}" rel="stylesheet">


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
    #profile_image{width:80px;-moz-border-radius: 50px;	-webkit-border-radius: 50px;	border-radius: 50px;}
    #tabs ul{ list-style:none; float:left; margin:3% 0 5% 1%; padding:0;}
    #tabs ul li{ float:left; width:100%;border-bottom: 1px solid #f74d4d;}
    #tabs ul li a{ text-decoration:none; outline:none; width:100%; float:left; color:#000}
    #tabs ul li a:hover{ background:#f74d4d; color:#fff}
    #details{width:55%}
    #profile_img{ float:left; padding:18px 15px 5px 5px; }
    #profile_name{float:left; font-size:20px; margin:4% 0 0}
    #last_date{ float:right}
    #detai_msg{float:left; }
    #msg_name{font-size:30px; float:left; width:100%;border-bottom:1px solid #f74d4d; line-height:60px}
    #msg_detail{float:left;width:100%;margin:2% 0 0}
    #profile_name_inner{font-size:22px; float:left; margin:2.5% 0 0; line-height:18px; color:#f74d4d;background-color: #ddd;    padding: 10px; word-wrap: break-word;}
    #profile_name_inner_user{font-size:24px; float:left; margin:2.5% 0 0; line-height:18px; color:#FFF;background-color: #fc4b47;  padding: 10px; word-wrap: break-word;}
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
    #reply_msg{float:left; width:100%; background:#c6c6c6; margin:-1% 0 0 }
    .btn-primary:hover{color: #6c6c6c;  background:none;  border:none; }
    #reply{float:right; margin:1.5% 1% 0 0}
    #msg_desc{float:left; width:100%; }
</style>

<body>
@yield('content')

<!--footer-->
<div class="col-lg-12" style="background-image:url(../../assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-3">
                <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f; padding-left: 70px;">
                <h4 style="margin-bottom: 20px;">GET IN TOUCH</h4>
                <p><a href="#" ><img src="{{URL::asset('assets/registration/img/tele.png')}}" style="width:52px"></a>         <strong>1-800-355-2626</strong> </p>
                <P><a href="#" ><img src="{{URL::asset('assets/registration/img/msg.png')}}" style="width:52px"></a>      <strong>abc@putactos.com</strong>
                </P>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f; height: 175px;">
                <ul style="list-style:none">
                    <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">ABOUT US</a></li>
                    <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">MEDIA </a></li>
                    <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">TESTIMONIALS </a></li>
                    <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">CAREERS</a></li>
                    <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">FAQ'S</a></li>
                </ul>
            </div>

        </div>


    </div><!-- CONTAINER ENDS HERE-->
</div>

<!--footer ends here-->
<script src="{{URL::asset('assets/registration/js/jquery-1.11.0.min.js')}}"></script>

<!-- 4. Add nstSlider.js after jQuery -->
<script src="{{URL::asset('assets/registration/js/jquery.nstSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/jquery-ui.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/characterCount.min.js')}}"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script>
    $('.nstSlider').nstSlider({
        "left_grip_selector": ".leftGrip",
        "right_grip_selector": ".rightGrip",
        "value_bar_selector": ".bar",
        "value_changed_callback": function(cause, leftValue, rightValue) {
            $(this).parent().find('.leftLabel').text(leftValue);
            $(this).parent().find('.rightLabel').text(rightValue);
        }
    });
    var lastScrollTop = 0;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() > $(document).height()-200) {
            $('#message-loader-down').show();
            $.ajax({
                type: "GET",
                async:false,
                url: "{{URL::to('/messages/xyz/?isScroll=1')}}", //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    $('#message-div').append(result);
                    $('#message-loader-down').hide();
                },
                error: function (error) {
                    $('#message-loader-down').hide();
                    alert(error);
                }
            });
        }
    });
    $("#msg_area").counter({
        count: 'up',
        goal: 150,
        append: false,
        target: '#character-message'
    });
    function postNewMessage(toUserId){
        var message = $.trim($('#msg_area').val());
        if(message==''){
            $('#msg_area').val('');
            alert('Please enter message');
        }else{
            $('#message-loader-down').show();
            var customerData = 'to_id='+toUserId+'&message='+message;
            $('#msg_area').val('');
            $.ajax({
                type: "POST",
                async:false,
                url: "{{URL::to('/message-add-new')}}", //Where to make Ajax calls
                data:customerData,
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //console.log("Insert Result : " + result);
                    $('#message-loader-down').hide();
                    $('#message-div').prepend(result);
                },
                error: function (error) {
                    $('#message-loader-down').hide();
                    alert(error);
                }
            });
        }
    }
</script>
</body>
@include('toastr.index')
</html>