<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 23/1/15
 * Time: 2:51 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Information</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('public/assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/edit_info.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/bootstrap-slider.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/datepicker/css/datepicker.css')}}" media="all" rel="stylesheet">
    <style>
        /* Disclaimer: remove 'powered by Google' */
        .pac-container:after {
            background-image: none !important;
            height: 0px;
        }
        #buttonGroupForm .btn-group .form-control-feedback {
            top: 0;
            right: -30px;
        }

        /*select {*/
            /*background-color: #fff!important;*/
            /*color: #333!important;*/
            /*padding-right: 16px;*/
            /*width: auto;*/
            /*height: 22px;*/

            /*-webkit-border-radius: 3px;*/
            /*-moz-border-radius: 3px;*/
            /*border-radius: 3px;*/

        /*}*/

        /*.select-wrapper1{*/
            /*float: left;*/
            /*display: inline-block;*/
            /*border: 1px solid #d8d8d8;*/
            /*background: url("../img/arrow.png") no-repeat right center;*/
            /*cursor: pointer;*/
            /*box-shadow: inset 1px 1px 5px 0px #C7C1C1;*/
            /*opacity: 0.9;*/
            /*background-color: #fff;*/
        /*}*/
        /*.select-wrapper1, .select-wrapper1 select{*/
            /*width: 100px;*/
            /*height: 30px;*/
            /*border-radius: 3px;*/
        /*}*/
        /*.select-wrapper1 .holder{*/
            /*display: block;*/
            /*margin: 0 35px 0 5px;*/
            /*white-space: nowrap;*/
            /*overflow: hidden;*/
            /*cursor: pointer;*/
            /*position: relative;*/
            /*z-index: -1;*/
        /*}*/
        /*.select-wrapper1 select{*/
            /*margin: 0;*/
            /*position: absolute;*/
            /*z-index: 2;*/
            /*cursor: pointer;*/
            /*outline: none;*/
            /*opacity: 0;*/


        /*}*/

    </style>
</head>
<body onload="initialize()">
@yield('content')

</body>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="{{URL::asset('public/assets/registration/js/bootstrap.min.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('public/assets/registration/js/bootstrap-slider.js')}}"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        /* Example 2 */
        $("#ex2").slider({});
        $('#birth_date').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select").each(function(){
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');

        $(".custom-select1").each(function(){
            $(this).wrap("<span class='select-wrapper1'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select1").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');


        var counter = 2;

        $("#addButton1").click(function (e) {
            e.preventDefault();
            if(counter>7){
                alert("Only 7 textboxes allow");
                return false;
            }

            var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<div class="input-group " style="padding-top: 5px;"> <label for="day" class="col-sm-1 control-label" style="padding-left: 0; font-weight:bold">Day</label><div class="col-sm-3 selectContainer ">' +
                ' <span class="select-wrapper1" name="textboxto' + counter + '"><select class="fonza custom-select1" name="avail_day" "' + counter + '" > <option value="1" selected="selected">MON</option> </select></span> </div><label for="Name" class="col-sm-1 control-label" style="padding-left: 0;">Time</label>                                           <div class="col-sm-3 selectContainer "><span class="select-wrapper1" name="textboxto' + counter + '"><select class="fonza custom-select1" id="name" name="textboxfrom' + counter + '" id="textbox' + counter + '" value="" ><option name="textboxto' + counter + '" id="textbox' + counter + '" value=""></option><option name="textboxto' + counter + '" id="textbox' + counter + '" value="blue">Day</option>  <option name="textboxto' + counter + '" id="textbox' + counter + '" value="green">Time</option><option name="textboxto' + counter + '" id="textbox' + counter + '" value="red">To</option></select></span></div>                                        <label for="Name" class="col-sm-1 control-label" style="text-align: left;">to</label>                                       <div class="col-sm-3 selectContainer "><span class="select-wrapper1" name="textboxto' + counter + '"><select class="fonza custom-select1" id="name" name="textboxto' + counter +
                '" id="textbox' + counter + '" value="" ><option name="textboxto' + counter + '" id="textbox' + counter + '" value=""></option><option name="textboxto' + counter + '" id="textbox' + counter + '" value="blue">Day</option>  <option name="textboxto' + counter + '" id="textbox' + counter + '" value="green">Time</option><option name="textboxto' + counter + '" id="textbox' + counter + '" value="red">To</option></select></span></div></div>	');






            newTextBoxDiv.appendTo("#TextBoxesGroup");


            counter++;
        });

        $("#removeButton1").click(function (e) {
            e.preventDefault();
            if(counter==1){
                alert("No more textbox to remove");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });
        $("#addButton,#removeButton").click(function (e) {
            e.preventDefault();
        });
        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profileImagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profilePicture").change(function(){
        readURL(this);
    });

//    $(document).ready(function(){
//
//    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places"></script>
<script src="{{URL::asset('public/assets/registration/js/custom/google-place.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/datepicker/js/bootstrap-datepicker.js')}}"></script>
@include('toastr.index')
</html>
