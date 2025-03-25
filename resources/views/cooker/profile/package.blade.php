@extends('layouts.cooker.app')
@section('title')
الباقة
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                {{-- <h3 class="content-header-title">Advanced DataTable</h3>--}}
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('cooker.welcome') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">تعديل الباقة </a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">

            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="card-header">
                                <h4 class="card-title">تعديل الباقة </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                                <br>
                                @if(Session::has('error_message'))
                                <div id="msg"
                                    class="row mr-2 ml-2 alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2"
                                    role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                    <button id="type-error" type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{Session::get('error_message')}}</strong>
                                </div>
                                @endif
                                @if(Session::has('success_message'))
                                <div id="msg"
                                    class="row mr-2 ml-2 alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2"
                                    role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                    <button id="type-error" type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{Session::get('success_message')}}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row match-height">
                                        <?php $i = 0; ?>
                                        @foreach($packages as $package)


                                        <?php $i++; ?>


                                        <div class="col-lg-4 col-md-12 ">
                                            <?php $i++; ?>
                                            <div class="card profile-card-with-stats">
                                                <div class="text-center">
                                                    <div class="card-body">
                                                        <img src="{{ asset('admin_assets/images/portrait/medium/avatar-m-8.png') }}" class="rounded-circle  height-150" alt="">
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ $package->title }}</h4>
                                                        <ul class="list-inline list-inline-pipe">
                                                            <li>السعر</li>
                                                            <li>{{ $package->price }}</li>
                                                        </ul>
                                                        @if($package->id == $details->package_id)
                                                        <h6 class="card-subtitle text-muted">باقتك الحالية تنتهى فى {{ $details->end_date }}</h6>
                                                        @endif
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Profile example">
                                                        <button type="button" class="btn btn-float box-shadow-0 btn-outline-info">
                                                            <span class="ladda-label"><i class="la la-bell-o"></i>
                                                                <span>12+</span>
                                                            </span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-float box-shadow-0 btn-outline-info">
                                                            <span class="ladda-label"><i class="la la-heart-o"></i>
                                                                <span>25</span>
                                                            </span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-float box-shadow-0 btn-outline-info">
                                                            <span class="ladda-label"><i class="la la-briefcase"></i>
                                                                <span>5</span>
                                                            </span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-float box-shadow-0 btn-outline-info">
                                                            <span class="ladda-label"><i class="ft-mail"></i>
                                                                <span>75+</span>
                                                            </span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-float box-shadow-0 btn-outline-info">
                                                            <span class="ladda-label"><i class="la la-dashcube"></i>
                                                                <span>125</span>
                                                            </span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{ $package->description }}.</p>
                                                        @if(abs(strtotime($details->end_date)) <= strtotime(now())) <button type="button" class="btn btn-outline-success btn-md mr-1" data-toggle="modal" data-target="#register{{ $package->id }}" title="اشترك الان "><i class="la la-plus"></i> اشترك الان</button>
                                                            @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- register_modal_Grade -->
                                        <div class="modal fade" id="register{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- edit_form -->
                                                    <form action="{{ url('dashboard/vendor-update-package', $package) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i> اشترك</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $package->id }}" class="form-control ">
                                                            <h5><i class="la la-arrow-right"></i> {{ $package->title }}</h5>
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-12">
                                                                    <div class="form-group">
                                                                        <h5>تنبيه هام</h5>

                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-lg-2 col-md-12">
                            <div class="form-group">
                                <h5>السعر  </h5>
                                <div class="controls">
                                    <input type="text" name="price" value="{{ $package->id }}" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="form-group">
                                <h5>وصف </h5>
                                <div class="controls">
                                    <input type="text" name="mobile" class="form-control ">
                                </div>
                            </div>
                        </div> -->

                                                            </div>
                                                            <div class="alert alert-danger" role="alert">
                                                                <span class="text-bold-600">عند التجديد مبكرا ! </span> سوف يتم الغاء الايام المتبقية فى الباقة الحالية .
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-primary">أكد الاشتراك</button>
                                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">الغاء</button>

                                                        </div>
                                                    </form>
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
            </section>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        const box = document.getElementById('msg');
        // 👇️ removes element from DOM
        box.style.display = 'none';
        // box.fadeOut('slow');
        // 👇️ hides element (still takes up space on page)
        // box.style.visibility = 'hidden';
    }, 3000); // 👈️ time in milliseconds
</script>
@endsection