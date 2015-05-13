<link href="{{URL::asset('public/assets/registration/toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
<script src="{{URL::asset('public/assets/registration/toastr/toastr.js')}}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.options.onclick = function () {
        window.location.href = "{{URL::to('/messages-user-lists')}}";
    };
    setInterval(function(){
        $.ajax({
            type: "GET",
            url: "{{URL::to('/messages/notification')}}", //Where to make Ajax calls
            dataType:"json", // Data type, HTML, json etc.
            success:function(response){
                if(response.success == true)
                {
                    var arr = response.message;
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                            toastr.info('You have received new message from: '+value.fromUserName);
                        }
                    });
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }, 5000);

</script>