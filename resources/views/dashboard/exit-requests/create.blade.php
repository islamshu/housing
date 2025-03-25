@extends('layouts.master')
@section('title', 'إنشاء طلب خروج')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">إنشاء طلب خروج</h3>
            </div>
        </div>
        <div class="content-body">
            <section>
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title text-primary">بيانات الطلب الأساسية</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('exit-requests.store') }}" method="POST" class="form form-horizontal">
                            @csrf
                            
                            <div class="form-body">
                                <!-- Teacher Selection -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="teacher_id" class="mb-1">المعلمة الرئيسية</label>
                                            <select name="teacher_id" id="teacher_id" class="form-control select2" required style="width: 100%">
                                                <option value="">اختر المعلمة</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }} - {{ $teacher->room->sortByDesc('pivot.updated_at')->first()->name ?? 'لا يوجد سكن' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Exit Type and Transport -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-1">نوع الخروج</label>
                                            <div class="d-flex">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="type" id="daily" value="daily" {{ old('type', 'daily') == 'daily' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="daily">يومي</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type" id="overnight" value="overnight" {{ old('type') == 'overnight' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="overnight">مبيت</label>
                                                </div>
                                            </div>
                                            @error('type')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-1">وسيلة النقل</label>
                                            <div class="d-flex">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="transport" id="regular" value="regular" {{ old('transport', 'regular') == 'regular' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="regular">عادي</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="transport" id="app" value="app" {{ old('transport') == 'app' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="app">تطبيق</label>
                                                </div>
                                            </div>
                                            @error('transport')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Exit and Return Times -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exit_time" class="mb-1">وقت الخروج</label>
                                            <input type="datetime-local" class="form-control flatpickr" name="exit_time" value="{{ old('exit_time') }}" required>
                                            @error('exit_time')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expected_return_time" class="mb-1">وقت العودة</label>
                                            <input type="datetime-local" class="form-control flatpickr" name="expected_return_time" value="{{ old('expected_return_time') }}" required>
                                            @error('expected_return_time')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Destination and Companion Toggle -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="destination" class="mb-1">الوجهة</label>
                                            <input type="text" class="form-control" name="destination" value="{{ old('destination') }}" placeholder="أدخل الوجهة" required>
                                            @error('destination')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-1">هل يوجد مرافقات؟</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input companion-toggle" type="radio" name="has_companion" id="no_companion" value="0" {{ old('has_companion', 0) == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="no_companion">لا يوجد</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input companion-toggle" type="radio" name="has_companion" id="has_companion" value="1" {{ old('has_companion') == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="has_companion">يوجد</label>
                                                </div>
                                            </div>
                                            @error('has_companion')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Companion Selection -->
                                <div class="row companion-select" style="display: {{ old('has_companion') == 1 ? 'block' : 'none' }};">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="companions">المعلمات المرافقات</label>
                                            <select name="companions[]" id="companions" class="form-control select2" multiple style="width: 100%">
                                                @if(old('companions'))
                                                    @foreach($teachers->whereIn('id', old('companions')) as $teacher)
                                                        <option value="{{ $teacher->id }}" selected>{{ $teacher->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="text-muted">يمكن اختيار أكثر من معلمة</small>
                                            @error('companions')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="ft-save"></i> تقديم الطلب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    console.log("Document ready!");

    $('.select2').select2({
        placeholder: "اختر...",
        allowClear: true,
        dir: "rtl"
    });


    // عند تغيير اختيار المرافقات
    $(document).on('change', '.companion-toggle', function() {
        if ($(this).val() == '1') {
            $('.companion-select').slideDown();

            // جلب المعلمات من نفس السكن
            let teacherId = $('#teacher_id').val();
            if (teacherId) {
                loadCompanions(teacherId);
            }
        } else {
            $('.companion-select').slideUp();
            $('#companions').empty().trigger('change'); // مسح الخيارات عند عدم الحاجة إليها
        }
    });

    // عند تغيير المعلمة الرئيسية، إعادة تحميل المرافقات إذا كان خيار "يوجد مرافقات" مفعلاً
    $('#teacher_id').change(function() {
        if ($('input[name="has_companion"]:checked').val() == '1') {
            loadCompanions($(this).val());
        }
    });

    // تحميل قائمة المرافقات عبر AJAX
    function loadCompanions(teacherId) {
        let url = "{{ route('getCompanions', ':id') }}".replace(':id', teacherId);

        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function() {
                $('#companions').prop('disabled', true).empty().append('<option>جارٍ التحميل...</option>');
            },
            success: function(data) {
                let companionsSelect = $('#companions');
                companionsSelect.empty().prop('disabled', false);

                if (data.length > 0) {
                    $.each(data, function(index, teacher) {
                        companionsSelect.append(`<option value="${teacher.id}">${teacher.name}</option>`);
                    });

                    // إعادة تهيئة Select2 بعد التحميل
                    companionsSelect.select2({
                        placeholder: "اختر المرافقات",
                        allowClear: true,
                        dir: "rtl"
                    });

                    // استرجاع القيم السابقة إذا كانت موجودة
                    @if(old('companions'))
                        companionsSelect.val(@json(old('companions'))).trigger('change');
                    @endif
                } else {
                    companionsSelect.append('<option value="" disabled>لا يوجد معلمات متاحات</option>');
                }
            },
            error: function() {
                console.error('فشل في تحميل قائمة المرافقات');
                $('#companions').prop('disabled', false).empty().append('<option value="" disabled>حدث خطأ، حاول مرة أخرى</option>');
            }
        });
    }

    // تحميل المرافقات إذا كان هناك خطأ في التحقق من الإدخال عند العودة إلى الصفحة
    @if(old('has_companion') == 1 && old('teacher_id'))
        loadCompanions({{ old('teacher_id') }});
    @endif
});



</script>
@endsection

@section('styles')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .card {
        border-radius: 0.5rem;
    }
    .card-header {
        border-bottom: 1px solid #eee;
        background-color: #f8f9fa;
    }
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
    }
    .flatpickr-input {
        background-color: white;
    }
    .text-danger {
        font-size: 0.85rem;
    }
</style>
@endsection