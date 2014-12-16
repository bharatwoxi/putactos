<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 15/12/14
 * Time: 11:45 AM
 */
?>
@extends('layouts.search')
@section('content')

<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-lg-12" >
            <div>
                <a href="#" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
                <div class="pull-right">
                    <p  style="padding-top: 15px;">Not a Member?
                        <button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff">Join Putactos</button>
                    </p>
                </div>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->

<div class="container-fluid" style="background-color:#f74d4d; padding-bottom: 30px;"> <!--Sub Header Start-->
    <div class="container">
        <div class="col-md-12" style="font-family:Calibri">
            <div class="mini_nav pull-right" style="color:#ffff;padding: 10px 0px; height: 110px;">
                <a href="#" style="padding-right:20px;">MY PROFILE</a>
                <a href="#" style="padding-right:20px;"><strong>INBOX 1/15</strong></a>
                <a href="#" style=""><strong>SIGN OUT</strong></a>
                <br>
                <br>
                <span style="padding-right:20px; color:#fff">Select Language</span>
                <a href="people_near_by_en.html" class="lan_nav" style="padding-right:20px; color:#fff; text-decoration:underline;">ENGLISH</a>
                <a href="people_near_by_es.html" class="lan_nav" style="">SPANISH</a>
            </div>
        </div> <!--End of col-md-12-->



    </div> <!--End of Container-->
    <div class="container">

        <div class="row" style="font-family:Roboto Th; color:#fff;">
            <div class="col-md-7	">
                <h1 style="color:#fff;  font-size:60px">PEOPLE NEARBY</h1>
            </div>

            <div class="col-md-5">

                <p style="padding:20px 15px 0;font-size: 13px; font-family:Calibri Light;">Your location is set automatically <br>
                    If you think we have got is wrong please select
                </p>
                <!-- Split button -->
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <div class="col-lg-12 selectContainer" style="font-family:Calibri Light; font-weight:bold;">
                                    <select class="form-control custom selectpicker" name="color">
                                        <option >Country</option>
                                        <option >10-15 km</option>
                                        <option>15-20 km</option>
                                        <option>20-25 km</option>
                                        <option>25-30 km</option>
                                        <option>30-35 km</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col-lg-3 -->

                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <div class="col-lg-12 selectContainer" style="font-family:Calibri Light; font-weight:bold;">
                                    <select class="form-control custom" name="color">
                                        <option >City</option>
                                        <option >10-15 km</option>
                                        <option>15-20 km</option>
                                        <option>20-25 km</option>
                                        <option>25-30 km</option>
                                        <option>30-35 km</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- End of row-->

        </div>
    </div><!-- End of row-->
    <div style="border-bottom:1px solid #dbdbdb;padding: 5px 0px;"></div>

</div> <!--End of Container-->
</div> <!--Sub Header Ends-->



