@extends('layouts.teacher')

@section('title', 'طلبات الخروج')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">طلبات الخروج</h3>
            </div>
        </div>
        <div class="content-body">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">قائمة الطلبات</h4>
                        <a href="{{ route('teacher.exit-requests.create') }}" class="btn btn-primary">
                            <i class="ft-plus"></i> إنشاء طلب جديد
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="exit-requests-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاريخ الطلب</th>
                                        <th>وقت الخروج</th>
                                        <th>وقت العودة المتوقع</th>
                                        <th>الوجهة</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exitRequests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $request->exit_time }}</td>
                                        <td>{{ $request->expected_return_time }}</td>
                                        <td>{{ $request->destination }}</td>
                                        <td>
                                            @if($request->status == 'pending')
                                                <span class="badge badge-warning">قيد الانتظار</span>
                                            @elseif($request->status == 'approved')
                                                <span class="badge badge-success">موافق عليه</span>
                                            @elseif($request->status == 'rejected')
                                                <span class="badge badge-danger">مرفوض</span>
                                            @else
                                                <span class="badge badge-info">مكتمل</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('teacher.exit-requests.show', $request->id) }}" 
                                               class="btn btn-sm btn-info"
                                               title="عرض التفاصيل">
                                               مشاهدة
                                                <i class="ft-eye"></i>
                                            </a>
                                            
                                           
                                            
                                            @if($request->status == 'approved' && is_null($request->actual_return_time))
                                                <button class="btn btn-sm btn-success complete-btn" 
                                                        data-id="{{ $request->id }}"
                                                        data-transport="{{ $request->transport }}"
                                                        title="تسجيل العودة">
                                                        تسجيل عودة
                                                    <i class="ft-check-circle"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal لتسجيل العودة -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تسجيل العودة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="completeForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" id="taxiNumberGroup" style="display: none;">
                        <label for="taxi_number">رقم التكسي</label>
                        <input type="text" class="form-control" name="taxi_number" id="taxi_number">
                        <small class="text-muted">مطلوب في حالة النقل عبر التطبيق</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="actual_return_time">وقت العودة الفعلي</label>
                        <input type="datetime-local" class="form-control" name="actual_return_time" required 
                               value="{{ now()->format('Y-m-d\TH:i') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="return_notes">ملاحظات العودة (اختياري)</label>
                        <textarea class="form-control" name="return_notes" id="return_notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تأكيد العودة</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Initialize DataTable
   

    // Handle return completion button
    $(document).on('click', '.complete-btn', function() {
        const requestId = $(this).data('id');
        const transportType = $(this).data('transport');
        
        // Set form action
        $('#completeForm').attr('action', '/teacher/exit-requests/' + requestId + '/complete');
        
        // Show/hide taxi number field
        if (transportType === 'app') {
            $('#taxiNumberGroup').show();
            $('#taxi_number').prop('required', true);
        } else {
            $('#taxiNumberGroup').hide();
            $('#taxi_number').prop('required', false);
        }
        
        $('#completeModal').modal('show');
    });

    // Form submission
    $('#completeForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#completeModal').modal('hide');
                location.reload(); // Refresh to show updated status
            },
            error: function(xhr) {
                alert('حدث خطأ: ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>
@endsection