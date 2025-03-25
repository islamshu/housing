@extends('layouts.teacher')

@section('title', 'تفاصيل طلب الخروج')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="font-size:1.4rem">
                    <i class="fas fa-door-open ml-1"></i> تفاصيل طلب الخروج
                </h3>
            </div>
        </div>
        <div class="content-body">
            <section>
                <div class="card" style="border-radius:0.5rem;box-shadow:0 2px 8px rgba(0,0,0,0.08)">
                    <div class="card-body py-2">
                        <div class="row">
                            <!-- الجانب الأيمن -->
                            <div class="col-md-6 pr-md-2">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-calendar-alt ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">نوع الخروج:</span>
                                    <strong class="mr-auto {{ $exitRequest->type == 'daily' ? 'text-success' : 'text-info' }}">
                                        {{ $exitRequest->type == 'daily' ? 'يومي' : 'مبيت خارجي' }}
                                    </strong>
                                </div>

                                <div class="d-flex align-items-center mb-1">
                                    <i class="far fa-clock ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">وقت الخروج:</span>
                                    <strong class="mr-auto">{{ $exitRequest->exit_time }}</strong>
                                </div>

                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-home ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">السكن:</span>
                                    <strong class="mr-auto">{{ $exitRequest->room->name }}</strong>
                                </div>
                            </div>

                            <!-- الجانب الأيسر -->
                            <div class="col-md-6 pl-md-2 mt-md-0 mt-1">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-info-circle ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">الحالة:</span>
                                    <span class="mr-auto">
                                        @if($exitRequest->status == 'pending')
                                            <span class="badge badge-sm badge-warning py-1">قيد الانتظار</span>
                                        @elseif($exitRequest->status == 'approved')
                                            <span class="badge badge-sm badge-success py-1">موافق عليه</span>
                                        @elseif($exitRequest->status == 'rejected')
                                            <span class="badge badge-sm badge-danger py-1">مرفوض</span>
                                        @else
                                            <span class="badge badge-sm badge-info py-1">مكتمل</span>
                                        @endif
                                    </span>
                                </div>

                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-clock ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">وقت العودة:</span>
                                    <strong class="mr-auto">{{ $exitRequest->expected_return_time }}</strong>
                                </div>

                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-car ml-2 text-secondary" style="width:20px"></i>
                                    <span class="text-muted">الوسيلة:</span>
                                    <strong class="mr-auto {{ $exitRequest->transport == 'regular' ? 'text-primary' : 'text-purple' }}">
                                        {{ $exitRequest->transport == 'regular' ? 'عادي' : 'تطبيق نقل' }}
                                        @if($exitRequest->transport == 'app' && $exitRequest->actual_return_time)
                                            <small class="d-block text-muted" style="font-size:0.8rem">
                                                <i class="fas fa-taxi"></i> رقم التاكسي: {{ $exitRequest->taxi_number }}
                                            </small>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <!-- الوجهة -->
                        <div class="d-flex align-items-start mt-2 pt-2 border-top">
                            <i class="fas fa-map-marker-alt mt-1 ml-2 text-secondary" style="width:20px"></i>
                            <div>
                                <div class="text-muted mb-1">الوجهة</div>
                                <div style="font-size:0.95rem">{{ $exitRequest->destination }}</div>
                            </div>
                        </div>

                        <!-- المرافقات -->
                        @if($exitRequest->has_companion)
                        <div class="mt-2 pt-2 border-top">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-users ml-2 text-secondary" style="width:20px"></i>
                                <span class="text-muted">المرافقات</span>
                            </div>
                            <div class="pl-4" style="font-size:0.9rem">
                                @forelse($exitRequest->companions as $companion)
                                <div class="d-flex align-items-center mb-1">
                                    <i class="far fa-user ml-2 text-muted" style="font-size:0.8rem"></i>
                                    <span>{{ $companion->name }}</span>
                                </div>
                                @empty
                                <div class="text-muted">لا يوجد مرافقات</div>
                                @endforelse
                            </div>
                        </div>
                        @endif

                        <!-- الملاحظات -->
                        @if($exitRequest->notes)
                        <div class="mt-2 pt-2 border-top">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-sticky-note ml-2 text-secondary" style="width:20px"></i>
                                <span class="text-muted">ملاحظات</span>
                            </div>
                            <div class="bg-light p-2 rounded" style="font-size:0.9rem">
                                {{ $exitRequest->notes }}
                            </div>
                        </div>
                        @endif

                        <!-- تاريخ الإنشاء -->
                        <div class="d-flex align-items-center mt-2 pt-2 border-top">
                            <i class="far fa-calendar-alt ml-2 text-secondary" style="width:20px"></i>
                            <span class="text-muted">تاريخ الإنشاء:</span>
                            <span class="mr-auto" style="font-size:0.9rem">
                                {{ $exitRequest->created_at }}
                            </span>
                        </div>

                        <!-- الأزرار -->
                        <div class="text-center mt-3 pt-3 border-top">
                            @if($exitRequest->status == 'pending')
                                <a href="{{ route('teacher.exit-requests.edit', $exitRequest->id) }}" 
                                   class="btn btn-sm btn-warning mx-1">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                            @endif
                            
                            <a href="{{ route('teacher.exit-requests.index') }}" 
                               class="btn btn-sm btn-secondary mx-1">
                                <i class="fas fa-list"></i> القائمة
                            </a>
                            
                          
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .text-purple { color: #7367f0; }
    .card-body { padding: 1.2rem; }
    .border-top { border-top: 1px solid #f1f1f1 !important; }
    .badge-sm { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
    .btn-sm { padding: 0.35rem 0.8rem; font-size: 0.85rem; }
</style>
@endsection