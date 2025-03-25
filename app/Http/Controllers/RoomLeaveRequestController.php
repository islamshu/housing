<?php
namespace App\Http\Controllers;

use App\Models\RoomLeaveRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class RoomLeaveRequestController extends Controller
{
    public function create()
    {
        $user = Teacher::find(29);
        $rooms = $user->rooms; // المعلمات المرتبطة بغرف
        return view('dashboard.leave_requests.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'type' => 'required|in:daily,overnight',
            'exit_time' => 'required|date',
            'return_time' => 'required|date|after:exit_time',
            'destination' => 'required|string|max:255',
            'transport' => 'required|in:normal,app',
        ]);

        RoomLeaveRequest::create([
            'employee_id' => auth()->id(),
            'room_id' => $request->room_id,
            'type' => $request->type,
            'exit_time' => $request->exit_time,
            'return_time' => $request->return_time,
            'destination' => $request->destination,
            'transport' => $request->transport,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'تم تقديم طلب الخروج بنجاح');
    }

    public function approve(Request $request, $id)
    {
        $leaveRequest = RoomLeaveRequest::findOrFail($id);
        
        $request->validate([
            'taxi_number' => 'required_if:transport,app|string|max:255'
        ]);

        $leaveRequest->update([
            'status' => 'approved',
            'taxi_number' => $request->taxi_number
        ]);

        return redirect()->back()->with('success', 'تمت الموافقة على الطلب');
    }

    public function reject($id)
    {
        $leaveRequest = RoomLeaveRequest::findOrFail($id);
        $leaveRequest->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'تم رفض الطلب');
    }

    public function bulkReturn(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'return_time' => 'required|date'
        ]);

        RoomLeaveRequest::where('room_id', $request->room_id)
            ->where('status', 'approved')
            ->where('return_time', '>', now())
            ->update(['return_time' => $request->return_time]);

        return redirect()->back()->with('success', 'تم تحديث مواعيد العودة لجميع المعلمات');
    }
}