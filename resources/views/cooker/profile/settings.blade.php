@extends('layouts.cooker.app')
@section('title')
توثيق الحساب
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
                            <li class="breadcrumb-item"><a href="javascript:;">توثيق الحساب </a>
                            </li>

                        </ol>
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
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">

            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">

                <form class="form-horizontal" action="{{ url('cooker/update-settings') }}"
                    method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <fieldset class="form-group">
                                <label class="card-title success" for="inputSuccess">سيلفى صورة البطاقة وش<code>*</cod></label>
                                <div class="controls">
                                    <input type="file" name="ID_img_front" id="ID_img_front"
                                        class="form-control border-success info">
                                </div>
                                @if($details->ID_img_front!= null || $details->ID_img_front!= '')
                                @if(File::exists(public_path($details->ID_img_front)))
                                <img src="{{ url($details->ID_img_front) }}"
                                    alt="{{ $details->username }}" title="{{ $details->username }}" data-action="zoom" class="rounded img-fluid float-left mr-2 mb-1"
                                    width="400" height="300">
                                @else
                                <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                    alt="{{ $details->username }}">
                                @endif

                                @endif

                                @error("ID_img_front")
                                <p class="badge-default badge-danger block-tag text-center">
                                    <small class="block-area white">{{$message}}</small>
                                </p>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <fieldset class="form-group">
                                <label class="card-title success" for="inputSuccess">سيلفى صورة البطاقة ظهر<code>*</cod></label>
                                <div class="controls">
                                    <input type="file" name="ID_img_back" id="ID_img_back"
                                        class="form-control border-success info">
                                </div>
                                @if($details->ID_img_back!= null || $details->ID_img_back!= '')
                                @if(File::exists(public_path($details->ID_img_back)))
                                <img src="{{ url($details->ID_img_back) }}"
                                    alt="{{ $details->username }}" title="{{ $details->username }}" data-action="zoom" class="rounded img-fluid float-left mr-2 mb-1"
                                    width="400" height="300">
                                @else
                                <img src="{{ url('dashboard/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150"
                                    alt="{{ $details->username }}">
                                @endif

                                @endif

                                @error("ID_img_back")
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