@extends('layouts.dashboard.app')
@section('title')
privacys
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.privacys.index') }}">privacys</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">اضافة privacys جديد</a>
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
                                <h4 class="card-title">بيانات privacys</h4>
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
                               
                            </div>
                            <form class="form-horizontal" action="{{ route('dashboard.privacys.store') }}" method="post" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row match-height">
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">أسم privacys<code>*</code></label>
                                                    <input type="text" class="form-control border-success info" name="name"
                                                        id="name"
                                                        value="{{ old('name') }}"
                                                        placeholder="أسم privacys">
                                                    @error("name")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                        
                                        
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">وصف privacys<code>*</code></label>
                                                    <textarea name="description" id="description" cols="30" rows="15" class="ckeditor"></textarea>
                                                    @error("description")
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