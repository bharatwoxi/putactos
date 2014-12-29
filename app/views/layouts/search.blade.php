<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 15/12/14
 * Time: 11:37 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PEOPLE NEARBY</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('public/assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <script src="{{URL::asset('public/assets/registration/js/modernizr.min.js')}}"></script>

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
    select:first-child, select#f {
        -webkit-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -moz-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: transparent url(../../public/assets/registration/img/arrow.png) no-repeat right center;
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


</style>
<body onload="initialize()">

@yield('content')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('public/assets/registration/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('public/assets/registration/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/plugin.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/main.js')}}"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var geocoder;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
    }
    //Get the latitude and the longitude;
    function successFunction(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        codeLatLng(lat, lng)
    }

    function errorFunction(){
        //alert("Geocoder failed");
        getUserData(0,0);
    }

    function initialize() {
        geocoder = new google.maps.Geocoder();



    }

    function codeLatLng(lat, lng) {

        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                //console.log(results);
                var json_data = JSON.stringify(results);
                if(json_data=='Geocoder failed'){
                    alert(1);
                }else{
                    //alert(json_data);
                    results.forEach(function(entry) {
                        if(entry.types=='route'){
                            <?php
                            /*
                            k:lat
                            D:long
                            */
                            ?>
                            //console.log(entry.geometry.location);
                            getUserData(entry.geometry.location.k,entry.geometry.location.D);
                        }
                    });


                }
                if (results[1]) {
                    //formatted address
                    //alert(results[0].formatted_address)
                    //find country name
                    for (var i=0; i<results[0].address_components.length; i++) {
                        for (var b=0;b<results[0].address_components[i].types.length;b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                            if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                //this is the object you are looking for
                                city= results[0].address_components[i];
                                break;
                            }
                        }
                    }
                    //city data
                    //alert(city.short_name + " " + city.long_name)


                } else {
                    //alert("No results found");
                }
            } else {
                //alert("Geocoder failed due to: " + status);
            }
        });
    }

    function getUserData(lat,long){

        var mydata = 'latitude='+lat+'&longitude='+long+'&skip='+0+'&take='+4+'&isFilter='+0+'&isScroll='+1;
        //##### Send Ajax request to response.php #########
        $("#loaderImage").css("display", "block");
        $.ajax({
            type: "GET", // HTTP method POST or GET
            url: "{{URL::to('/').'/search/results/login=true'}}", //Where to make Ajax calls
            dataType:"html", // Data type, HTML, json etc.
            data:mydata, //Form variables
            success:function(response){
                $('#container').html(response);
                $("#loaderImage").css("display", "none");
            },
            error:function (xhr, ajaxOptions, thrownError){
                //On error, we alert user
                $("#loaderImage").css("display", "none");
                alert(thrownError);
            }
        });
    }
</script>
<script type="text/javascript">
    var skip = 8;
    var take = 4;
    var isPreviousEventComplete = true;
    var isDataAvailable = true;
    $(window).scroll(function () {
        if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
            if (isPreviousEventComplete && isDataAvailable) {

                isPreviousEventComplete = false;
                //$(".LoaderImage").css("display", "block");
                var mydata = 'skip='+skip+'&take='+take+'&isFilter='+0+'&isScroll='+1;
                $("#loaderImage").css("display", "block");
                $.ajax({
                    type: "GET",
                    url: "{{URL::to('/').'/search/results/login=true'}}", //Where to make Ajax calls
                    dataType:"html", // Data type, HTML, json etc.
                    data:mydata, //Form variables
                    success: function (result) {
                        $("#loaderImage").css("display", "none");
                        if (result == '1'){  //When data is not available
                            isDataAvailable = false;
                        }
                        else{
                            $('#container').append(result);
                            skip = skip + take;
                            isPreviousEventComplete = true;
                        }
                    },
                    error: function (error) {
                        alert(error);
                    }
                });

            }
        }
    });
    $(document).ready(function(){
        $('#advanceSearch').submit(function(event){
            event.preventDefault();
            var searchFilters = $('#advanceSearch').serializeArray();
            searchFilters.push({name: 'hips', value: $('#hips').val()},{name: 'bust', value: $('#bust').val()},{name: 'waist', value: $('#waist').val()},{name: 'cup', value: $('#cup').val()},{name: 'isFilter', value:1});

            $.ajax({
                type: "GET",
                url: "{{URL::to('/').'/advance/search/login=true'}}", //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                data:searchFilters, //Form variables
                success: function (result) {
                    console.log(this.url);
                },
                error: function (error) {
                    console.log(this.url);
                    alert(error);
                }
            });
        });
    });
</script>
</body>
</html>