@extends('layouts.cooker.app')
@section('title')
التحويلات
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
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">قائمة التحويلات</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">

            </div>
        </div>
        <div class="content-body">
            <section id="badges-with-icons">
                <div class="row">
                    <div class="col-12 mt-3 mb-1">
                        <h4 class="text-uppercase">وسائل الدفع المتاحة</h4>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">اورانج </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <p>حول على <code>01201824546</code> واحتفظ بصورة التحويل.</p>
                                    <div class="badge badge-warning round">
                                        <span>اورانج كاش</span>
                                        <i class="la la-file-o font-medium-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">اجمالى الرصيد المشحون</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <div class="badge badge-pill badge-secondary badge-square">
                                        {{ $charges->total_charge }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">اجمالى الرصيد المستخدم</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <div class="badge badge-pill badge-danger badge-square">
                                        {{ $charges->total_use }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">الرصيد المتاح</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <div class="badge badge-pill badge-success badge-square">
                                        {{ $charges->charge }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">وى</h4>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                    <p>Use the <code>.badge</code> class, followed by<code>.badge-square</code>                      class for square bordered badge.</p>
                    <div class="badge badge-primary badge-square">
                      <i class="la la-file-o font-medium-2"></i>
                      <span>وى كاش</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">اتصالات</h4>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                    <p>Use the <code>.badge</code> class, followed by<code>.round</code>                      class for round bordered badge.</p>
                    <div class="badge badge-success round">
                      <i class="la la-file-o font-medium-2"></i>
                      <span>اتصالات كاش</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">فودافون</h4>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                    <p>Use the <code>.badge</code> class, followed by<code>.badge-danger</code>class
                      within element to create danger badge.</p>
                    <div class="badge badge-danger">
                      <span>فودافون كاش</span>
                      <i class="la la-file-o font-medium-2"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->


                </div>
            </section>
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">قائمة التحويلات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                                <div class="badge badge-success"><a data-toggle="modal" data-target="#add">اضف تحويل جديد</a></div>
                                <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add" title="اضافة تحويل "><i class="ft-plus"></i></button> -->
                                <br>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(Session::has('error_message'))
                                <div class="row mr-2 ml-2 alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                    <button id="type-error" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{Session::get('error_message')}}</strong>
                                </div>
                                @endif
                                @if(Session::has('success_message'))
                                <div class="row mr-2 ml-2 alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                    <button id="type-error" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{Session::get('success_message')}}</strong>
                                </div>
                                @endif
                                {{-- @if ($errors->any())--}}
                                {{-- <div class="alert alert-danger">--}}
                                {{-- <ul>--}}
                                {{-- @foreach ($errors->all() as $error)--}}
                                {{-- <li>{{ $error }}</li>--}}
                                {{-- @endforeach--}}
                                {{-- </ul>--}}
                                {{-- </div>--}}
                                {{-- @endif--}}
                            </div>
                            <div class="card-content collapse show">

                                @if($allcharges->count())
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered dom-jQuery-events zero-configuration">
                                        <thead class="bg-success white">
                                            <tr>
                                                <th>#</th>
                                                <th>صورة التحويل</th>
                                                <th> مبلغ التحويل </th>
                                                <th> تاريخ التحويل</th>
                                                <th>حالة التحويل </th>
                                                <th>اسباب </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $i = 0; ?>
                                            @foreach($allcharges as $charge)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    <div class="bs-callout-success mt-1">
                                                        @if($charge->image != null || $charge->image != '')
                                                        @if(File::exists(public_path($charge->image)))
                                                        <img src="{{ url($charge->image) }}" class="img-fluid"
                                                            alt="{{ $charge->price }}" style="width: 150px;height: 150px;">
                                                        @else
                                                        <img style="width: 50px;height: 50px;" src="{{ asset('uploads/products/small/no-image.png') }}">
                                                        @endif
                                                        @else
                                                        <img style="width: 50px;height: 50px;" src="{{ asset('uploads/products/small/no-image.png') }}">
                                                        @endif
                                                        <br>
                                                        <p> اضيف منذ {{ $charge->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="bs-callout-info callout-border-left p-1">
                                                        <a href="javascript:;" class="btn badge-pill badge-border border-success success" title="">{{ $charge->price }}</a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <strong><a href="javascript:;">{{ $charge->created_at }}</a></strong>
                                                </td>

                                                <td class="text-center">
                                                    @if($charge->status_of == 'wait')
                                                    <button type="button" class="btn btn-warning btn-round mr-1 mb-1">انتظار</button>
                                                    @elseif($charge->status_of == 'accpet')
                                                    <button type="button" class="btn btn-success btn-round mr-1 mb-1">انتظار</button>
                                                    @else
                                                    <button type="button" class="btn btn-danger btn-round mr-1 mb-1">مرفوض</button>
                                                    @endif
                                                </td>

                                                </td>
                                                <td>
                                                    <strong><a href="javascript:;">{{ $charge->resonse }}</a></strong>
                                                </td>

                                            </tr>


                                            <!-- edit_modal_Grade -->
                                            
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-success white">
                                            <tr>
                                                <th>#</th>
                                                <th>صورة التحويل</th>
                                                <th> مبلغ التحويل </th>
                                                <th> تاريخ التحويل</th>
                                                <th>حالة التحويل </th>
                                                <th>اسباب </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="card-body card-dashboard">
                                    {{-- {{ $vendors->links('admin.layout.my-paginate') }} <br>--}}
                                </div>
                                @else
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">عفوا</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body text-center">
                                            <p>لا يوجد <code>.تحويلات</code> حاليا</p>
                                            <div class="badge badge-success"><a data-toggle="modal" data-target="#add">اضف تحويل جديد</a></div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- add_modal_Grade -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- edit_form -->
            <form action="{{ url('cooker/store-charge') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i> اضف تحويل</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h5><i class="la la-arrow-right"></i> بيانات التحويل</h5>
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <div class="form-group">
                                <h5>صورة التحويل</h5>
                                <div class="controls">
                                    <input type="file" name="image" id="image" class="form-control border-success info">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <div class="form-group">
                                <h5>مبلغ </h5>
                                <div class="controls">
                                    <input type="text" name="price" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="form-group">
                                <h5>رقم تم منه التحويل </h5>
                                <div class="controls">
                                    <input type="text" name="mobile" class="form-control ">
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="alert alert-success" role="alert">--}}
                    {{-- <span class="text-bold-600">Well done!</span> You successfully read this--}}
                    {{-- important alert message.--}}
                    {{-- </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">حفظ البيانات</button>
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">خروج</button>

                </div>
            </form>
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