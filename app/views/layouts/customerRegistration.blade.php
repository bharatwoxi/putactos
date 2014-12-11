<?php
/**
 * Created by PhpStorm.
 * User: sagar acharya
 * Date: 8/12/14
 * Time: 11:50 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>USER REGISTRATION</title>

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
<script>
    $(document).ready(function(){
        $('#latitude').val('');
        $('#longitude').val('');
        $('#city').val('');
        $('#country').val('');

        /* Check Form Submit */
        $('#customerRegistration').submit(function(event){

            if($('#latitude').val()!='' && $('#longitude').val()!=''){
                return true;
            }else{
                event.preventDefault();
                alert('Please select your location from google places');
            }

        });

        $('#username').keyup(function(e) {
            var username = $('#username').val();
            var mydata = 'username='+username;
            //##### Send Ajax request to response.php #########
            $.ajax({
                type: "POST", // HTTP method POST or GET
                url: "check-username", //Where to make Ajax calls
                dataType:"json", // Data type, HTML, json etc.
                data:mydata, //Form variables
                success:function(response){
                    if(response.success == false)
                    {

                        var arr = response.errors;
                        $("#display-errors").html('');
                        $.each(arr, function(index, value)
                        {
                            if (value.length != 0)
                            {
                                //$('#submit').attr('disabled','disabled');
                                $("#validation-errors").show();
                                $("#submit").attr("disabled", true);
                                $("#display-errors").append('<li class="error"><strong>'+ value +'</strong></li>');
                            }
                        });
                    }
                    else{
                        $("#validation-errors").hide();
                        $('#submit').removeAttr('disabled');
                    }



                },
                error:function (xhr, ajaxOptions, thrownError){
                    //On error, we alert user
                    alert(thrownError);
                }
            });



        });
    });
</script>
<!-- Google Places -->
<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places"></script>

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

    function initialize() {
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

        /* Traverse Array To get City & Country*/
        for (var i = 0, l = place.address_components.length; i < l; i++) {
            var obj = place.address_components[i];
            if(obj.types[0]=='country')
            /* Country Name */
            $('#country').val(obj.long_name);
            if(obj.types[0]=='locality')
            /* City Name */
            $('#city').val(obj.long_name);

        }
        /* Get Geolocation */
        var addressGeoCode = place.geometry.location;
        //console.log(place.geometry.location);
        //console.log('<span>Lat: <b>'+addressGeoCode.k+'</b></span>'+'<br><span>Long: <b>'+addressGeoCode.B+'</b></span>');
        $('#latitude').val(addressGeoCode.k);
        $('#longitude').val(addressGeoCode.B);
        $('#map-canvas').show();
        initializeGoogleMap(addressGeoCode.k,addressGeoCode.B);
        //document.getElementById('addressGeoCode').innerHTML='<span>Lat: <b>'+addressGeoCode.k+'</b></span>'+'<br><span>Long: <b>'+addressGeoCode.B+'</b></span>';
        //alert(addressGeoCode);
        /*Get Geolocation end*/
//        for (var component in componentForm) {
//            document.getElementById(component).value = '';
//            document.getElementById(component).disabled = false;
//        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
//        for (var i = 0; i < place.address_components.length; i++) {
//            var addressType = place.address_components[i].types[0];
//            if (componentForm[addressType]) {
//                var val = place.address_components[i][componentForm[addressType]];
//                document.getElementById(addressType).value = val;
//            }
//        }
    }
    // [END region_fillform]

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = new google.maps.LatLng(
                    position.coords.latitude, position.coords.longitude);
                autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                    geolocation));
            });
        }
    }
    // [END region_geolocation]


    var map;
    function initializeGoogleMap(lat,long) {
        var mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(lat,long)
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
    }

</script>
</body>
</html>