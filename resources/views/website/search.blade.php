@extends('layouts.website.app')
@section('title')
البحث
@endsection
@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{asset('website')}}/img/carousel-1.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-3 text-white animated slideInDown mb-4">دور على الاكله اللى بتحبها</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">سجل مطبخك</a>
                            <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">ابحث عن الاكلات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{asset('website')}}/img/carousel-2.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-3 text-white animated slideInDown mb-4">هتلاقى الطعم اللى بتدور عليه</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">سجل مطبخك</a>
                            <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">ابحث عن الاكلات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Search Start -->
<!-- <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row g-2">
            <form action="{{ url('/search') }}" method="get">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control border-0" placeholder="اكتب اسم الاكله" />
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" id="state" name="state">
                                <option value="">اختر المدينة</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" id="country" name="country">
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark border-0 w-100">ابحث</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Search End -->



<!-- Header End -->
<!-- <div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Job List</li>
            </ol>
        </nav>
    </div>
</div> -->
<!-- Header End -->


<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">قائمة الطباخين</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <!-- <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Featured</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <h6 class="mt-n1 mb-0">Full Time</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                        <h6 class="mt-n1 mb-0">Part Time</h6>
                    </a>
                </li>
            </ul> -->
            <!-- <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active"> -->
            <!-- <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Software Engineer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div> -->
            <!-- <div class="job-item p-4 mb-4"> -->
            @if($foods->count())
            @foreach($foods as $food)
            <div class="row g-4">
                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                    @if(!empty($food->image))
                    @if(File::exists(public_path($food->image)))
                    <a href="{{ url('detail', $food->id) }}"><img class="flex-shrink-0 img-fluid border rounded" src="{{ asset($food->image) }}" alt="" style="width: 80px; height: 80px;"></a>
                    @endif
                    <a href="{{ url('detail', $food->id) }}"><img class="flex-shrink-0 img-fluid border rounded" src="{{asset('website')}}/img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;"></a>
                    @else
                    <a href="{{ url('detail', $food->id) }}"><img class="flex-shrink-0 img-fluid border rounded" src="{{asset('website')}}/img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;"></a>
                    @endif
                    <div class="text-start ps-4">
                        <h5 class="mb-3"><a href="{{ url('cooked', $food->cooker->id) }}">{{ $food->cooker->username }}</a></h5>
                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $food->country->name }}, {{ $food->state->name }}</span>
                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $food->description }}</span>
                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $food->price }}-{{ $food->qtype->name }}</span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                    <div class="d-flex mb-3">
                        <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                        <a class="btn btn-primary" href="">اطلب الان</a>
                    </div>
                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                </div>
            </div>
            @endforeach
            {{ $foods->links('pagination::simple-bootstrap-5') }}
            @else
            <!-- no foods found -->
            @endif
            <!-- </div> -->
            <!-- <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-3.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Product Designer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-4.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Creative Director</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-5.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Wordpress Developer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div> -->
            <!-- <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a> -->
            <!-- </div> -->
            <!-- <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Software Engineer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-2.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Marketing Manager</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-3.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Product Designer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-4.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Creative Director</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-5.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Wordpress Developer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Software Engineer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-2.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Marketing Manager</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-3.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Product Designer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-4.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Creative Director</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-5.jpg" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">Wordpress Developer</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="">Apply Now</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                </div> -->
        </div>
    </div>
</div>
</div>
<!-- Jobs End -->
@endsection