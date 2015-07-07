<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messaging</title>
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/jquery.nstSlider.css')}}" rel="stylesheet">


</head>
<style type="text/css">
    detail.htmluttonGroupForm .btn-group .form-control-feedback {
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
    #profile_image{width:70px;-moz-border-radius: 50px;	-webkit-border-radius: 50px;	border-radius: 50px;}
    #tabs ul{ list-style:none; float:left; margin:3% 0 5% 1%; padding:0; width:100%;}
    #tabs ul li{ float:left; width:100%;border-bottom: 1px solid #f74d4d;}
    #tabs ul li a{ text-decoration:none; outline:none; width:100%; float:left; color:#000}
    #tabs ul li a:hover{ background:#f74d4d; color:#fff}
    #details{width:55%}
    #profile_img{ float:left; padding:5px 15px 5px 5px}
    #profile_name{float:left; font-size:20px; margin:4% 0 0}
    #last_date{ float:right}
    #detai_msg{float:left; width:100%; margin:0 0 0 8%; }
    #msg_name{font-size:30px; float:left; width:100%;border-bottom:1px solid #c6c6c6; line-height:60px}
    #msg_detail{float:left;width:100%;margin:2% 0 0}
    #profile_name_inner{font-size:24px; float:left; margin:1% 0 0; line-height:18px; color:#f74d4d }
    #text_detail{float:left; width:100%; margin:2% 0 0}
    #msg_area{width: 100%;height: 100px;resize: none;outline:none}
    input[type="file"]{display:initial}
    detail.htmlttach{ background:url(img/atach.png) no-repeat;}
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
    #msg_desc{float:left; width:100%;  }
</style>

<body>
@yield('content')

<!--footer-->
@include('footer.index')
<!--footer ends here-->

<script src="{{URL::asset('assets/registration/js/jquery-1.11.0.min.js')}}"></script>

<!-- 4. Add nstSlider.js after jQuery -->
<script src="{{URL::asset('assets/registration/js/jquery.nstSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
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

    // Call methods and such...
    /* var highlightMin = Math.random() * 20,
     highlightMax = highlightMin + Math.random() * 80;
     $('.nstSlider').nstSlider('highlight_range', highlightMin, highlightMax);*/
</script>
</body>
</html>