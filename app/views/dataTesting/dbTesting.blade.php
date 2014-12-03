<!doctype html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">
	<link rel="icon" href="public/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
    <script type="text/javascript" src="{{URL::asset('public/assets/dbTest/jquery/jquery-1.11.1.min.js')}}"></script>
	<script>
        $(document).ready(function(){
            var user_role = $('#userRole').val();
            if(user_role==1){
                $('#spData').hide();
                $('#customerData').show();
            }
            if(user_role==2){
                $('#spData').show();
                $('#customerData').hide();
            }
            $('#userRole').on('change', function() {
                var user_role = $('#userRole').val();
                if(user_role==1){
                    $('#spData').hide();
                    $('#customerData').show();
                }
                if(user_role==2){
                    $('#spData').show();
                    $('#customerData').hide();
                }
            });
        });
	</script>
    <style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>

    <!-- Code For Google Places -->


    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
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
                /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
                { types: ['geocode'] });
            // When the user selects an address from the dropdown,
            // populate the address fields in the form.
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
            });
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

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

    </script>

    <style>
        #locationField, #controls {
            position: relative;
            width: 480px;
        }
        #autocomplete {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 99%;
        }
        .label {
            text-align: right;
            font-weight: bold;
            width: 100px;
            color: #303030;
        }
        #address {
            border: 1px solid #000090;
            background-color: #f0f0ff;
            width: 480px;
            padding-right: 2px;
        }
        #address td {
            font-size: 10pt;
        }
        .field {
            width: 99%;
        }
        .slimField {
            width: 80px;
        }
        .wideField {
            width: 200px;
        }
        #locationField {
            height: 20px;
            margin-bottom: 2px;
        }
    </style>


    <!-- Places Code END -->
