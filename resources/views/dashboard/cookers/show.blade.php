@extends('layouts.dashboard.app')
@section('title')
الطباخين
@endsection

@section('content')
<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> بيانات الطباخ</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard/welcome') }}">الرئيسية</a>
                                </li>


                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                </div>
            </div>
            <div class="content-body">
                <!-- Input Validation start -->
                <section class="input-validation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">بيانات</h4>
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
                                        <div
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
                                    {{--                                    {!! Toastr::message() !!}--}}

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form-horizontal" action=""
                                              method="post" novalidate enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <h5> اسم الطباخ
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="controls">
                                                                    <input type="text" name="invoice_code" value="{{ $cooker->f_name .' ' . $cooker->l_name }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <h5>رقم التليفون
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="controls">
                                                                    <input type="text" name="note" value="{{ $cooker->phone }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-12">
                                                            <div class="form-group">
                                                                <h5>كود الدولة
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="controls">
                                                                    <input type="text" name="note" value="{{ $cooker->phone }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <h5>العنوان
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="controls">
                                                                    <input type="text" name="note" value="{{ $cooker->address }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <h5>الايميل
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="controls">
                                                                    <input type="text" name="note" value="{{ $cooker->email }}" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <h5>الصورة الشخصية
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                <div class="card">
                                                                    <div class="text-center">
                                                                        <div class="card-body">
                                                                            @if($cooker->image!= null || $cooker->image!= '')
                                                                                @if(File::exists(public_path($cooker->image)))
                                                                                <img src="{{ url($cooker->image) }}" class="img-fluid"
                                                                                     alt="{{ $cooker->f_name }}">
                                                                                    @else
                                                                                    <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                                                         alt="{{ $cooker->f_name }}">
                                                                                @endif
                                                                                @else
                                                                                <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                                                     alt="{{ $cooker->f_name }}">
                                                                                @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <h5> سيلفى البطاقة وش  
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                @if($cooker->ID_img_front!= null || $cooker->ID_img_front!= '')
                                                                    @if(File::exists(public_path($cooker->ID_img_front)))
                                                                        <img src="{{ url($cooker->ID_img_front) }}" class="img-fluid"
                                                                             alt="{{ $cooker->f_name }}">
                                                                    @else
                                                                    <img class="img-fluid" src="{{ url('dashboard/app-assets/images/portfolio/width-1200/portfolio-1.jpg') }}"
                                                                         alt="Timeline Image 1">
                                                                    @endif
                                                                @else
                                                                <img class="img-fluid" src="{{ url('dashboard/app-assets/images/portfolio/width-1200/portfolio-1.jpg') }}"
                                                                     alt="Timeline Image 1">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <h5> سيلفى البطاقة ظهر   
                                                                    <span class="required">*</span>
                                                                </h5>
                                                                @if($cooker->ID_img_back	!= null || $cooker->ID_img_back	!= '')
                                                                    @if(File::exists(public_path($cooker->ID_img_back	)))
                                                                        <img src="{{ url($cooker->ID_img_back) }}" class="img-fluid"
                                                                             alt="{{ $cooker->f_name }}">
                                                                    @else
                                                                        <img class="img-fluid" src="{{ url('dashboard/app-assets/images/portfolio/width-1200/portfolio-1.jpg') }}"
                                                                             alt="Timeline Image 1">
                                                                    @endif
                                                                @else
                                                                    <img class="img-fluid" src="{{ url('dashboard/app-assets/images/portfolio/width-1200/portfolio-1.jpg') }}"
                                                                         alt="Timeline Image 1">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection