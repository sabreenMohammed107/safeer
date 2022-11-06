<!-- slider -->
<div class="slider_section">
    <div class="slider_details">
      <h1> {{$title}}</h1>
       <div class="tabs">
        @foreach ($breadcrumb as $item)
          <span>
            <a href="{{url($item["url"])}}">{{$item["name"]}}</a>
        </span>
        <span> <i class="fa-solid fa-angle-right"></i></span>
        @endforeach
        <span>
           {{$current}}
        </span>
       </div>
    </div>
</div>
