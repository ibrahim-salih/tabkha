@extends('layouts.dashboard.app')
@section('title')
الفئات
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">الفئات</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">اضافة فئة جديد</a>
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
                                <h4 class="card-title">بيانات الفئة</h4>
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
                            <form class="form-horizontal" action="{{ route('dashboard.categories.store') }}" method="post" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row match-height">
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">أسم الفئة<code>*</code></label>
                                                    <input type="text" class="form-control border-success info" name="name"
                                                        id="name"
                                                        value="{{ old('name') }}"
                                                        placeholder="أسم الفئة">
                                                    @error("name")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                        
                                            <div class="col-xl-3 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess"> القسم<code>*</code></label>
                                                    <select name="section" id="section"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد القسم</option>
                                                        @foreach($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("section")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">حالة الفئة<code>*</code></label>
                                                    <select name="status" id="status"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد حالة </option>
                                                        <option value="1" {{old('status')=='1' ? 'selected' : ''}}>مفعل</option>
                                                        <option value="0" {{old('status')=='0' ? 'selected' : ''}}>غير مفعل</option>
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