<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::with('designation')->get();

        // dd($employees);
        return view ('backEnd.pages.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department_list = Department::departmentLists();
        $designation_list = Designation::designationList();

        return view ('backEnd.pages.employee.create', compact('department_list', 'designation_list'));

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'identity' => 'required',
            'number' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'required | mimes:jpg,jpeg,png,gif',
            'password' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);

        $employee = new User();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->identity = $request->identity;
        $employee->number = $request->number;
        $employee->gender = $request->gender;
        $employee->address = $request->address;
        $employee->password = $request->password;
        $employee->designation_id = $request->designation_id;
        $employee->department_id = $request->department_id;  

        //  for image 
        $destination = 'files/';
        $file = $request->file('image');
        $fileName = fileUpload($file, $destination );

        $employee->image = $fileName;  
        $employee->save();

        return redirect()->to('/admin/employee')->with('success', 'A new employee created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);
        // for relation
        $department_list = Department::departmentLists(); 
        $designation_list = Designation::designationList(); 
        
        return view ('backEnd.pages.employee.edit', compact('employee','department_list', 'designation_list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'identity' => 'required',
            'number' => 'required',
            'address' => 'required',
            // 'image' => 'required | mimes:jpg,jpeg,png,gif',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);

        $employee =User::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->identity = $request->identity;
        $employee->number = $request->number;
        $employee->gender = $request->gender;
        $employee->address = $request->address;
        $employee->designation_id = $request->designation_id;
        $employee->department_id = $request->department_id;  

        //  for image 
        $databaseFile = $employee->image;
        $destination = 'files/';
        $file = $request->file('image');

        $fileName = fileUpdate($databaseFile, $file ,$destination);

        $employee->image = $fileName;  
        $employee->save();


        return redirect()->to('/admin/employee')->with('success', 'A new employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = User::find($id);

        fileDelete($employee->image);
        $employee->delete();

        return redirect()->to('/admin/employee')->with('warning', 'current employee has deleted successfully');
    }
}
