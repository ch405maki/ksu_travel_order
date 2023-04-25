<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::select('employees.id','employees.name','email','phone',
        'department_id', 'role_id', 'position_id', 'departments.name as department', 'roles.name as role', 'positions.name as position')
        ->join('departments','departments.id','=','employees.department_id')
        ->join('roles', 'roles.id', '=', 'employees.role_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->paginate(10);

        $departments = Department::all();
        $role = Role::all();
        $position = Position::all();

        return Inertia::render('Employees/Index',['employees' => $employees,
        'departments' => $departments, 'role' => $role, 'position'=> $position]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|max:80',
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric',
            'role_id' => 'required|numeric',
            'position_id' => 'required|numeric'
        ]);
        $employee = new Employee($request->input());
        $employee->save();
        return redirect('employees');
    }
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|max:80',
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric'
        ]);
        $employee->update($request->input());
        return redirect('employees');
    }

    //Added 
    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit',['employee' => $employee]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('employees');
    }
    public function EmployeeByDepartment(){
        $data = Employee::select(DB::raw('count(employees.id) as count, departments.name'))
        ->join('departments','departments.id','=','employees.department_id')
        ->groupBy('departments.name')->get();
        return Inertia::render('Employees/Graphic',['data' => $data]);
    }
    public function reports(){
        $employees = Employee::select('employees.id','employees.name','email','phone',
        'department_id','departments.name as department')
        ->join('departments','departments.id','=','employees.department_id')
        ->get();

        $departments = Department::all();

        return Inertia::render('Employees/Reports',['employees' => $employees,
        'departments' => $departments]);
    }
}
