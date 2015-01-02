<input type="hidden" id="skip" value="{{ $skip }}" />
<input type="hidden" id="take" value="{{ $take }}" />
<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 20/12/14
 * Time: 3:15 PM
 */

    if(!empty($serviceProviderData) || $serviceProviderData!=NULL){
    $riseMeUpArray = array_chunk($serviceProviderData,4);
    foreach($riseMeUpArray as $serviceProviderDetails){
        //echo "<pre>";print_r($serviceProviderDetails[0]);echo "</pre>";exit;
?>
        <div class="col-md-12">
            <div class="row">
<?php
        $totalResultCount = count($serviceProviderDetails);
        for($i=0;$i<$totalResultCount;$i++){
            $profileImage = URL::to('/').'/public/uploads/userdata/service_provider/'.sha1($serviceProviderDetails[$i]['system_user']['id'])."/"."profile_image/".$serviceProviderDetails[$i]['system_user']['profile_image'];
?>



                    <div class="col-md-3">
                        <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                            <img src="{{$profileImage}}" class="img-responsive" width="250px">
                            <span style="font-size:24px"> {{ $serviceProviderDetails[$i]['service_provider']['id'] }} {{ $serviceProviderDetails[$i]['system_user']['user_first_name'] }}  {{ $serviceProviderDetails[$i]['system_user']['user_last_name'] }}</span> <br> <span style="font-size:18px">Near your area</span></p>
                    </div>


<?php
        }
?>
            </div>
        </div><!-- end of col-md-12-->
<?php
    }
?>
<input type="hidden" id="isDataAvailable" value="1"/>
<?php
}
   else{
?>
       <input type="hidden" id="isDataAvailable" value="0"/>
<?php
        echo "<h2 class='row text-center'>NO MORE RESULTS </h2>";
    }?>