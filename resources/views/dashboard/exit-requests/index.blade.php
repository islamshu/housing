@extends('layouts.master')
@section('title', 'طلبات الخروج')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">طلبات الخروج من السكن</h3>
                </div>
            </div>
            <div class="content-body">
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">قائمة الطلبات</h4>
                            <a href="{{ route('exit-requests.create') }}" class="btn btn-primary">إنشاء طلب جديد</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>المعلمة</th>
                                        <th>السكن</th>
                                        <th>نوع الخروج</th>
                                        <th>وقت الخروج</th>
                                        <th>وقت العودة المتوقع</th>
                                        <th>الوجهة</th>
                                        <th>وسيلة النقل</th>
                                        <th>المرافقات</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->teacher->name }}</td>
                                            <td>{{ $request->room->name }}</td>
                                            <td>{{ $request->type == 'daily' ? 'يومي' : 'مبيت خارجي' }}</td>
                                            <td>{{ $request->exit_time }}</td>
                                            <td>{{ $request->expected_return_time }}</td>
                                            <td>{{ $request->destination }}</td>
                                            <td>{{ $request->transport == 'regular' ? 'عادي' : 'تطبيق' }}</td>
                                            <td>
                                                @if ($request->companions->isNotEmpty())
                                                    <button class="btn btn-info btn-sm show-companions"
                                                        data-companions='@json($request->companions)'>
                                                        عرض المرافقات
                                                    </button>
                                                @else
                                                    <span class="text-muted">لا يوجد</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($request->status == 'pending')
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
                                                @if ($request->status == 'pending')
                                                    <a href="{{ route('exit-requests.approve', $request->id) }}"
                                                        class="btn btn-success btn-sm">موافقة</a>
                                                    <a href="{{ route('exit-requests.reject', $request->id) }}"
                                                        class="btn btn-danger btn-sm">رفض</a>
                                                @elseif($request->status == 'approved' && is_null($request->actual_return_time))
                                                    <button class="btn btn-info btn-sm complete-btn"
                                                        data-id="{{ $request->id }}"
                                                        data-transport="{{ $request->transport }}">تسجيل العودة</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal لعرض أسماء المرافقات -->
    <div class="modal fade" id="companionsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">قائمة المرافقات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="companionsList" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal لتسجيل العودة -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                        </div>
                        <div class="form-group">
                            <label for="actual_return_time">وقت العودة الفعلي</label>
                            <input type="datetime-local" class="form-control" name="actual_return_time" required>
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
            // عند الضغط على زر عرض المرافقات
            $('.show-companions').on('click', function() {
                let companions = $(this).data('companions');
                let listHtml = '';

                if (companions.length > 0) {
                    companions.forEach(companion => {
                        listHtml += `<li class="list-group-item">👤 ${companion.name}</li>`;
                    });
                } else {
                    listHtml = `<li class="list-group-item text-muted">لا يوجد مرافقات</li>`;
                }

                $('#companionsList').html(listHtml);
                $('#companionsModal').modal('show');
            });

            // عند الضغط على زر تسجيل العودة
            $(document).on('click', '.complete-btn', function() {
                const requestId = $(this).data('id');
                const transportType = $(this).data('transport');

                // تعيين وقت العودة الحالي كقيمة افتراضية
                const now = new Date();
                const formattedDateTime = now.toISOString().slice(0, 16);
                $('input[name="actual_return_time"]').val(formattedDateTime);

                // تعيين رابط الإجراء
                $('#completeForm').attr('action', `/exit-requests/${requestId}/complete`);

                // إظهار/إخفاء حقل رقم التكسي
                if (transportType === 'app') {
                    $('#taxiNumberGroup').show();
                    $('#taxi_number').prop('required', true);
                } else {
                    $('#taxiNumberGroup').hide();
                    $('#taxi_number').prop('required', false);
                }

                $('#completeModal').modal('show');
            });

            // عند إرسال النموذج
            $('#completeForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#completeModal').modal('hide');
                        location.reload(); // إعادة تحميل الصفحة لتحديث البيانات
                    },
                    error: function(xhr) {
                        alert('حدث خطأ: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection
