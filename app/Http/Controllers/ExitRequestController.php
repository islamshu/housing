<?php

namespace App\Http\Controllers;

use App\Models\ExitRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExitRequestController extends Controller
{
    public function index()
    {
        $requests = ExitRequest::with(['teacher', 'room'])
        ->whereHas('room', function($query) {
            $query->where('admin_id', auth()->id());
        })->get();     
           return view('dashboard.exit-requests.index', compact('requests'));
    }

    public function create()
    {
        $teachers = Teacher::has('room')->with(['room' => function ($query) {
            $query->orderBy('employee_room.updated_at', 'desc');
        }])->get();

        return view('dashboard.exit-requests.create', compact('teachers'));
    }
    public function getCompanions($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $currentRoom = $teacher->room()->orderBy('employee_room.updated_at', 'desc')->first();

        if (!$currentRoom) {
            return response()->json([]);
        }

        $companions = Teacher::whereHas('room', function ($query) use ($currentRoom) {
            $query->where('rooms.id', $currentRoom->id);
        })
            ->where('id', '!=', $teacherId)
            ->get(['id', 'name']);

        return response()->json($companions);
    }
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'teacher_id' => 'required|exists:employees,id',
            'type' => 'required|in:daily,overnight',
            'exit_time' => 'required|date',
            'expected_return_time' => 'required|date|after:exit_time',
            'destination' => 'required|string|max:255',
            'transport' => 'required|in:regular,app',
            'has_companion' => 'required|boolean',
            'companions' => 'nullable|array',
            'companions.*' => 'exists:employees,id'
        ]);

        DB::transaction(function () use ($request) {
            // Get current room
            $teacher = Teacher::findOrFail($request->teacher_id);
            $currentRoom = $teacher->room()->latest('employee_room.updated_at')->first();

            // Create exit request
            $exitRequest = ExitRequest::create([
                'employee_id' => $request->teacher_id,
                'room_id' => $currentRoom->id ?? null,
                'type' => $request->type,
                'exit_time' => $request->exit_time,
                'expected_return_time' => $request->expected_return_time,
                'destination' => $request->destination,
                'transport' => $request->transport,
                'has_companion' => $request->has_companion,
                'status' => 'pending',
            ]);

            // Add companions if exists
            if ($request->has_companion && !empty($request->companions)) {
                $exitRequest->companions()->attach($request->companions);
            }
        });

        return redirect()->route('exit-requests.index')
            ->with('success', 'تم إنشاء طلب الخروج بنجاح');
    }

    public function approve($id)
    {
        $exitRequest = ExitRequest::findOrFail($id);
        $exitRequest->update(['status' => 'approved']);
        return back()->with('success', 'تم الموافقة على طلب الخروج');
    }

    public function reject($id)
    {
        $exitRequest = ExitRequest::findOrFail($id);
        $exitRequest->update(['status' => 'rejected']);
        return back()->with('success', 'تم رفض طلب الخروج');
    }

    public function complete(ExitRequest $exitRequest, Request $request)
    {
        $request->validate([
            'actual_return_time' => 'required|date',
            'taxi_number' => 'required_if:transport,app|nullable|string'
        ]);
     
        $exitRequest->update([
            'actual_return_time' => $request->actual_return_time,
            'taxi_number' => $request->taxi_number,
            'status' => 'completed'
        ]);

        return response()->json(['success' => 'تم تسجيل العودة بنجاح']);
    }
}
