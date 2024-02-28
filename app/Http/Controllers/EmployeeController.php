<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Employee;
use App\Models\Department;


class EmployeeController extends Controller
{
    public function employee()
    {
        $employee = Employee::latest('id')
        ->where('user_id', Auth::user()->id)
        ->paginate(3);
        $department = Department::all();
      return view('employee.indexemployee', compact('department','employee'));
    }
        // Pagination employee
        public function paginationemp(Request $request)
        {
            $employee = Employee::latest('id')
            ->where('user_id', Auth::user()->id)
            ->paginate(3);
          $department = Department::all();
            return view('employee.paginationemp', compact('employee','department'))->render();
        }


    public function addemployee(Request $request)
{
    $docum = time() . '.' . $request->document->getClientOriginalExtension();
    $request->document->move('assets/documents/', $docum);
    Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->Address,
        'department' => $request->department,
        'jobrole' => $request->Jobrole,
        'cnic' => $request->Cnic,
        'dateofbirth' => $request->Dateofbirth,
        'dateofissue' => $request->DateofIssue,
        'dateofexpiry' => $request->DateofExpiry,
        'document' => $docum,
        'user_id' => Auth::user()->id,
    ]);
}

        public function deleteEmployee($id){
        Employee::find($id)->delete();
        }
        public function employeeUpdate(Request $request)
        {
            $id = $request->input('up_id');
            $update = Employee::find($id);
            // Update fields using the data from the request
            $update->name = $request->input('up_name');
            $update->email = $request->input('up_email');
            $update->phone = $request->input('up_phone');
            $update->address = $request->input('up_address');
            $update->department = $request->input('up_department');
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
