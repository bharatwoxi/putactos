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
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/people_near_en.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/people_near_by_slyder.css')}}" media="all" rel="stylesheet">
    <script src="{{URL::asset('assets/registration/js/modernizr.min.js')}}"></script>

</head>
<style type="text/css">
    /* Disclaimer: remove 'powered by Google' */
    .pac-container:after {
        background-image: none !important;
        height: 0px;
    }

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
        background: transparent url(../../assets/registration/img/arrow.png) no-repeat right center;
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
<body>

@yield('content')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('assets/registration/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
<!--<script src="{{URL::asset('assets/registration/js/jquery-1.10.2.min.js')}}"></script>-->
<script src="{{URL::asset('assets/registration/js/plugin.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/main.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/jquery.min.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('assets/registration/js/bootstrap-slider.js')}}"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
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
        alert("Geocoder failed");
        $('#selectedLocation').html('{{Auth::user()->city}} {{Auth::user()->country}}');
        getUserData(0,0);
    }

    function initializeGetLocation() {
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
                    <?php
                    /*
                    k:lat
                    D:long
                    */
                    ?>
                    var latlogAfterParse = [ ];
                    for (var prop in latlng) {
                        latlogAfterParse.push(latlng[prop]);
                    }

                    getUserData(latlogAfterParse[0],latlogAfterParse[1]);
                }
                if (results[1]) {
                    //formatted address
                    //find country name
                    $('#selectedLocation').html(results[2]['formatted_address']);
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
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }

    function getUserData(lat,long){

        var mydata = 'latitude='+lat+'&longitude='+long+'&skip='+0+'&take='+4+'&isFilter='+0+'&isScroll='+0;
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
    var isPreviousEventComplete = true;
    $(window).scroll(function () {
        if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
            var isDataAvailable = $('#isDataAvailable').val();

            if (isPreviousEventComplete && isDataAvailable==1) {
                isPreviousEventComplete = false;
                //$(".LoaderImage").css("display", "block");
                var skip = $('#skip').val();
                var take = $('#take').val();
                var isFilter = $('#isFilter1').val();
                $('#skip').remove();
                $('#take').remove();
                $('#isDataAvailable').remove();

                $("#loaderImage").css("display", "block");
                if(isFilter==1){
                    var mydata = 'isFilter='+isFilter+'&isScroll='+1;
                }else{
                    var mydata = 'skip='+skip+'&take='+take+'&isFilter='+isFilter+'&isScroll='+1;
                }

                $.ajax({
                    type: "GET",
                    url: "{{URL::to('/').'/search/results/login=true'}}", //Where to make Ajax calls
                    dataType:"html", // Data type, HTML, json etc.
                    data:mydata, //Form variables
                    success: function (result) {
                        $("#loaderImage").css("display", "none");
                        if (result == '1'){  //When data is not available
                            //isDataAvailable = false;
                        }
                        else{
                            $('#container').append(result);
                            //if(isFilter!=1){
                                skip = skip + take;
                            //}
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
            var hips = 0;
            var bust = 0;
            var waist = 0;
            var penis = 0;
            //var cup = 0;
            if($('#hips').val()!=''){
                hips = $('#hips').val();
            }
            if($('#bust').val()!=''){
                bust = $('#bust').val();
            }
            if($('#waist').val()!=''){
                waist = $('#waist').val();
            }
//            if($('#cup').val()!=''){
//                cup = $('#cup').val();
//            }
            if($('#penis').val()!=''){
                penis = $('#penis').val();
            }
            searchFilters.push({name: 'hips', value:hips },{name: 'bust', value: bust},{name: 'waist', value: waist},{name: 'penis', value: penis},{name: 'isFilter', value:1},{name: 'isScroll', value:0},{name: 'skip', value:0},{name: 'take', value:3});
            $("#loaderImage").css("display", "block");
            $.ajax({
                type: "GET",
                url: "{{URL::to('/').'/advance/search/login=true'}}", //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                data:searchFilters, //Form variables
                success: function (result) {
                    $("#loaderImage").css("display", "none");
                    $('#container').html(result);
                    console.log(this.url);
                },
                error: function (error) {
                    $("#loaderImage").css("display", "none");
                    console.log(this.url);
                    alert(error);
                }
            });
        });
        $("#hips, #bust, #waist, #penis").slider({});
        $(".gender_male").click(function() {
            //var value = $("#gender_male").val();
            $('#women_only').hide();
            $('#men_only').show();
        });
        $(".gender_female").click(function() {
            //var value = $("#gender_female").val();
            $('#women_only').show();
            $('#men_only').hide();
        });
    });
</script>

<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initializeAutoSuggest() {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('currentLocation')),
            { types: ['geocode'] });
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });
    }

    // [START region_fillform]
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        /* Get Geo location */
        var obj = '';
        /* Traverse Array To get City & Country*/
        for (var i = 0, l = place.address_components.length; i < l; i++) {
            obj=  obj +' '+ place.address_components[i].long_name;
        }
        /* Get Geolocation */
        var addressGeoCode = place.geometry.location;
        $('#selectedLocation').html(obj);
        var latlogAfterParse = [ ];
        for (var prop in addressGeoCode) {
            latlogAfterParse.push(addressGeoCode[prop]);
        }

        getUserData(latlogAfterParse[0],latlogAfterParse[1]);
        $('#currentLocation').val('');
    }
    initializeGetLocation();
    initializeAutoSuggest();
</script>
@include('toastr.index')
</body>
</html>