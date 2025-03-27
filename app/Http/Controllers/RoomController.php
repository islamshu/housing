<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Branch;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $Rols = auth()->user()->getRoleNames();
        // dd($Rols);
        $branches = auth()->user()->branch;
        if(auth()->user()->hasRole(['اداري', 'مشرف اداري'])){
            $rooms = Room::orderby('id','desc')->get();
        }else{
            $rooms = Room::where('admin_id', auth()->id())->get();
        }
        $admins = Admin::whereHas('roles', function ($query) {
            $query->whereIn('name', ['اداري', 'مشرف اداري', 'مشرف السكن']);
        })->orderby('id','desc')->get();
        return view('dashboard.rooms.index')->with('admins', $admins)->with('branches', Branch::get())->with('rooms', $rooms);
    }
    public function getAvailableEmployees(Request $request)
    {
        $assignedEmployeeIds = DB::table('employee_room')->pluck('employee_id')->toArray();
        $branchMapping = [
            "6"  => 1,
            "20" => 2,
            "7"  => 5,
            "9"  => 6,
            "11" => 3,
            "10" => 4,
        ];

        // Get the branch_id from the request
        $requestedBranchId = $request->branch_id;

        // Map it (fallback to original if no mapping exists)
        $mappedBranchId = $branchMapping[$requestedBranchId] ?? $requestedBranchId;

        // Query teachers with the mapped branch_id
        $availableEmployees = Teacher::query()
        ->where('is_finish', 0)
            ->whereNotIn('id', $assignedEmployeeIds)
            ->where('branch_id', $mappedBranchId)
            ->get();
        return response()->json($availableEmployees);
    }
    public function addEmployees(Request $request)
    {

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
        ]);

        $room = Room::findOrFail($request->room_id);
        $number = $room->number_employee;
        $current = $room->employess->count();
        $avilabe = $number - $current;

        if ($avilabe < count($request->employee_ids)) {
            return redirect()->back()->with('toastr_error', 'عدد المعلمات المدرج اكبر من اتساع الغرفة');
        }
        $room->employess()->attach($request->employee_ids);

        return redirect()->back()->with('toastr_success', 'تمت إضافة المعلمات بنجاح');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'room_number' => 'required|numeric',
            'number_employee' => 'required|numeric',
            'branch_id' => 'required|integer',
            'admin_id' => 'required|integer'
        ]);
        Room::create($request->all());
        return redirect()->route('rooms.index')->with('toastr_success', 'تم انشاء السكن بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('dashboard.rooms.edit')->with('room', $room)->with('branches', Branch::get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required',
            'room_number' => 'required|numeric',
            'number_employee' => 'required|numeric',
            'branch_id' => 'required|integer'
        ]);
        $room->update($request->all());
        return redirect()->back()->with('toastr_success', 'تم تعديل السكن بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('toastr_success', 'تم حذف السكن بنجاح');
    }
    public function getEmployees(Request $request)
    {
        $room = Room::with('employess')->findOrFail($request->room_id);
        return response()->json(['employess' => $room->employess]);
    }

    public function removeEmployee(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        $room->employess()->detach($request->employee_id);

        return response()->json(['success' => true]);
    }
}
