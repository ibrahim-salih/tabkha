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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.sections.create') }}">اضف قسم جديد</a>
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
                                <h4 class="card-title">الاقسام المهملة</h4>
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
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                @if($sections->count())
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dom-jQuery-events">
                                        <thead class="bg-warning white">
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>اجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($sections as $section)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $section->name }}</td>
                                                
                                                <td >
                                            
                                                    <a title="حذف-{{ $section->name }}" class="confirmDelete btn btn-sm btn-outline-danger" href="javascript:void(0)" sec="sections" module="delete" moduleid="{{ $section->id }}"><i
                                                            class="la la-times-circle-o"></i></a>
                                                     
                                                        <a title="استعادة-{{ $section->name }}" href="{{ route('dashboard.sections.restore', $section->id) }}" class="btn btn-sm btn-outline-success"><i
                                                            class="ft-repeat"></i></a>
                                                        @endforeach
                                        </tbody>
                                        <tfoot class="bg-warning warning">
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>اجراءات</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                {{ $sections->links('pagination::simple-bootstrap-5') }}
                                @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-center">عفوا</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <p>لا يوجد <code>.اقسام</code> مهملة</p>
                                                <div class="badge badge-success"><a href="{{ route('dashboard.sections.create') }}">اضف قسم جديد</a></div>
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