<div class="container-fluid" style="background-image:url(../../public/assets/registration/img/background1.png); background-repeat:repeat;"> <!--Content start-->
<div class="container">
    <div class="">
        <div class="panel-heading" style="color: #333;padding: 5px 0px;outline: none;" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" style="color: #fff;" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h3 style="margin-top: -31px; color: white; font-family:Calibri;">ADVANCED SEARCH</h3>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body" style="background-image:url(../../public/assets/registration/img/background1.png); background-repeat:repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label" style="font-family: calibri; font-size: 20px;">Distance Range</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="color" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="">5-10 Km</option>
                                                <option value="blue">10-15 km</option>
                                                <option value="green">15-20 km</option>
                                                <option value="red">20-25 km</option>
                                                <option value="yellow">25-30 km</option>
                                                <option value="white">30-35 km</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <div class="clearfix"></div>

                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Gender</label>
                                        <div class="col-sm-6">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default"  style="font-family:Calibri Light; font-weight:bold;">
                                                    <input type="radio" name="gender" value="male" /> Male
                                                </label>
                                                <label class="btn btn-default" style="font-family:Calibri Light; font-weight:bold;">
                                                    <input type="radio" name="gender" value="female" / > Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>


                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Hair Color</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="color" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="">Black</option>
                                                <option value="blue">10-15 km</option>
                                                <option value="green">15-20 km</option>
                                                <option value="red">20-25 km</option>
                                                <option value="yellow">25-30 km</option>
                                                <option value="white">30-35 km</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <div class="clearfix"></div>

                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Eye Color</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="color" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="">Black</option>
                                                <option value="blue">10-15 km</option>
                                                <option value="green">15-20 km</option>
                                                <option value="red">20-25 km</option>
                                                <option value="yellow">25-30 km</option>
                                                <option value="white">30-35 km</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <div class="clearfix"></div>


                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Ethnicity</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="color" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="">Black</option>
                                                <option value="blue">10-15 km</option>
                                                <option value="green">15-20 km</option>
                                                <option value="red">20-25 km</option>
                                                <option value="yellow">25-30 km</option>
                                                <option value="white">30-35 km</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <div class="clearfix"></div>

                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Language Spoken</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="color" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="">English</option>
                                                <option value="blue">Blue</option>
                                                <option value="green">Green</option>
                                                <option value="red">Red</option>
                                                <option value="yellow">Yellow</option>
                                                <option value="white">White</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                                <form>
                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Availability</label>
                                        <div class="col-sm-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" style="font-family: Calibri Light; font-weight: bold;">
                                                    <input type="radio" name="" value="" / > Available Now
                                                </label>
                                                <span style="font-family:Calibri; font-size:10.02px; color:#f74d4d">&nbsp;(Available at this time)</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.col-lg-6 -->

                            <div class="col-xs-12 col-md-3 center-block" style="background-color:#f74d4d">
                                <h4 style="color:#FFF; font-family:Calibri">PUBIC HAIR</h4>

                                <div class="btn-group" data-toggle="buttons" style="padding-right: 40px; padding-left: 20px;">
                                    <label class="btn btn-default btn-lg" style="font-family: Calibri Light; font-weight: bold;">
                                        <input type="radio" name="" value=""  style="padding:15px"/ > Yes
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default btn-lg" style="font-family: Calibri Light; font-weight: bold;">
                                        <input type="radio" name="" value=""  style="padding:15px"/ > No
                                    </label>
                                </div>


                                <!--<input type="image" src="img/Hairy_Button.png" style="padding: 15px;">
                                <input type="image" src="img/Bald_Button.png" style="padding: 15px;">-->
                                <div class=" col-xs-offset-1">
                                    <h6 style="color:#FFF">HIPS</h6>
                                    <input class="slider" data-slider-max="20" data-slider-min="-20" data-slider-orientation="horizontal" data-slider-value="-10" type="text">
                                    <h6 style="color:#FFF">BUST</h6>
                                    <input class="slider" data-slider-max="20" data-slider-min="-20" data-slider-orientation="horizontal" data-slider-value="12" type="text">
                                    <h6 style="color:#FFF">WAIST</h6>
                                    <input class="slider" data-slider-max="20" data-slider-min="-20" data-slider-orientation="horizontal" data-slider-value="-2" type="text">
                                    <h6 style="color:#FFF">CUP SIZE</h6>
                                    <input class="slider" data-slider-max="20" data-slider-min="-20" data-slider-orientation="horizontal" data-slider-value="-2" type="text">
                                </div>
                            </div>

                            <div class="col-md-3" style="padding-top: 20px; margin-left: 30px;">
                                <p style="background:#FFF; padding:5px; font-family: Calibri; font-size: 20px;"> USE OUR ADVANCED SEARCH FILTERS TO GET THE PRECISE RESULTS YOU ARE LOOKING FOR. HAPPY HAUNTING!!</p>
                                <br>
                                <input type="image" src="{{URL::asset('public/assets/registration/img/Cancel.png')}}" style="width: 110px;">
                                <input type="image" src="{{URL::asset('public/assets/registration/img/Search.png')}}" style="width: 110px; margin-left: 20px;">
                                <!-- <button type="button" class="btn btn-default col-lg-5" style="background:#f83233; color:#FFF">CANCEL</button>
                                 <button type="button" class="btn btn-default col-lg-5" style="background:#f83233; color:#FFF; margin-left:20px;">SEARCH</button>-->


                                <nav style="padding-top: 55px;">
                                    <span style="font-size: 18px; font-family:Calibri;">86 result found</span>
                                    <ul class="pagination pagination-sm" style="margin: -10px 10px;">
                                        <li><a href="#" style="color:#aaaaaa"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                                        <li><a href="#" >1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#" style="color:#aaaaaa"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> <!--End of row-->
                </div><!-- end of container-->

            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->

    <!--<div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->

    <!--<div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->

    <!--<div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->

    <!--<div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->

    <!--<div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

            <div class="col-md-3">
                <p class="pull-left text-justify" style="padding:10px; font-family:Calibri Light">
                    <img src="img/Melting-Ice-Bulbs-HD-Wallpaper.jpg" class="img-responsive" width="250px">
                    <span style="font-size:24px"> Name</span> <br> <span style="font-size:18px">Near your area</span></p>
            </div>

        </div>
    </div><!-- end of col-md-12-->
</div>

</div> <!--Content ends-->



<div class="col-lg-12" style="background-image:url(../../public/assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-3">
                <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f; padding-left: 70px;">
                <h4 style="margin-bottom: 20px;">GET IN TOUCH</h4>
                <p><a href="#" ><img src="{{URL::asset('public/assets/registration/img/tele.png')}}" style="width:52px"></a>         <strong>1-800-355-2626</strong> </p>
                <P><a href="#" ><img src="{{URL::asset('public/assets/registration/img/msg.png')}}" style="width:52px"></a>      <strong>abc@putactos.com</strong>
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

@stop