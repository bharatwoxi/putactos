<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Information</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/edit_info.css')}}" media="all" rel="stylesheet">

</head>
<body>

<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="#" class="navbar-static pull-left" style="margin:0"><img src="img/Puktatos 3 b.png" class="img-responsive" width="150"  /></a>
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

<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row erawa">
                <span style="color:#fff;  font-size:43px">EDIT YOUR INFORMATION</span>
                <div class="mini_nav pull-right enav">
                    <a href="#" style="padding-right:20px;">MY PROFILE</a>
                    <a href="#" style="padding-right:20px;"><strong>INBOX 1/15</strong></a>
                    <a href="#" style=""><strong>SIGN OUT</strong></a>
                    <br>
                    <br>
                    <span style="padding-right:20px; color:#fff">Select Language</span>
                    <a href="people_near_by_en.html" class="lan_nav" style="padding-right:20px; color:#fff; text-decoration:underline;">ENGLISH</a>
                    <a href="people_near_by_es.html" class="lan_nav" style="">SPANISH</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->


<div class="container-fluid econta">

    <div class="container">
        <div class="col-lg-6 ecolsix">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Screename/Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label" style="text-align: left;">Email address</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Upload Picture</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputPassword3">
                        <input type="image"  src="img/Upload.png" style="width:85px; margin-top: 15px; height: 32px;">
                    </div>
                    <div class="col-sm-3">
                        <input type="image" src="img/Browse.png" style="width: 85px; vertical-align: text-top;height: 32px; margin-left: -20px;">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 ecolsix">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Current password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword3">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">New password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">New password<br><span style="font-size:14px">(retype)</span></label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword3">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container-fluid econte">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label class="col-sm-5 ecolfour" control-label>Ethnicity</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Gender</label>

                        <div class="col-sm-7">
                            <label class="col-sm-3" style="padding-left: 0;">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Male
                            </label>
                            <label class="col-sm-5">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Female
                            </label>
                        </div>
                    </div>
                </form>


                <div class="clearfix"></div>


                <form>
                    <div class="form-group">
                        <label class="col-sm-5 ecolfour" control-label>Hair Color</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="custom-select fonza">
                                <option>Select</option>
                                <option>Driving</option>
                                <option>Internet</option>
                                <option>Movie</option>
                                <option>Music</option>
                                <option>Reading</option>
                                <option>Sports</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <form>
                    <div class="form-group">
                        <label class="col-sm-5 ecolfour" control-label>Eye Color</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Height</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Weight</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Bust</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Waist</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
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
                        <label class="col-sm-5 ecolfour" control-label>Hips</label>
                        <div class="col-sm-4 selectContainer">
                            <select class="fonza custom-select" name="color">
                                <option value=""></option>
                                <option value="blue">10-15 km</option>
                                <option value="green">15-20 km</option>
                                <option value="red">20-25 km</option>
                                <option value="yellow">25-30 km</option>
                                <option value="white">30-35 km</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <!--  <h4 style="font-family: calibri; font-size: 20px; text-align: -webkit-auto; font-weight:bold">Services Rate Card</h4>
                 <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   <span style="font-family: calibri; font-size: 20px; text-align: -webkit-auto; font-weight:bold">Services</span>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                   <table class="table">
               <thead>
                  <tr>
                     <th>Services</th>
                     <th>Rate</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1 Year</td>
                     <td>300$</td>
                  </tr>
                  <tr>
                     <td>2 Years</td>
                     <td>350$</td>
                  </tr>
                   <tr>
                     <td>2 Years</td>
                     <td>350$</td>
                  </tr>
               </tbody>
            </table>
                  </div>
                </div>
              </div>-->

                <h4 class="ehfour">Describe Yourself</h4>
                <textarea class="form-control" rows="3"  placeholder="100 words"></textarea>
            </div>
        </div> <!--close of row-->
    </div> <!--Close of Container-->
</div> <!--Close of container-->
<div class="clearfix"></div>



<div class="container-fluid econter">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form>
                    <div class="form-group">
                        <label class="col-sm-4 ecolfour" control-label>Interested In</label>

                        <div class="col-sm-7">
                            <label class="col-sm-3" style="padding-left: 0;">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Men
                            </label>
                            <label class="col-sm-5">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Woman
                            </label>
                            <label class="col-sm-4">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Both
                            </label>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <form>
                    <div class="form-group">
                        <label class="col-sm-4 ecolfour" control-label>Availablity</label>				       								</div>
                </form>
                <div class="col-md-7">
                    <p class="epara"> Days</p>
                    <p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello1" value="" style="padding:15px"> Mon
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello2" value="" style="padding:15px"> Tue
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello3" value="" style="padding:15px"> Wed
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello4" value="" style="padding:15px"> Thu
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello5" value="" style="padding:15px"> Fri
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello6" value="" style="padding:15px"> Sat
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello7" value="" style="padding:15px"> Sun
                        </label>
                    </div>

                    </p>

                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="Name" class="col-sm-2 control-label">Time</label>
                                <div class="col-sm-3" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;text-align: left;">to</label>
                                <div class="col-sm-3 pull-left" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>

                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="Name" class="col-sm-2 control-label" style="padding-left: 0;">Time</label>
                                <div class="col-sm-3" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;text-align: left;">to</label>
                                <div class="col-sm-3 pull-left" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <input type="image" src="img/plus.png" style="width:40px">

                            </div>
                            <label class="col-sm-4">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Set for all
                            </label>
                        </div>
                    </form>
                </div>
                <div class="pull-left" style="margin-top: 60px; margin-bottom: 200px;">
                    <input type="image" src="img/save.png" style="width: 100px;">
                    <input type="image" src="img/save-2.png" style="width: 100px; margin-left: 20px;">
                </div>

            </div>






        </div>
    </div>
</div>





















<div class="col-lg-12 conter">
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-4 col-xs-offset-1">
                <h4 class="hfour">CONNECT WITH US</h4>
                <a href="#" ><img src="img/youtube.png" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="img/social.png" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="img/twitter.png" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="img/skype.png" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="img/linkedin.png" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="img/facebook.png" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f;">
                <h4 class="hfour">GET IN TOUCH</h4>
                <p><a href="#" ><img src="img/tele.png" style="width:52px"></a>         <strong>1-800-355-2626</strong> </p>
                <P><a href="#" ><img src="img/msg.png" style="width:52px"></a>      <strong>abc@putactos.com</strong>
                </P>
            </div>

            <div class="col-md-4 colfour">
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







<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
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
    })
</script>
</body>
</html>





