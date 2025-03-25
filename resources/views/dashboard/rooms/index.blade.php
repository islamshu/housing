@extends('layouts.master')
@section('title', 'السكن')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{ __('السكن') }}</h3>
                </div>
            </div>
            <div class="content-body">
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('قائمة السكن') }}</h4>
                           @if(auth()->->hasRole(['اداري', 'مشرف اداري']))
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#addImageModal">{{ __('إضافة سكن جديد') }}</button>
                            @endif
                        </div>
                        <div class="card-body">
                            @include('dashboard.inc.alerts')

                            <table class="table" id="roomstable">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>{{ __('اسم السكن') }}</th>
                                        <th>{{ __('الفرع') }}</th>
                                        <th>{{ __('مشرف السكن') }}</th>

                                        <th>{{ __('عدد الغرف') }}</th>
                                        <th>{{ __('عدد اتساع المعلمات') }}</th>
                                        <th>{{ __('عدد المعلمات حاليا في السكن') }}</th>
                                        <th>{{ __('اضافة معلمات للسكن') }}</th>
                                        @if(auth()->->hasRole(['اداري', 'مشرف اداري']))

                                        <th>{{ __('الإجراءات') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $key => $room)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $room->name }}</td>

                                            <td>{{ $room->branch->title }}</td>
                                            <td>{{ $room->admin->name }}</td>

                                            <td>{{ $room->room_number }}</td>
                                            <td>{{ $room->number_employee }}</td>
                                            <td>
                                                <button class="btn btn-info show-employees"
                                                    data-room-id="{{ $room->id }}">
                                                    {{ $room->employess->count() }}
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-success add-teacher-btn"
                                                    data-room-id="{{ $room->id }}"
                                                    data-branch-id="{{$room->branch_id}}"
                                                    data-room-name="{{ $room->name }}" data-toggle="modal"
                                                    data-target="#addTeacherModal">
                                                    {{ __('اضف معلمة') }}
                                                </button>
                                            </td>
                                            @if(auth()->->hasRole(['اداري', 'مشرف اداري']))

                                            <td>
                                                <a href="{{ route('rooms.edit', $room->id) }}"
                                                    class="btn btn-warning">{{ __('تعديل') }}</a>
                                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('{{ __('هل أنت متأكد؟') }}')">{{ __('حذف') }}</button>
                                                </form>
                                            </td>
                                            @endif
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
    <div class="modal fade" id="employeesModal" tabindex="-1" role="dialog" aria-labelledby="employeesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">قائمة المعلمات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="employee-list" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeacherModalLabel">{{ __('إضافة معلمات إلى السكن') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rooms.addEmployees') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" id="modal-room-id">

                        <div class="form-group">
                            <label for="employees">{{ __('اختر المعلمات') }}</label>
                            <select name="employee_ids[]" id="employees-list" class="form-control select2" multiple
                                required>
                                <!-- سيتم تحميل القائمة باستخدام AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('إضافة') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">{{ __('إضافة سكن جديد') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">{{ __('اسم السكن') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="room_number">{{ __('عدد الغرف') }}</label>
                            <input type="number" class="form-control" name="room_number" required>
                        </div>
                        <div class="form-group">
                            <label for="number_employee">{{ __('عدد المعلمات المسموح في السكن') }}</label>
                            <input type="number" class="form-control" name="number_employee" required>
                        </div>
                        <div class="form-group">
                            <label for="number_employee">{{ __('الفرع') }}</label>
                            <select name="branch_id" class="form-control" required id="">
                                <option value="" disabled selected>اختر الفرع</option>
                                @foreach ($branches as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number_employee">{{ __('مشرف السكن') }}</label>
                            <select name="admin_id" class="form-control" required id="">
                                <option value="" disabled selected>اختر المشرف</option>
                                @foreach ($admins as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                     

                        <button type="submit" class="btn btn-primary">{{ __('إضافة') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.show-employees').on('click', function() {
                let roomId = $(this).data('room-id');

                $.ajax({
                    url: "{{ route('rooms.getEmployees') }}",
                    type: "GET",
                    data: {
                        room_id: roomId
                    },
                    success: function(response) {
                        let employeesList = $('#employee-list');
                        employeesList.empty();

                        if (response.employess.length > 0) {
                            response.employess.forEach(function(employee) {
                                employeesList.append(`
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${employee.name}
                                    <button class="btn btn-danger btn-sm delete-employee" data-employee-id="${employee.id}" data-room-id="${roomId}">حذف</button>
                                </li>
                            `);
                            });
                        } else {
                            employeesList.append(
                                '<li class="list-group-item text-center">لا يوجد معلمات في هذه الغرفة</li>'
                                );
                        }

                        $('#employeesModal').modal('show');
                    }
                });
            });

            // حذف المعلمة بالـ AJAX
            $(document).on('click', '.delete-employee', function() {
                let employeeId = $(this).data('employee-id');
                let roomId = $(this).data('room-id');
                let listItem = $(this).closest('li');

                $.ajax({
                    url: "{{ route('rooms.removeEmployee') }}",
                    type: "POST",
                    data: {
                        employee_id: employeeId,
                        room_id: roomId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        listItem.fadeOut(300, function() {
                            $(this).remove();
                        });
                        let roomButton = $('.show-employees[data-room-id="' + roomId + '"]');
                        let currentCount = parseInt(roomButton.text());
                        roomButton.text(currentCount - 1);
                        toastr.error("تم الحذف من القائمة بنجاح");


                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.add-teacher-btn').on('click', function() {
                let roomId = $(this).data('room-id');
                let roomName = $(this).data('room-name');
                let branch_id = $(this).data('branch-id');

                // تحديث بيانات الـ modal
                $('#modal-room-id').val(roomId);
                $('#addTeacherModalLabel').text('إضافة معلمات إلى ' + roomName);

                // جلب المعلمات عبر AJAX
                $.ajax({
                    url: "{{ route('rooms.getAvailableEmployees') }}",
                    type: "GET",
                    data: {
                        room_id: roomId,
                        branch_id:branch_id
                    },
                    success: function(data) {
                        let employeesList = $('#employees-list');
                        employeesList.empty();

                        if (data.length > 0) {
                            $.each(data, function(index, employee) {
                                employeesList.append('<option value="' + employee.id +
                                    '">' + employee.name + '</option>');
                            });
                        } else {
                            employeesList.append(
                                '<option disabled>{{ __('لا يوجد معلمات متاحات') }}</option>'
                            );
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "اختر موظف",
                allowClear: true
            });
        });
    </script>


@endsection
