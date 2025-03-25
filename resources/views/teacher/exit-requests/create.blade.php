@extends('layouts.teacher')

@section('title', 'إنشاء طلب خروج')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">إنشاء طلب خروج جديد</h3>
            </div>
        </div>
        <div class="content-body">
            <section>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('teacher.exit-requests.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">نوع الخروج</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="daily">خروج يومي (عودة نفس اليوم)</option>
                                            <option value="overnight">مبيت خارج السكن</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transport">وسيلة النقل</label>
                                        <select name="transport" id="transport" class="form-control" required>
                                            <option value="regular">مواصلات عادية</option>
                                            <option value="app">تطبيق نقل</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exit_time">وقت الخروج</label>
                                        <input type="datetime-local" class="form-control" name="exit_time" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expected_return_time">وقت العودة المتوقع</label>
                                        <input type="datetime-local" class="form-control" name="expected_return_time" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="destination">الوجهة</label>
                                <input type="text" class="form-control" name="destination" required>
                            </div>

                            <div class="form-group">
                                <label>هل يوجد مرافقات؟</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="has_companion" id="no_companion" value="0" checked>
                                    <label class="form-check-label" for="no_companion">لا</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="has_companion" id="has_companion" value="1">
                                    <label class="form-check-label" for="has_companion">نعم</label>
                                </div>
                            </div>

                            <div class="form-group companion-select" style="display: none;">
                                <label for="companions">اختر المعلمات المرافقات</label>
                                <select name="companions[]" id="companions" class="form-control select2" multiple>
                                    @foreach($colleagues as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notes">ملاحظات إضافية</label>
                                <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">تقديم الطلب</button>
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
        $('.select2').select2({
            placeholder: "اختر المعلمات",
            dir: "rtl"
        });

        $('input[name="has_companion"]').change(function() {
            $('.companion-select').toggle($(this).val() == '1');
        });

        // Set minimum datetime for exit time (current time)
        const now = new Date();
        const formattedNow = now.toISOString().slice(0, 16);
        $('input[name="exit_time"]').attr('min', formattedNow);
        
        // Update return time min when exit time changes
        $('input[name="exit_time"]').change(function() {
            $('input[name="expected_return_time"]').attr('min', $(this).val());
        });
    });
</script>
@endsection