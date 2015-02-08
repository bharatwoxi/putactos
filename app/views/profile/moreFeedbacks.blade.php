@if($feedbacks!=NULL || !empty($feedbacks))
@foreach($feedbacks as $feedback)
<div id="feedback_customer" class="col-sm-12">
    <h3>Customer Feedback</h3>
    <div id="feedback_detail">
        <div id="feed_img">
            <?php $customer = User::find($feedback['customer_id']) ?>
            <img height="54" width="62" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($customer->id) }}/profile_image/{{ $customer->profile_image }}">
        </div>
        <div id="feed_detail">
            <p><b>{{ ucwords($customer->user_first_name) }} {{ ucwords($customer->user_last_name) }}</b></p>
            <p>{{$feedback->feedback}}</p>
        </div>
        <div id="feed_rate" class="feed_rate">
            <p><b>I Rate</b></p>
            <input id="input-2b" value="{{ $feedback['rating'] }}" readonly="true" type="number" class="rating form-control hide original_star" min="0" max="5" step="0.5" data-size="xs" data-symbol="" data-default-caption="{rating} hearts" data-star-captions="{}">
        </div>
    </div>
</div>
@endforeach
@else
No Feedbacks Found!!!
@endif