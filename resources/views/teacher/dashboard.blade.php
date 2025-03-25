@extends('layouts.teacher')

@section('title', 'لوحة تحكم المعلمة')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">مرحبا بك، {{ auth()->guard('teacher')->user()->name }}</h3>
                </div>
            </div>
            <div class="content-body">
                <section>
                    <!-- Quick Stats -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-info text-white">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h3>{{ auth()->guard('teacher')->user()->room->sortByDesc('pivot.updated_at')->first()->name ?? 'غير معين' }}
                                                </h3>
                                                <span>السكن الحالي</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-home font-large-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Total Requests -->
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h4 class="mb-0">
                                                    {{ auth()->guard('teacher')->user()->exitRequests()->count() }}</h4>
                                                <small>إجمالي الطلبات</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-file font-large-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Approved -->
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                            <div class="card bg-success text-white h-100">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h4 class="mb-0">
                                                    {{ auth()->guard('teacher')->user()->exitRequests()->where('status', 'approved')->count() }}
                                                </h4>
                                                <small>طلبات مقبولة</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-check-circle font-large-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending -->
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h4 class="mb-0">
                                                    {{ auth()->guard('teacher')->user()->exitRequests()->where('status', 'pending')->count() }}
                                                </h4>
                                                <small>طلبات قيد المراجعة</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-clock font-large-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rejected -->
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                            <div class="card bg-danger text-white h-100">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h4 class="mb-0">
                                                    {{ auth()->guard('teacher')->user()->exitRequests()->where('status', 'rejected')->count() }}
                                                </h4>
                                                <small>طلبات مرفوضة</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-x-circle font-large-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Completed -->
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                            <div class="card bg-secondary text-white h-100">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="media d-flex">
                                            <div class="media-body text-right">
                                                <h4 class="mb-0">
                                                    {{ auth()->guard('teacher')->user()->exitRequests()->where('status', 'completed')->count() }}
                                                </h4>
                                                <small>طلبات مكتملة</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-check-square font-large-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Room -->

                    </div>

                    <!-- Current Room Card (below the status cards) -->


                    <!-- Recent Exit Requests -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">آخر طلبات الخروج</h4>
                            <a href="{{ route('teacher.exit-requests.create') }}" class="btn btn-primary">
                                <i class="ft-plus"></i> طلب خروج جديد
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>التاريخ</th>
                                            <th>نوع الخروج</th>
                                            <th>الوجهة</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(auth()->guard('teacher')->user()->exitRequests()->latest()->take(5)->get() as $request)
                                            <tr>
                                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $request->type == 'daily' ? 'يومي' : 'مبيت' }}</td>
                                                <td>{{ $request->destination }}</td>
                                                <td>
                                                    @if ($request->status == 'pending')
                                                        <span class="badge badge-warning">قيد الانتظار</span>
                                                    @elseif($request->status == 'approved')
                                                        <span class="badge badge-success">موافق عليه</span>
                                                    @elseif($request->status == 'completed')
                                                        <span class="badge badge-info">مكتمل </span>
                                                    @else
                                                        <span class="badge badge-danger">مرفوض</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('teacher.exit-requests.show', $request->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="ft-eye"></i> عرض
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">لا توجد طلبات خروج</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
