@extends('layouts.master')
@section('title','تعديل السكن')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('تعديل السكن') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">{{ __('السكنات') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('تعديل السكن') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section>
                <div class="card">
                    <div class="card-body">
                        @include('dashboard.inc.alerts')

                        <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                               

                                <!-- عنوان السكن -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('عنوان السكن') }} <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $room->name }}" required>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('الفرع ') }} <span class="required">*</span></label>
                                        <select name="branch_id" class="form-control" required id="">
                                            <option value="" disabled selected>اختر الفرع</option>
                                            @foreach ($branches as $item)
                                                <option value="{{$item->id}}" @if($room->branch_id == $item->id ) selected @endif>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- سعر السكن بعد الخصم -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="room_number">{{ __('عدد غرف السكن') }} <span class="required">*</span></label>
                                        <input type="number" name="room_number" id="room_number" class="form-control" value="{{ $room->room_number }}" required>
                                        @error('room_number')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- سعر السكن قبل الخصم -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number_employee">{{ __('عدد اتساع المعلمات') }} <span class="required">*</span></label>
                                        <input type="number" name="number_employee" id="number_employee" class="form-control" value="{{ $room->number_employee }}" required>
                                        @error('number_employee')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                      
                            <!-- زر التحديث -->
                            <button type="submit" class="btn btn-primary">{{ __('تحديث السكن') }}</button>
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
    $(document).ready(function () {
        // عرض معاينة للصورة المختارة
        $('#image').change(function () {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection