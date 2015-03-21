
<div class="well">
    <h5>
    <span>Total results to show : {{ $stats['totalResult'] }}</span>
    <h5/>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
        <tr>
            <th>
                Profile Pic
            </th>
            <th>
                Username
            </th>
            <th>
                Email
            </th>
            <th>
                Member
            </th>
            <th>
                User Type
            </th>
            <th>
                Block/Unblock
            </th>
            <th>
            </th>
        </tr>
        </thead>
        <tbody>
        @if ($stats['totalResult'] !=0)
        @foreach($users as $user)
        <tr>
            <td>
                @if($user['user_role_id'] == 1)
                <img class="avatar" height="45" width="45" alt="" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($user['user_id']) }}/profile_image/{{ $user['profile_image'] }}"/>
                @else
                <img  class="avatar" height="45" width="45" alt="" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($user['user_id']) }}/profile_image/{{ $user['profile_image'] }}"/>
                @endif
            </td>
            <td>
                {{ ucwords($user['username']) }}
            </td>
            <td>
                {{ ucwords($user['email']) }}
            </td>
            <td>
                {{ ucwords($user['user_first_name']) }} {{ ucwords($user['user_last_name']) }}
            </td>
            <td>
                {{ ucwords($user['user_role']) }}
            </td>
            <td>
                @if($user['is_active'] == 1)
                <button class="blockUnblock btn red grey-stripe btn-xs" type="button"  value="{{ $user['user_id'] }}_{{0}}">
                    Block
                </button>

                @else
                <button class="blockUnblock btn green grey-stripe btn-xs" type="button" value="{{ $user['user_id'] }}_{{1}}">
                    Unblock
                </button>
                @endif
            </td>
            <td>
                <a class="btn default btn-xs yellow-stripe" href="#">
                    Edit </a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
           <td colspan="7" style="text-align: center">No Results to show</td>
        </tr>
        @endif
        </tbody>
    </table>
</div>

<script>
    jQuery(document).ready(function() {
        $('.blockUnblock').on('click',function(){
            $('#loader').show();
            var userId = $(this).val();
            var newMessage  = $('#searchMessage').val();
            var msgDataNew = 'searchKey='+newMessage+'&userId='+userId;
            $.ajax({
                type: "GET",
                url: "{{URL::to('admin/block-unblock-user')}}", //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                data : msgDataNew,
                success: function (result) {
                    //$("#loaderImage").css("display", "none");
                    $('#loader').hide();
                    $('#user_messages').html(result);
                },
                error: function (error) {
                    console.log(this.url);
                    alert(error);
                }
            });
        });
    });
</script>
