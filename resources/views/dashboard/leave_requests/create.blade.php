@extends('layouts.master')
@section('title', 'طلب خروج من السكن')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>طلب خروج من السكن</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('leave-requests.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>السكن الحالي</label>
                <select name="room_id" class="form-control" required>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>نوع الخروج</label>
                <select name="type" class="form-control" required>
                    <option value="daily">عودة اليوم</option>
                    <option value="overnight">مبيت خارج السكن</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>موعد الخروج</label>
                        <input type="datetime-local" name="exit_time" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>موعد العودة</label>
                        <input type="datetime-local" name="return_time" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>المكان المقصود</label>
                <input type="text" name="destination" class="form-control" required>
            </div>

            <div class="form-group">
                <label>وسيلة النقل</label>
                <select name="transport" class="form-control" required>
                    <option value="normal">عادي</option>
                    <option value="app">تطبيق</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">تقديم الطلب</button>
        </form>
    </div>
</div>
@endsection