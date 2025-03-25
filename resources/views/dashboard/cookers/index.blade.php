@extends('layouts.dashboard.app')
@section('title')
الطباخين
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    {{--                    <h3 class="content-header-title">Advanced DataTable</h3>--}}
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard/welcome') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript:;">قائمة الطباخين</a>

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
                                    <h4 class="card-title">قائمة الطباخين</h4>
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
                                    @if(Session::has('success_message'))
                                        <div
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
                                        <table class="table table-striped table-bordered dom-jQuery-events zero-configuration">
                                            <thead class="bg-success white">
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الطباخ</th>
                                                <th>المطبخ </th>
                                                <th>الحالة </th>
                                                <th>التوثيق </th>
                                                <th>أجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($cookers as $cooker)
                                                <tr>
                                                    <?php $i++; ?>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="bs-callout-success mt-1">
                                                            <div class="media align-items-stretch">
                                                                <div class="media-left media-middle bg-success p-2 pt-3">
                                                                    <a href="{{ url('dashboard/cookers/show/'.$cooker->id) }}" target="_blank"><i class="ft-eye white"></i></a>
                                                                </div>
                                                        <div class="media-body p-1">
                                                            <strong><a href="{{ url('dashboard/cookers/show/'.$cooker->id) }}" target="_blank">{{ $cooker->f_name .' ' . $cooker->l_name }}</a></strong>
                                                            <p>مسجل  {{ $cooker->created_at->diffForHumans() }}</p>
                                                        </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                        <td class="text-center">
                                                            <div class="bs-callout-info callout-border-left p-1">
                                                                <strong><a href="{{ url('dashboard/cookers/showCook/'.$cooker->id) }}" target="_blank">{{ $cooker->username }}</a></strong>
                                                                <p>{{ $cooker->nationalty->name }} .</p>
                                                                <div class="badge badge-pill badge-border border-success success">{{\App\Models\Menu::where('cooker_id', $cooker->id)->where('status', '1')->count()}} صنف</div>
                                                                <div class="badge badge-pill badge-border border-danger danger">{{\App\Models\Menu::where('cooker_id', $cooker->id)->where('status', '0')->count()}} صنف</div>
                                                                <div class="badge badge-pill badge-border border-info info">0 طلب</div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($cooker->status == '0')
                                                                <div class="badge badge-pill badge-border border-danger danger">غير مفعل</div>
                                                            @else
                                                                <div class="badge badge-pill badge-border border-success success">مفعل</div>
                                                            @endif
                                                        </td>
                                                     </td>
                                                        <td>
                                                            @if($cooker->confirm == '0')
                                                                <button type="button" class="btn btn-danger btn-round mr-1 mb-1">غير موثق</button>
                                                            @else
                                                                <button type="button" class="btn btn-success btn-round mr-1 mb-1">موثق</button>
                                                            @endif
                                                        </td>
                                                    <td>
{{--                                                        <a href="#" class="btn btn-success btn-sm" title="تعديل البيانات"><i class="ft-edit"></i></a>--}}
{{--                                                        <a href="#" class="btn btn-danger btn-sm" title="حذف البيانات"><i class="ft-delete"></i></a>--}}
{{--                                                        <a title="cooker" sec="cookers" class="confirmDelete" href="javascript:void(0)" sec="cookers" module="cooker" moduleid="{{ $cooker->id }}"><i--}}
{{--                                                                class="ft-delete"></i></a>--}}
                                                        <a title="تعديل-{{ $cooker->f_name }}" class="btn btn-success btn-sm" href="{{ url('dashboard/cookers/edit/'.$cooker->id) }}" ><i
                                                                class="ft-edit"></i></a>
                                                        <a title="حذف-{{ $cooker->f_name }}" class="confirmDelete btn btn-danger btn-sm" href="javascript:void(0)" sec="cookers" moduleid="{{ $cooker->id }}"><i
                                                                class="ft-delete"></i></a>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $cooker->id }}"
                                                                title="تعديل التفعيل {{ $cooker->f_name }}"><i class="ft-edit"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- edit_modal_Grade -->
                                                <div class="modal fade" id="edit{{ $cooker->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <!-- edit_form -->
                                                            <form action="{{ route('dashboard.cookers.updateConfirm', $cooker) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i> تفعيل السائق</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <h5><i class="la la-arrow-right"></i> بيانات الطباخ</h5>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <h5>اسم الطباخ</h5>
                                                                                <div class="controls">
                                                                                    <input type="text" name="client_code" value="{{ $cooker->f_name .' ' . $cooker->l_name }}" class="form-control ">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <h5>حالة التفعيل</h5>
                                                                                <select name="confirm" id="confirm" class="form-control">
                                                                                    <option value="0" @if(!empty($cooker->confirm)&&$cooker->confirm == 0) selected @endif>غير مفعل</option>
                                                                                    <option value="1" @if(!empty($cooker->confirm)&&$cooker->confirm == 1) selected @endif>مفعل</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{--                                                <div class="alert alert-success" role="alert">--}}
                                                                    {{--                                                    <span class="text-bold-600">Well done!</span> You successfully read this--}}
                                                                    {{--                                                    important alert message.--}}
                                                                    {{--                                                </div>--}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-outline-primary">حفظ البيانات</button>
                                                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">خروج</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                            <tfoot class="bg-success white">
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الطباخ</th>
                                                <th>المطبخ </th>
                                                <th>الحالة </th>
                                                <th>التوثيق </th>
                                                <th>أجراءات</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                    <div class="card-body card-dashboard">
{{--                                    {{ $cookers->links() }} <br>--}}
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
