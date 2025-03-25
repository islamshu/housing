<?php

namespace App\Http\Controllers\Teacher;

use App\Admin;
use App\Events\ExitRequest as EventsExitRequest;
use App\Events\ExitRequestCreated;
use App\Http\Controllers\Controller;
use App\Models\ExitRequest;
use App\Models\Teacher;
use App\Notifications\ExitRequestCreatedNotification;
use App\Notifications\ExitRequestSubmitted;
use ExitRequestCreated as GlobalExitRequestCreated;
use Illuminate\Http\Request;

class ExitRequestController extends Controller
{
    public function index()
    {
        $exitRequests = auth()->guard('teacher')->user()->exitRequests;
        return view('teacher.exit-requests.index', compact('exitRequests'));
    }

    public function create()
    {
        $teacher = auth()->guard('teacher')->user();
        if( $teacher->currentRoom() == null){
            return redirect()->back()->with('toastr_error','انت غير مدرج بالسكن');
        }
        // Get colleagues from the same room
        $colleagues = Teacher::whereHas('room', function ($query) use ($teacher) {
            $query->where('rooms.id', $teacher->currentRoom()->id);
        })
            ->where('id', '!=', $teacher->id)
            ->get(['id', 'name']);

        return view('teacher.exit-requests.create', compact('colleagues'));
    }
    public function store(Request $request)
    {
        $teacher = auth()->guard('teacher')->user();
        $currentRoom = $teacher->currentRoom();
        if (!$currentRoom) {
            return back()->with('error', 'يجب أن تكوني مسجلة في سكن أولاً');
        }
        $validated = $request->validate([
            'type' => 'required|in:daily,overnight',
            'exit_time' => 'required|date',
            'expected_return_time' => 'required|date|after:exit_time',
            'destination' => 'required|string|max:255',
            'transport' => 'required|in:regular,app',
            'has_companion' => 'required|boolean',
            'companions' => 'nullable|array',
        ]);

        $teacher = auth()->guard('teacher')->user();

        $exitRequest = $teacher->exitRequests()->create([
            'room_id' => $currentRoom->id, // Add this line
            'type' => $request->type,
            'exit_time' => $request->exit_time,
            'expected_return_time' => $request->expected_return_time,
            'destination' => $request->destination,
            'transport' => $request->transport,
            'has_companion' => $request->has_companion,
            'status' => 'pending',
        ]);

        if ($request->has_companion && $request->companions) {
            $exitRequest->companions()->attach($request->companions);
        }
        $admins = Admin::all(); // Retrieve all admins
    foreach ($admins as $admin) {
        $admin->notify(new ExitRequestCreatedNotification($exitRequest)); // Send notification
    }
        
        return redirect()->route('teacher.exit-requests.index')
            ->with('success', 'تم تقديم طلب الخروج بنجاح');
    }
    public function show($id)
    {
        // Get the authenticated teacher
        $teacher = auth()->guard('teacher')->user();

        // Find the exit request belonging to this teacher
        $exitRequest = $teacher->exitRequests()
            ->with(['room', 'companions'])
            ->findOrFail($id);

        // Get all roommates for companion selection (if needed for edit)
        $colleagues = Teacher::whereHas('room', function ($query) use ($exitRequest) {
            $query->where('rooms.id', $exitRequest->room_id);
        })
            ->where('id', '!=', $teacher->id)
            ->get(['id', 'name']);

        return view('teacher.exit-requests.show', [
            'exitRequest' => $exitRequest,
            'colleagues' => $colleagues,
            'currentCompanions' => $exitRequest->companions->pluck('id')->toArray()
        ]);
    }
    public function complete(Request $request, $id)
{
    $exitRequest = ExitRequest::where('employee_id', auth()->guard('teacher')->id())
                            ->findOrFail($id);

    $request->validate([
        'actual_return_time' => 'required|date',
        'taxi_number' => $exitRequest->transport == 'app' ? 'required|string' : 'nullable',
        'return_notes' => 'nullable|string'
    ]);

    $exitRequest->update([
        'actual_return_time' => $request->actual_return_time,
        'taxi_number' => $request->taxi_number,
        'return_notes' => $request->return_notes,
        'status' => 'completed'
    ]);

    return response()->json(['success' => 'تم تسجيل العودة بنجاح']);
}
}
