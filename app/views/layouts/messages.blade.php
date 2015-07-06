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

    #tabs ul{ list-style:none;width:40%; float:left; margin:3% 0 0 1%; padding:0;height: 700px;overflow-x: hidden;}
    #tabs ul li{ float:left; width:100%;border-bottom: 1px solid #c6c6c6;}
    #tabs ul li a{ text-decoration:none; outline:none; width:100%; float:left; color:#000}
    #tabs ul li a:hover{ background:#f74d4d; color:#fff}
    #details{width:55%}
    #profile_img{ float:left; padding:5px 15px 5px 5px}
    #profile_name{float:left; font-size:20px; margin:4% 0 0}
    #last_date{ float:right}
    #detai_msg{float:left; width:100%; margin:0 0 0 8%; }
    #msg_name{font-size:30px; float:left; width:100%;border-bottom:1px solid #c6c6c6; line-height:60px}
    #msg_detail{float:left;width:100%;margin:2% 0 0}
    #profile_name_inner{font-size:24px; float:left; margin:1% 0 0; line-height:18px; color:#f74d4d;width:85% }
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
    #msg_desc{float:left; width:100%; height:510px; overflow-x:hidden}
    .high-light{background-color:#f74d4d;color:#fff;}
</style>
<script src="{{URL::asset('assets/registration/js/jquery-1.8.2.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/jquery-ui.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/characterCount.min.js')}}"></script>

<script>
    $(function() {
        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    });
</script>
<script>
    /* Character Count */

</script>
<body>


@yield('content')



<div class="col-lg-12" style="background-image:url(../../assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-4">
                <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f;">
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
</body>
<script>
    $(document).ready(function() {
        //$("#loaderImage").css("display", "block");
        $.ajax({
            type: "GET",
            url: "{{URL::to('/').'/messages/userlist?isScroll=0'}}", //Where to make Ajax calls
            dataType:"html", // Data type, HTML, json etc.
            success: function (result) {
                $('#remove').remove();
                $('#user_list').append(result);
                console.log(this.url);
            },
            error: function (error) {
                alert(error);
            }
        });
    });
    var lastScrollTop = 0;
    $('#user_list').on('scroll', function(){//.box is the class of the div
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            $('#userLoaderDown').show();
            //alert(1); //For Scroll Down
            $.ajax({
                type: "GET",
                url: "{{URL::to('/').'/messages/userlist?isScroll=1'}}", //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    $('#user_list').append(result);
                },
                error: function (error) {
                    $('#userLoaderDown').hide();
                    alert(error);
                }
            });
        } else {
            //alert(2); //For Scroll Up
        }
        lastScrollTop = st;
    });
</script>
<script>
    function getMessage(fromId,toId){
        $('#messageLoaderUp').show();
        $.ajax({
            type: "GET",
            url: "{{URL::to('/').'/get/messages?from_id="+fromId+"&to_id="+toId+"&isScroll=0'}}", //Where to make Ajax calls
            dataType:"html", // Data type, HTML, json etc.
            success: function (result) {
                $('#messageLoaderUp').remove();
                $('#message_data').html(result);
                $('#msg_desc').css({'height':(($(window).height())-300)+'px'});
                $("#msg_desc").animate({ scrollTop: $(document).height() }, 1000);
                $("#msg_area").counter({
                    count: 'up',
                    goal: 150,
                    append: false,
                    target: '#character-message'
                });
                var lastScrollTopMessage = 0;
                $('#msg_desc').on('scroll', function(){
                    var x = $('#msg_desc').scrollTop();
                        if (x > lastScrollTopMessage){
                          //For Scroll Down
                        } else {
                            $('#messageLoaderUp').show();
                            if($('#msg_desc').scrollTop() == 0){ //Detect Maximum Scroll Top
                                $.ajax({
                                    type: "GET",
                                    url: "{{URL::to('/').'/get/messages?isScroll=1'}}", //Where to make Ajax calls
                                    dataType:"html", // Data type, HTML, json etc.
                                    success: function (result) {
                                        $('#messageLoaderUp').remove();
                                        var className = '.'+$('#newClassName').val();
                                        console.log('Classname:'+className);
                                        $('#newClassName').remove();
                                        $(className).before(result);
                                    },
                                    error: function (error) {
                                        $('#messageLoaderUp').hide();
                                        alert(error);
                                    }
                                });
                            }else{
                                //alert(2);
                            }
                        }
                    lastScrollTopMessage = x;
                });
                console.log(this.url);
            },
            error: function (error) {
                $('#messageLoaderUp').hide();
                alert(error);
            }
        });
    }

    function postNewMessage(toUserId){
        var message = $.trim($('#msg_area').val());
        if(message==''){
            $('#msg_area').val('');
            alert('Please enter message');
        }else{
            $('#messageLoaderDown').show();
            var customerData = 'to_id='+toUserId+'&message='+message;
            $('#msg_area').val('');
            $.ajax({
                type: "POST",
                url: "{{URL::to('/').'/messages/addnew'}}", //Where to make Ajax calls
                data:customerData,
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    console.log("Insert Result : " + result);
                    var textarea = document.getElementById('msg_desc');
                    textarea.scrollTop = textarea.scrollHeight;
                    $('#messageLoaderDown').hide();
                    $('#messageLoaderDown').before(result);
                },
                error: function (error) {
                    $('#messageLoaderDown').hide();
                    alert(error);
                }
            });
        }
    }

</script>
@include('toastr.index')
</html>