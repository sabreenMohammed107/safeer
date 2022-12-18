var arr = [];
    var arr_countries = [];
    var arr_cities = [];
    var arr_zones = [];
    var arr_ratings = [];
    var sort_by = 0; // recommended
    $(".hotel_id").change(function(){
        if($(this).is(':checked')){
            arr.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr = $.grep(arr, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_ids]").val(arr);
        fetch_hotels()
    });
    $(".hotel_cities_id").change(function(){
        if($(this).is(':checked')){
            arr_cities.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_cities = $.grep(arr_cities, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_cities_ids]").val(arr_cities);
        fetch_hotels()
    });
//zones
    $(".hotel_zone_id").change(function(){
        if($(this).is(':checked')){
            arr_zones.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_zones = $.grep(arr_zones, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_zone_ids]").val(arr_zones);
        fetch_hotels()
    });
    $(".hotel_countries_id").change(function(){
        if($(this).is(':checked')){
            arr_countries.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_countries = $.grep(arr_countries, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_countries_ids]").val(arr_countries);
        fetch_hotels()
    });
    $(".rate_val").change(function(){
        if($(this).is(':checked')){
            arr_ratings.push($(this).attr("data-val"));
        }else{
            var removeValue = $(this).attr("data-val");
            arr_ratings = $.grep(arr_ratings, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_rating]").val(arr_ratings);
        fetch_hotels()
    });
    // $(".sort_by").click(function(){
    //     if($(this).attr("data-val") == "rec"){
    //         sort_by = 0;
    //     }else{
    //         sort_by = 1;
    //     }
    //     // console.log(arr);
    //     $("input[name=hotel_rating]").val(arr_ratings);
    //     fetch_hotels()
    // });
    // $(".page-num").click(function(){
    //     $("input[name=page_num]").val($(this).attr("data-val"));
    //     fetch_hotels()
    // });
    // $(".page-inc").click(function(){
    //     $("input[name=page_num]").val($(this).attr("data-val"));
    // });
    // function paginationSetter(value) {
    //     $("input[name=page_num]").val(value);
    //     fetch_hotels()
    // }
    function fetch_hotels() {
        var url = "/hotels/retrieve";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {
                hotel_ids: $("input[name=hotel_ids]").val(),
                hotel_rating: $("input[name=hotel_rating]").val(),
                hotel_countries_ids: $("input[name=hotel_countries_ids]").val(),
                hotel_cities_ids: $("input[name=hotel_cities_ids]").val(),
                hotel_zone_ids: $("input[name=hotel_zone_ids]").val(),
                price_from: $("input[name=price_from]").val(),
                price_to: $("input[name=price_to]").val(),
                sort_by: sort_by,
                page_num: $("input[name=page_num]").val()

            },
            success: function(result){
                 console.log(result);
                $("#table_data").html(result);
            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });
    }
    function search_hotels() {
        var url = "/hotels/search";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {
                childs: $("[name=childs]").val(),
                adults: $("[name=adults]").val(),
                nights: $("[name=nights]").val(),
                end_date: $("input[name=end_date]").val(),
                from_date: $("input[name=from_date]").val(),
                country_id: $("[name=country_id]").val()

            },
            success: function(result){
                console.log(result);
                $("#hotels_content").html(result);
            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });
    }
