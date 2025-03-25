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
                            <li class="breadcrumb-item"><a href="javascript:;">privacys</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.privacys.create') }}">اضف privacy جديد</a>
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
                                <h4 class="card-title">privacys</h4>
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
                                    @if($privacys->count())
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dom-jQuery-events">
                                            <thead class="bg-success white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>الاسم</th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach($privacys as $privacy)
                                                <tr class="border-bottom-teal border-bottom-darken-2 border-custom-color">
                                                    <?php $i++; ?>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $privacy->name }}</td>
                                                
                                                    <td>
                                                        <a title="حذف-{{ $privacy->name }}" class="confirmDeleteTr btn btn-sm btn-outline-warning" href="javascript:void(0)" sec="privacys" module="softDelete" moduleid="{{ $privacy->id }}"><i
                                                                class="la la-bitbucket-square"></i></a>
                                                        <a title="تعديل-{{ $privacy->name }}" href="{{ route('dashboard.privacys.edit', $privacy->id) }}" class="btn btn-sm btn-outline-info"><i
                                                                class="la la-edit"></i></a>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            <tfoot class="bg-success white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>الاسم</th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                    
                                    @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-center">عفوا</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <p>لا يوجد <code>.privacys</code> حاليا</p>
                                                <div class="badge badge-success"><a href="{{ route('dashboard.privacys.create') }}">اضف privacy جديد</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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