</head>
<body>
	<div class="welcome">
        {{ Form::open(array('url' => 'insert/testing-data')) }}
        {{ Form::label('username') }}
        {{ Form::text('username') }}
        {{ Form::label('password') }}
        {{ Form::password('password') }}<br/>
        {{ Form::label('email') }}
        {{ Form::text('email') }}<br/>
        {{ Form::label('birthdate') }}
        {{ Form::text('birthdate',Input::old('birthdate'),array('placeholder'=>'yyyy/mm/dd')) }}<br/>
        {{ Form::label('firstname') }}
        {{ Form::text('firstName') }}<br/>
        {{ Form::label('lastname') }}
        {{ Form::text('lastName') }}<br/>
        {{ Form::label('gender') }}::
        Male:{{ Form::radio('gender', 'male', true) }}
        Female:{{ Form::radio('gender', 'female') }}<br/>
        {{ Form::label('profileImage') }}
        {{ Form::file('profileImage') }}<br/>
        {{ Form::label('UserRole') }}
        <?php
            //$userRole->each(function($role) // foreach($posts as $post) { }
            //{
            //    echo $role->id;
            //});
        ?>
        <select name="userRole" id="userRole">
            @foreach($userRole as $userRoles)
                <option value="{{$userRoles->id}}">{{$userRoles->role}}</option>
            @endforeach
        </select>
        <br/>
        {{ Form::label('fromAge') }}
        {{ Form::text('fromAge') }}<br/>
        {{ Form::label('toAge') }}
        {{ Form::text('toAge') }}<br/>
        {{ Form::label('city') }}


        <div id="locationField">
            <input id="autocomplete" placeholder="Enter your address"
                   onFocus="geolocate()" type="text"></input>
        </div>

        <table id="address">
            <tr>
                <td class="label">Street address</td>
                <td class="slimField"><input class="field" id="street_number"
                                             disabled="true"></input></td>
                <td class="wideField" colspan="2"><input class="field" id="route"
                                                         disabled="true"></input></td>
            </tr>
            <tr>
                <td class="label">City</td>
                <td class="wideField" colspan="3"><input class="field" id="locality"
                                                         disabled="true"></input></td>
            </tr>
            <tr>
                <td class="label">State</td>
                <td class="slimField"><input class="field"
                                             id="administrative_area_level_1" disabled="true"></input></td>
                <td class="label">Zip code</td>
                <td class="wideField"><input class="field" id="postal_code"
                                             disabled="true"></input></td>
            </tr>
            <tr>
                <td class="label">Country</td>
                <td class="wideField" colspan="3"><input class="field"
                                                         id="country" disabled="true"></input></td>
            </tr>
        </table>
        <h1>GeoCode:</h1><span id='addressGeoCode'></span>

        <br/> <br/> <br/> <br/> <br/>

        <div id="customerData">
            <fieldset style="width:500px;">
                <legend>Customer:</legend>
                {{ Form::label('looking for') }}::
                Male:{{ Form::radio('lookingFor', 'male', true) }}
                Female:{{ Form::radio('lookingFor', 'female') }}
                Both:{{ Form::radio('lookingFor', 'both') }}<br/>
            </fieldset>
        </div>

        <div id="spData">
            <fieldset style="width:500px;">
                <legend>Service Provider:</legend>
                {{ Form::label('visit frequency') }}
                {{ Form::text('visitFrequency',Input::old('visitFrequency'),array('placeholder'=>'enter number')) }}<br/>
                {{ Form::label('Turns Me On') }}
                {{ Form::text('turnsMeOn') }}<br/>
                {{ Form::label('pubic hair') }}::
                Yes:{{ Form::radio('pubicHair', 'Y', true) }}
                No:{{ Form::radio('pubicHair', 'N') }}<br/>
                {{ Form::label('bust') }}
                {{ Form::text('bust',Input::old('bust'),array('placeholder'=>'enter number')) }}<br/>
                {{ Form::label('cup size') }}
                {{ Form::text('cupSize',Input::old('cupSize'),array('placeholder'=>'enter number')) }}<br/>
                {{ Form::label('waist') }}
                {{ Form::text('waist',Input::old('waist'),array('placeholder'=>'enter number')) }}<br/>
                {{ Form::label('hips') }}
                {{ Form::text('hips',Input::old('hips'),array('placeholder'=>'enter number')) }}<br/>
                {{ Form::label('ethnicity') }}
                <select name="ethnicity" id="ethnicity">
                    <option value="black">Black</option>
                    <option value="white">White</option>
                    <option value="asian">Asian</option>
                </select>
                <br/>
                {{ Form::label('weight') }}
                {{ Form::text('weight',Input::old('weight'),array('placeholder'=>'in kgs')) }}<br/>
                {{ Form::label('height') }}
                {{ Form::text('height',Input::old('height'),array('placeholder'=>'in cm')) }}<br/>
                {{ Form::label('eye color') }}
                <select name="eyeColor" id="eyeColor">
                    <option value="black">Black</option>
                    <option value="brown">Brown</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="grey">Grey</option>
                </select>
                <br/>
                {{ Form::label('hair color') }}
                <select name="hairColor" id="hairColor">
                    <option value="black">Black</option>
                    <option value="brown">Brown</option>
                    <option value="white">White</option>
                </select>
                <br/>
                {{ Form::label('known languages') }}:
                <?php
                    for($i=0;$i<count($knownLanguages);$i++){ ?>
                        <?php echo $knownLanguages[$i]->language_name ?>:<input type="checkbox" name="knownLanguages[]" value="<?php echo $knownLanguages[$i]->id ?>" checked/>
                    <?php
                    }
                ?><br/>
                {{ Form::label('availability') }}:
                Mon:<input type="checkbox" name="availability[]" value="mon" checked/>
                Tue:<input type="checkbox" name="availability[]" value="tue"/>
                Wed:<input type="checkbox" name="availability[]" value="wed"/>
                Thu:<input type="checkbox" name="availability[]" value="thu"/>
                Fri:<input type="checkbox" name="availability[]" value="fri" checked/>
                Sat:<input type="checkbox" name="availability[]" value="sat" checked/>
                Sun:<input type="checkbox" name="availability[]" value="sun"/><br/>
                {{ Form::label('from time') }}
                {{ Form::text('fromTime',Input::old('fromTime'),array('placeholder'=>'22:00')) }}
                -{{ Form::label('to time') }}
                {{ Form::text('toTime',Input::old('toTime'),array('placeholder'=>'23:00')) }}
                <br/>
            </fieldset>
        </div><br/>
        {{ Form::submit('Click Me!'); }}
        {{ Form::close() }}
	</div>
</body>
</html>
