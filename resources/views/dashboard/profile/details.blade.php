@extends('layouts.dashboard.app')
@section('title')
الملف الشخصى
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">الملف الشخصى </a>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الملف الشخصى </h4>
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
                                <form class="form-horizontal" action="{{ url('dashboard/update-profile') }}"
                                      method="post" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <div class="row match-height">
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الاسم</label>
                                                <input type="text" class="form-control border-success info" name="admin_name"
                                                       id="admin_name"
                                                       value="{{ Auth::guard('admin')->user()->name }}"
                                                       placeholder="الاسم">
                                                @error("admin_name")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الايميل</label>
                                                <input type="email" class="form-control border-success info" id="helpInput7"
                                                       placeholder="الايميل" name="admin_email"
                                                       value="{{ Auth::guard('admin')->user()->email }}">
                                                @error("admin_email")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">رقم الموبايل</label>
                                                <input type="text" class="form-control border-success info" id="helpInput9"
                                                       placeholder="رقم الموبايل" name="admin_mobile"
                                                       id="admin_mobile"
                                                       minlength="11" maxlength="12"
                                                       value="{{ Auth::guard('admin')->user()->mobile }}">
                                                @error("admin_mobile")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الصورة<code>*</cod></label>
                                                <div class="controls">
                                                    <input type="file" name="admin_image" id="admin_image"
                                                           class="form-control border-success info">
                                                </div>
                                                @if(Auth::guard('admin')->user()->image!= null || Auth::guard('admin')->user()->image!= '')
                                                    @if(File::exists(public_path(Auth::guard('admin')->user()->image)))
                                                        <img src="{{ url(Auth::guard('admin')->user()->image) }}" class="rounded-circle  height-150"
                                                             alt="{{ Auth::guard('admin')->user()->name }}" title="{{ Auth::guard('admin')->user()->name }}">
                                                    @else
                                                        <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                             alt="{{ Auth::guard('admin')->user()->name }}">
                                                    @endif 
                                                @else
                                                    <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                         alt="{{ Auth::guard('admin')->user()->name }}">
                                                @endif
                                                
                                                @error("admin_image")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-outline-primary btn-min-width btn-block btn-glow mr-1 mb-1">
                                                    حفظ
                                                </button>
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