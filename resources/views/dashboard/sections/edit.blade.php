@extends('layouts.dashboard.app')
@section('title')
الاقسام
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.sections.index') }}">الاقسام</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">تعديل القسم</a>
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
                                <h4 class="card-title">بيانات القسم</h4>
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
                                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                    <button id="type-error" type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{Session::get('success_message')}}</strong>
                                </div>
                                @endif
                            </div>
                            <form class="form-horizontal" action="{{ url('dashboard/sections/update') }}" method="post" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                    <input type="hidden" name="id" value="{{ $section->id }}">
                                        <div class="row match-height">
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">أسم القسم<code>*</code></label>
                                                    <input type="text" class="form-control border-success info" name="name"
                                                        id="name"
                                                    @if(empty($section->name)) value="{{ old('name') }}"
                                                    @else
                                                    value="{{ $section->name }}"
                                                    @endif
                                                    placeholder="أسم القسم">
                                                    @error("name")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            
                                            <!-- <div class="col-xl-2 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">نوع القسم<code>*</code></label>
                                                    <select name="type" id="type"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد نوع القسم</option>
                                                        <option value="news" @if(!empty($section->type)&&$section->type=='news') selected @endif>اخبارى</option>
                                                        <option value="articles" @if(!empty($section->type)&&$section->type=='articles') selected @endif>مقالات</option>
                                                    </select>
                                                    @error("type")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div> -->
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">حالة القسم<code>*</code></label>
                                                    <select name="status" id="status"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد حالة القسم</option>
                                                        <option value="1" @if($section->status==1) selected @endif>مفعل</option>
                                                        <option value="0" @if($section->status==0) selected @endif>غير مفعل</option>
                                                    </select>
                                                    @error("status")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-outline-success btn-min-width btn-block btn-glow mr-1 mb-1">
                                                        حفظ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection