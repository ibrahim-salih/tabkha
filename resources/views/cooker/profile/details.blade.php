@extends('layouts.cooker.app')
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
                            <li class="breadcrumb-item"><a href="{{ route('cooker.welcome') }}">الرئيسية</a>
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
                                <form class="form-horizontal" action="{{ url('cooker/update-profile') }}"
                                      method="post" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <div class="row match-height">
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الاسم</label>
                                                <input type="text" class="form-control border-success info" name="f_name"
                                                       id="f_name"
                                                       value="{{ $cookerDetails->f_name }}"
                                                       placeholder="الاسم">
                                                @error("f_name")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">اللقب</label>
                                                <input type="text" class="form-control border-success info" name="l_name"
                                                       id="l_name"
                                                       value="{{ $cookerDetails->l_name }}"
                                                       placeholder="اللقب">
                                                @error("l_name")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الجنس</label>
                                                <div class="row skin skin-flat">
                                                    <fieldset>
                                                        <input type="radio" value="Male" name="gender" id="input-radio-11" @if($cookerDetails->gender == 'Male') checked @endif>
                                                        <label for="input-radio-11" class="card-title info">ذكر</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="radio" value="Female" name="gender" id="input-radio-12" @if($cookerDetails->gender == 'Female') checked @endif>
                                                        <label for="input-radio-12" class="card-title success">انثى</label>
                                                    </fieldset>
                                                </div>
                                                @error("gender")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">المحافظة</label>
                                                <select class="select2 c-select form-control" id="country" name="country">
                                                        <option value="">اختر المحافظة</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @if($cookerDetails->country_id==$country->id) selected
                                                        @endif>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @error("country")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">المدينة</label>
                                                <select class="c-select form-control" id="state" name="state">
                                                    @foreach($staties as $state)
                                                        <option value="{{ $state->id }}" @if($cookerDetails->state_id==$state->id) selected
                                                        @endif>
                                                            {{ $state->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                @error("state")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">العنوان</label>
                                                <input type="text" class="form-control border-success info" name="address"
                                                       id="address"
                                                       value="{{ $cookerDetails->address }}"
                                                       placeholder="العنوان">
                                                @error("address")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">اسم المطبخ</label>
                                                <input type="text" class="form-control border-success info" name="username"
                                                       id="username"
                                                       value="{{ $cookerDetails->username }}"
                                                       placeholder="اسم المطبخ">
                                                @error("username")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الايميل</label>
                                                <input type="email" class="form-control border-success info" id="helpInput7"
                                                       placeholder="الايميل" name="admin_email"
                                                       value="{{ $cookerDetails->email }}">
                                                @error("email")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">رقم الموبايل</label>
                                                <input type="text" class="form-control border-success info" id="helpInput9"
                                                       placeholder="رقم الموبايل" name="phone"
                                                       id="phone"
                                                       minlength="11" maxlength="12"
                                                       value="{{ $cookerDetails->phone }}">
                                                @error("phone")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label class="card-title success" for="inputSuccess">الصورة<code>*</cod></label>
                                                <div class="controls">
                                                    <input type="file" name="image" id="image"
                                                           class="form-control border-success info">
                                                </div>
                                                @if($cookerDetails->image!= null || $cookerDetails->image!= '')
                                                    @if(File::exists(public_path($cookerDetails->image)))
                                                        <img src="{{ url($cookerDetails->image) }}" class="rounded-circle  height-150"
                                                             alt="{{ $cookerDetails->username }}" title="{{ $cookerDetails->username }}">
                                                    @else
                                                        <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                             alt="{{ $cookerDetails->username }}">
                                                    @endif 
                                                @else
                                                    <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                                         alt="{{ $cookerDetails->username }}">
                                                @endif
                                                
                                                @error("image")
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