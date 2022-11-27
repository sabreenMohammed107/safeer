
$('.explore_carsoul').slick({
    centerMode: true,
    centerPadding: '0px',
    slidesToShow: 4,
    slidesToscroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: true,
    responsive: [

      {
        breakpoint:1200,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '0px',
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 3
        }
      },
        {
            breakpoint:991,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: '0px',
              autoplay: true,
              autoplaySpeed: 2000,
              slidesToShow: 2
            }
          },
          {
            breakpoint:767,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: '0px',
              autoplay: true,
              autoplaySpeed: 2000,
              slidesToShow: 1
            }
          },
         
      ]
  });

