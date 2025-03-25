@extends('layouts.master')
@section('title','الرئيسية')
@section('content')
<section>
    <!-- Quick Stats -->
    
    
    <div class="row m-2">
        <!-- Total Requests -->
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
            <div class="card bg-primary text-white h-100">
                <div class="card-content">
                    <div class="card-body p-2">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4 class="mb-0">{{ \App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})
                            ::count() }}</h4>
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
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
            <div class="card bg-success text-white h-100">
                <div class="card-content">
                    <div class="card-body p-2">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4 class="mb-0">
                                    {{ \App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})
                            ->where('status', 'approved')->count() }}
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
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
            <div class="card bg-warning text-white h-100">
                <div class="card-content">
                    <div class="card-body p-2">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4 class="mb-0">
                                    {{ \App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})
                            ->where('status', 'pending')->count() }}
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
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
            <div class="card bg-danger text-white h-100">
                <div class="card-content">
                    <div class="card-body p-2">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4 class="mb-0">
                                    {{ \App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})
                            ->where('status', 'rejected')->count() }}
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
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
            <div class="card bg-secondary text-white h-100">
                <div class="card-content">
                    <div class="card-body p-2">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4 class="mb-0">
                                    {{ \App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})
                            ->where('status', 'completed')->count() }}
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
    </div>

    <!-- Recent Exit Requests -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">آخر طلبات الخروج</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>المعلم</th>
                            <th>التاريخ</th>
                            <th>نوع الخروج</th>
                            <th>الوجهة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\ExitRequest::with(['teacher', 'room'])
                        ->whereHas('room', function($query) {
                            $query->where('admin_id', auth()->id());})->take(5)->get() as $request)
                            <tr>
                                <td>{{ $request->teacher->name ?? 'غير معروف' }}</td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td>{{ $request->type == 'daily' ? 'يومي' : 'مبيت' }}</td>
                                <td>{{ $request->destination }}</td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <span class="badge badge-warning">قيد الانتظار</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge badge-success">موافق عليه</span>
                                    @elseif($request->status == 'completed')
                                        <span class="badge badge-info">مكتمل</span>
                                    @else
                                        <span class="badge badge-danger">مرفوض</span>
                                    @endif
                                </td>
                               
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا توجد طلبات خروج</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
    </div>
@endsection
