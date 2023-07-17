<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            "status"    => "success",
            "employees" => $employees,
        ]);
    }

    public function store(Request $request)
    {
        $employee = $request->validate([
            "nik"   => "required|unique:employees",
            "name"   => "required",
            "gender"   => "required|in:male,female",
            "phone"   => "required",
            "address"   => "required",
        ]);

        Employee::create($employee);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
            'employee' => $employee,
        ], 201);
    }

    public function getById($id)
    {
        $employee = Employee::find($id);
        return response()->json([
            'status' => 'success',
            'employee' => $employee,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "nik"   => "required|".Rule::unique(Employee::class)->ignore($id),
            "name"   => "required",
            "gender"   => "required|in:male,female",
            "phone"   => "required",
            "address"   => "required",
        ]);

        Employee::find($id)->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'employee' => $data,
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully',
            'employee' => $employee,
        ]);
    }
}
