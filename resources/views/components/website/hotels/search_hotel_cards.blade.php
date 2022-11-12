@foreach ($RoomCosts as $Room)
<div class="rooms">
    <div class="row mx-0 align-items-center text-center">
        <div class="col-xl-3 col-sm-12 col-md-6">
            <h6>{{$Room->en_room_type}}  </h6>
        </div>
        <div class="col-xl-2 col-sm-12 col-md-6">
            <span class="category">
                {{$Room->food_bev_type}}
            </span>
        </div>
        <div class="col-xl-3 col-sm-12 col-md-6">
            <div class="avaliable">
                <span> avaliable</span>
                <span><a href="#">Cancellation Policy</a></span>
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 col-md-6">
            <span class="price_info">
                {{$Room->cost}} $
            </span>
        </div>

        <div class="col-xl-1 col-sm-12 col-md-6 p-0">
           <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
        </div>


    </div>
</div>
@endforeach

