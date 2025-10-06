@include('Frontend.templates.header')


<!-- ***** Preloader Start ***** -->
{{-- <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> --}}
<!-- ***** Preloader End ***** -->

@include('Frontend.templates.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .carousel-item img {
        width: 100%;
        margin-top: 100px;
        height: 500px;
        border-radius: 60px;
        object-fit: cover;
    }

    .carousel-indicators [data-bs-target] {
        background-color: gray;
    }

    .carousel-indicators .active {
        background-color: red;
    }

</style>

{{-- <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6>Digital Media Agency</h6>
                                    <h2>We Boost Your Website Traffic</h2>
                                    <p>This template is brought to you by TemplateMo website. Feel free to use this
                                        for a commercial purpose. You are not allowed to redistribute the template
                                        ZIP file on any other template website. Thank you.</p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-first-button scroll-to-section">
                                        <a href="#contact">Free Quote</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="{{ '../../Front-end/' }}assets/images/slider-dec-v2.png" alt="">
</div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
<div class="container mt-5">

    {{-- <div id="cashbackCarousel" class="carousel slide mt-5" data-bs-ride="carousel" data-bs-interval="2500">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#cashbackCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#cashbackCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#cashbackCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner mt-5">
            <div class="carousel-item active">
                <img src="{{ '../../Front-end/' }}assets/images/promo1.png" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ '../../Front-end/' }}assets/images/promo2.png" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ '../../Front-end/' }}assets/images/promo3.png" alt="Slide 3">
            </div>
        </div> --}}

        <!-- Controls -->
        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#cashbackCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#cashbackCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button> --}}
    {{-- </div> --}}


</div>

<div id="portfolio" class="our-portfolio section text-center" data-wow-duration="1s" data-wow-delay="0.3s">
    <div class="container">
        <div class="section-heading ">
            <h6>Products</h6>
            <h4>Game Lagi <em>Populer🔥</em></h4>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($data['cards'] as $cards )

            <div class="col-lg-2 ">
                <div class="card ">
                    <div class="card-body">
                        <div class="owl-item cloned" style="width: 200px;">
                            <div class="item">
                                <a href="{{ route('home.detail_produk', $cards['category_id']) }}">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('storage/' . $cards['card_to_game']['gambar']) }}"
                                                alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>{{ $cards['card_to_category']['name'] }}
                                            </h4>
                                            <h4>{{ $cards['card_to_game']['name']  }} </h4>
                                            <span>{{ $cards['card_to_brand']['name'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                <div class="section-heading">
                    <h6>Recent News</h6>
                    <h4>Check New <em>Posts</em></h4>
                    <div class="line-dec"></div>
                </div>
            </div>

            <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                <div class=" blog-posts">
                    <div class="row">
                        @foreach ($data['news'] as $item)
                        <div class="col-lg-6">
                            <div class=" post-item">
                                <div class="thumb">
                                    <a href=""><img src="{{ $item['thumb'] }}"
                                            alt=""></a>
                                </div>
                                <div class="right-content">
                                    <span class="category">{{ $item['author'] }}</span>
                                    <span class="date">{{ $item['time'] }}</span>
                                    <a href="#">
                                        <h4>{{ \Illuminate\Support\Str::limit($item['title'], 50) }}</h4>
                                    </a>
                                    <p>{{ \Illuminate\Support\Str::limit($item['desc'], 100) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h6>Contact Us</h6>
                    <h4>Get In Touch With Us <em>Now</em></h4>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <form id="contact" action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="{{ '../../Front-end/' }}assets/images/contact-dec-v2.png" alt="">
</div>
</div>
<div class="col-lg-5">
    <div id="map">
        <iframe
            src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="636px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
<div class="col-lg-7">
    <div class="fill-form">
        <div class="row">
            <div class="col-lg-4">
                <div class="info-post">
                    <div class="icon">
                        <img src="{{ '../../Front-end/' }}assets/images/phone-icon.png" alt="">
                        <a href="#">010-020-0340</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-post">
                    <div class="icon">
                        <img src="{{ '../../Front-end/' }}assets/images/email-icon.png" alt="">
                        <a href="#">our@email.com</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-post">
                    <div class="icon">
                        <img src="{{ '../../Front-end/' }}assets/images/location-icon.png" alt="">
                        <a href="#">123 Rio de Janeiro</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <fieldset>
                    <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                </fieldset>
                <fieldset>
                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email"
                        required="">
                </fieldset>
                <fieldset>
                    <input type="subject" name="subject" id="subject" placeholder="Subject" autocomplete="on">
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset>
                    <textarea name="message" type="text" class="form-control" id="message" placeholder="Message"
                        required=""></textarea>
                </fieldset>
            </div>
            <div class="col-lg-12">
                <fieldset>
                    <button type="submit" id="form-submit" class="main-button ">Send Message
                        Now</button>
                </fieldset>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>
</div>
</div>
</div> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = new bootstrap.Carousel(document.getElementById('promoCarousel'), {
            interval: 3000, // Auto slide every 3 seconds
            ride: 'carousel'
        });
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@include('Frontend.templates.footer')
