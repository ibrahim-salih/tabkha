@extends('layouts.cooker.app')
@section('title')
المنيو
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
                            <li class="breadcrumb-item"><a href="{{ route('cooker.menus.index') }}">المنيو</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">تعديل صنف </a>
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
                                <h4 class="card-title">بيانات الصنف</h4>
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
                            <form class="form-horizontal" action="{{ route('cooker.menus.update') }}" method="post" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                    <input type="hidden" name="id" value="{{ $menu->id }}">
                                        <div class="row match-height">
                                            <div class="col-xl-3 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess"> القسم<code>*</code></label>
                                                    <select name="Xsection" id="Xsection"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد القسم</option>
                                                        @foreach($sections as $section)
                                                        <option value="{{ $section->id }}" @if($menu->section_id==$section->id) selected @endif>{{ $section->name }}</option>
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
                                                    <label class="card-title success" for="inputSuccess">  الفئة<code>*</code></label>
                                                    <select name="Xcategory" id="Xcategory" class="select2 form-control border-success info">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" @if($menu->category_id==$category->id) selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("category")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">  الطبخة<code>*</code></label>
                                                    <select name="food" id="food" class="select2 form-control border-success info">
                                                    @foreach($foods as $food)
                                                        <option value="{{ $food->id }}" @if($menu->food_id==$food->id) selected @endif>{{ $food->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("food")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">  نوع الكمية<code>*</code></label>
                                                    <select name="type" id="type" class="select2 form-control border-success info">
                                                        <option value="">اختر النوع</option>
                                                        @foreach($Qtypes as $type)
                                                        <option value="{{ $type->id }}" @if($menu->Qtype_id==$type->id) selected @endif>{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("type")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">وصف الصنف<code>*</code></label>
                                                    <input type="text" class="form-control border-success info" name="description"
                                                        id="description"
                                                        @if(empty($menu->description)) value="{{ old('description') }}"
                                                    @else
                                                    value="{{ $menu->description }}"
                                                    @endif>
                                                    @error("description")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                    
                                            <div class="col-xl-3 col-lg-3 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">السعر<code>*</code></label>
                                                    <input type="text" class="form-control border-success info" name="price"
                                                        id="price"
                                                        @if(empty($menu->price)) value="{{ old('price') }}"
                                                    @else
                                                    value="{{ $menu->price }}"
                                                    @endif>
                                                    @error("price")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-12">
                                                <fieldset class="form-group">
                                                    <label class="card-title success" for="inputSuccess">حالة الصنف<code>*</code></label>
                                                    <select name="status" id="status"
                                                        class="select2 form-control border-success info">
                                                        <option value="">حدد حالة </option>
                                                        <option value="1" @if($menu->status==1) selected @endif>مفعل</option>
                                                        <option value="0" @if($menu->status==0) selected @endif>غير مفعل</option>
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