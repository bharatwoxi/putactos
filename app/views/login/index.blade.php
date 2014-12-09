<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 9/12/14
 * Time: 11:01 AM
 */
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "6LfCB_8SAAAAAFvqUDtRc63oBduhiMJ09kfn60Xv";
$secret = "6LfCB_8SAAAAAIE7nuQD5Du0mJqWH6qDkhTh99wB";
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "en";

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;


?>
@if($errors->any())
<div class="alert alert-danger">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<br/><br/><br/><br/>

{{ Form::open(array('url' => 'authenticate','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'customerRegistration')) }}
<div class="form-group">
    {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
    <div class="col-sm-3">
        {{ Form::email('email',Input::old('email'),array('class'=>'form-control','id'=>'email','required'=>'required')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
    <div class="col-sm-3">
        {{ Form::password('password',array('class'=>'form-control','id'=>'password','required'=>'required')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-3">
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>" data-theme="dark" style="width:100px;"></div>
        <script type="text/javascript"
                src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
        </script>
    </div>
</div>
<div style="margin-top: 30px; margin-bottom: 400px;">
    {{ Form::submit('Login',array('name'=>'submit','id'=>'submit','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px'))}}
    {{ Form::reset('Reset',array('id'=>'reset','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 85px'))}}
</div>
{{ Form::close() }}