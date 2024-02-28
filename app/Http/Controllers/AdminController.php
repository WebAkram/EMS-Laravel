<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
      public function dashboard()
      {
        $empcount = Employee::select()->count();
        $departmentcount = Department::select()->count();
        $adminRole = User::where('role', 'admin')->count();
        $employeeRole = User::where('role', 'user')->count();

        return view('admin.index',compact('empcount','departmentcount','adminRole','employeeRole'));
      }


      public function department()
      {
        $department = Department::select()->latest()->paginate(6);
        return view('admin.department', compact('department'));
      }
        // Pagination department
      public function paginationdepartment(Request $request)
      {
        $department = Department::select()->latest()->paginate(6);

          return view('admin.paginationdepartment', compact('department'))->render();
      }
        //   add department
      public function addDepartment(Request $request)
      {
            Department::create([
             'department_name' => $request->departmentname,
         ]);
      }
      // Delete department
      public function departmentDelete($id){
        Department::find($id)->delete();
    }


    public function departmentUpdate(Request $request)
    {
      $id = $request->input('up_id');
      $update = Department::find($id);
      $update->department_name = $request->input('up_name');
      $update->save();
     }


      public function employeeadmin()
       {
        $employee = Employee::select()->latest()->paginate(4);
        $department = Department::all();

          return view('admin.employee', compact('employee','department'));
       }

        // Delete employee
      public function employeeDelete($id){
        Employee::find($id)->delete();
    }

      // Pagination department
      public function paginationemployee(Request $request)
      {
        $employee = Employee::select()->latest()->paginate(4);
        $department = Department::all();
          return view('admin.paginationemployee', compact('department','employee'))->render();
      }
      public function empUpdate(Request $request)
      {
          $id = $request->input('up_id');
          $update = Employee::find($id);
          // Update fields using the data from the request
          $update->name = $request->input('up_name');
          $update->email = $request->input('up_email');
          $update->phone = $request->input('up_phone');
          $update->address = $request->input('up_address');
          $update->department = $request->input('up_department');
          $update->status = $request->input('up_status');
          $update->jobrole = $request->input('up_jobrole');
          $update->cnic = $request->input('up_cnic');
          $update->dateofbirth = $request->input('up_dob');
          $update->dateofissue = $request->input('up_doi');
          $update->dateofexpiry = $request->input('up_doe');

          // If the user uploaded a new image, delete the old image
          if ($request->hasFile('up_docu')) {
              $oldImagePath = public_path('assets/documents/' . $update->document);
              if (file_exists($oldImagePath)) {
                  unlink($oldImagePath);
              }
              $image = $request->file('up_docu');
              $imagename = time() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('assets/documents/'), $imagename);
              $update->document = $imagename;
          }
          $update->save();
      }













}
