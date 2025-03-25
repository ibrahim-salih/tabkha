@extends('layouts.cooker.auth')
@section('title')
الطباخ
@endsection
@section('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0 pb-0">
                                <div class="card-title text-center">
                                    <img src="{{asset('dashboard')}}/app-assets/images/logo/logo-dark.png" alt="branding logo">
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>تسجيل حساب</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @if(Session::has('success_message'))
                                    <div id="msg" class="alert alert-success " role="alert" style="margin-top: 10px;">
                                        {{Session::get('success_message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    @if(Session::has('error_message'))
                                    <div id="msg" class="alert alert-danger " role="alert" style="margin-top: 10px;">
                                        {{Session::get('error_message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <form class="form-horizontal" action="{{ route('cooker.register.post') }}" method="POST" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-5">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" name="firstName" id="firstName" class="form-control input-lg"
                                                        placeholder="الاسم" tabindex="1">
                                                    @error("firstName")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-3 col-sm-12 col-md-3">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" name="lastName" id="lastName" class="form-control input-lg"
                                                        placeholder="اللقب" tabindex="2">
                                                    @error("lastName")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-2 col-sm-12 col-md-2">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <!-- <label for="country">المحافظة :</label> -->
                                                    <select class="select2 c-select form-control" id="package" name="package">
                                                        <option value="">اختر الباقة</option>
                                                        @foreach($packages as $package)
                                                        <option value="{{ $package->id }}">{{ $package->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("package")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-2">
                                                <!-- <label class="card-title success" for="inputSuccess">الجنس</label> -->
                                                <div class="row skin skin-flat">
                                                    <fieldset>
                                                        <input type="radio" value="Male" name="gender" id="input-radio-11">
                                                        <label for="input-radio-11" class="card-title info">ذكر</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="radio" value="Female" name="gender" id="input-radio-12">
                                                        <label for="input-radio-12" class="card-title success">انثى</label>
                                                    </fieldset>
                                                </div>
                                                @error("gender")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <!-- <label for="country">المحافظة :</label> -->
                                                    <select class="select2 c-select form-control" id="country" name="country">
                                                        <option value="">اختر المحافظة</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("country")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <!-- <label for="state">المدينة :</label> -->
                                                    <select class="c-select form-control" id="state" name="state">
                                                        <option value="">اختر المدينة</option>
                                                    </select>
                                                    @error("state")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" name="address" id="address" class="form-control input-lg"
                                                        placeholder="العنوان" tabindex="6">
                                                    @error("address")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-edit"></i>
                                                    </div>
                                                    <div class="help-block font-small-5"></div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" name="username" id="username" class="form-control input-lg"
                                                        placeholder="اسم المطبخ مثال-مطبخ الاكلة الحلوة" tabindex="7">
                                                    @error("username")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-list"></i>
                                                    </div>
                                                    <div class="help-block font-small-3"></div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-3">
                                                <fieldset>
                                                    <!-- <label class="card-title " for="inputSuccess">بطاقة وش</label> -->
                                                    <div class="input-group">
                                                        <div class="controls">
                                                            <input type="file" name="image"
                                                                id="image"
                                                                class="form-control">
                                                        </div>
                                                        @error("image")
                                                        <p class="badge badge-default badge-danger block-tag">
                                                            <small class="block-area white">{{$message}}</small>
                                                        </p>
                                                        @enderror

                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-3">
                                                <fieldset>
                                                    <!-- <label class="card-title" for="inputSuccess">بطاقة ظهر</label> -->
                                                    <div class="input-group">
                                                        <div class="controls">
                                                            <input type="file" name="image2"
                                                                id="image2"
                                                                class="form-control">
                                                        </div>
                                                        @error("image2")
                                                        <p class="badge badge-default badge-danger block-tag">
                                                            <small class="block-area white">{{$message}}</small>
                                                        </p>
                                                        @enderror

                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-2">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                    <!-- <label for="country">المحافظة :</label> -->
                                                    <select class="select2 c-select form-control" id="nationality" name="nationality">
                                                        <option value="">اختر الجنسية</option>
                                                        @foreach($nationalities as $nationality)
                                                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("nationality")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="رقم الموبايل "
                                                        tabindex="10">
                                                    @error("phone")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-phone"></i>
                                                    </div>
                                                    <div class="help-block font-small-3"></div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="الايميل "
                                                        tabindex="11">
                                                    @error("email")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-mail"></i>
                                                    </div>
                                                    <div class="help-block font-small-3"></div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="password" name="password" id="password" class="form-control input-lg"
                                                        placeholder="كلمة المرور" tabindex="12">
                                                    @error("password")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                    <div class="help-block font-small-3"></div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg"
                                                        placeholder="تأكيد كلمة المرور" tabindex="13">
                                                    @error("password_confirmation")
                                                    <p class="badge-default badge-danger block-tag text-center">
                                                        <small class="block-area white">{{$message}}</small>
                                                    </p>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                    <div class="help-block font-small-3"></div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-4 col-sm-3 col-md-3">
                                                <fieldset>
                                                    <input type="checkbox" id="accept" name="accept" class="chk-remember">
                                                    <label for="accept"> اوافق</label>
                                                </fieldset>
                                                @error("accept")
                                                <p class="badge-default badge-danger block-tag text-center">
                                                    <small class="block-area white">{{$message}}</small>
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="col-8 col-sm-9 col-md-9">
                                                <p class="font-small-3">عند الضغط على تسجيل انت توافق على <a href="#" data-toggle="modal"
                                                        data-target="#terms">اتفاقية الاستخدام</a>
                                                    الخاصة بالموقع</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-user"></i> تسجيل</button>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <a href="{{ route('cooker.login') }}" class="btn btn-danger btn-lg btn-block"><i class="ft-unlock"></i> دخول</a>
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

<!-- Modal -->
<div class="modal fade text-left" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i> اتفاقية الاستخدام</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><i class="la la-arrow-right"></i> البند الاول</h5>
                <p>Oat cake ice cream candy chocolate cake chocolate
                    cake cotton candy dragée apple pie. Brownie carrot
                    cake candy canes bonbon fruitcake topping halvah.
                    Cake sweet roll cake cheesecake cookie chocolate
                    cake liquorice. Apple pie sugar plum powder donut
                    soufflé.
                </p>
                <hr>
                <h5><i class="la la-lightbulb-o"></i> البند الثانى</h5>
                <p>Cupcake sugar plum dessert tart powder chocolate
                    fruitcake jelly. Tootsie roll bonbon toffee danish.
                    Biscuit sweet cake gummies danish. Tootsie roll
                    cotton candy tiramisu lollipop candy cookie biscuit
                    pie.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">اغلاق</button>
            </div>
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
<!-- ////////////////////////////////////////////////////////////////////////////-->
@endsection