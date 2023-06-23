<?php

namespace App\Http\Controllers;

use App\Models\Employee_details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Mail,mongoDate,Redirect,Response,Session,URL,View,Validator;


class EmployeeController extends Controller
{
    use AuthenticatesUsers;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        
        $data = Employee_details::where('is_deleted', 0)
        ->latest()
        ->select('employee_detail.*')
        ->paginate(5);
        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    public function create()
    {
        $DB	=	Employee_details::query();
		$emp_managerid=	$DB->select("employee_detail.*")->where('emp_role_type',1);		
		$emp_manager = $emp_managerid->pluck('emp_name','id');        
        return view('create',compact('emp_manager'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'emp_name'          =>  'required',
            'emp_mob'         =>  'required|min:10|unique:employee_detail',
            'emp_email'         =>  'required|email|unique:employee_detail',
            'emp_profile'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        $file_name = time() . '.' . request()->emp_profile->getClientOriginalExtension();

        request()->emp_profile->move(public_path('images'), $file_name);
        $user= new User;
        $password =Hash::make(12345678);
        $user->name = $request->emp_name;
        $user->email = $request->emp_email;
        $user->password = $password;
        $user->type = $request->emp_role_type;
        $user->save();
        $userid = $user->id;

        $emp = new Employee_details;
        $emp->emp_name = $request->emp_name;
        $emp->emp_email = $request->emp_email;
        $emp->emp_mob = $request->emp_mob;
        $emp->emp_gender = $request->emp_gender;
        $emp->emp_profile = $file_name;
        $emp->emp_basic_pay = $request->emp_basic_pay;
        $emp->userid = $userid;
        $emp->emp_role_type = $request->emp_role_type;
        if($request->emp_role != "")
        {
            $emp->emp_role = $request->emp_role;
        }else{
            $emp->emp_role = 0;
        }        
        $emp->is_deleted =0;
        $emp->emp_address = $request->emp_address;
        $emp->save(); 
        return redirect()->route('employee.index')->with('success', 'Employee Added successfully.');
    }

    
    public function edit($modelId = 0)
    {
        $DB	=	Employee_details::query();
		$emp_managerid=	$DB->select("employee_detail.*")->where('emp_role_type',1);		
		$emp_manager = $emp_managerid->pluck('emp_name','id');  
        //$emp				=	Employee_details::find($modelId);
        $emp = Employee_details::leftJoin('users', 'employee_detail.userid', '=', 'users.id')
        ->where('employee_detail.id', $modelId)
        ->select('employee_detail.*', 'users.id')
        ->first();
		if(empty($emp)) {
			return Redirect::route($this->sectionName.".index");
		}
        return view('edit', compact('emp','emp_manager'));
    }

  
    public function update($modelId = 0,Request $request)
    {

        $model							=	Employee_details::find($modelId);        
        $file_name = $request->hidden_student_image;
        if($request->emp_profile != '')
        {
            $file_name = time() . '.' . request()->emp_profile->getClientOriginalExtension();
            request()->emp_profile->move(public_path('images'), $file_name);
        }
        $user = User::find($request->userid);
        $user->name = $request->emp_name;
        $user->email = $request->emp_email;        
        $user->type = $request->emp_role_type;
        $user->save();

        $emp = Employee_details::find($request->hidden_id);
        $emp->emp_name = $request->emp_name;
        $emp->emp_email = $request->emp_email;
        $emp->emp_mob = $request->emp_mob;
        $emp->emp_gender = $request->emp_gender;
        $emp->emp_profile = $file_name;
        $emp->emp_basic_pay = $request->emp_basic_pay;
        $emp->emp_role_type = $request->emp_role_type;
        if($request->emp_role != "")
        {
            $emp->emp_role = $request->emp_role;
        }else{
            $emp->emp_role = 0;
        }
        $emp->is_deleted =0;
        $emp->emp_address = $request->emp_address;
        $emp->save();
        return redirect()->route('employee.index')->with('success', 'Employee Data has been updated successfully');
    }

  
    public function destroy($reviewId = 0)
    {
        $reviewDetails	=	Employee_details::find($reviewId);		
		if(empty($reviewDetails)) {
            return redirect()->route('employee.index');
		}
		if($reviewId){	
			Employee_details::where('id',$reviewId)->update(array('is_deleted'=>1));
            return redirect()->route('employee.index')->with('success', 'Student Data deleted successfully');

		}

    }

    public function login(Request $request)
    {
        
        $input = $request->all();
     
        $this->validate($request, [
            'user_name' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt(array('email' => $input['user_name'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == '0') {
                return Redirect::to('developerlist');

            }else{
                return Redirect::to('managerlist');
            }
        }else{
            return Redirect::back()->with('failed', 'Username or Password is Wrong!');


        }
          
    }

    public function managerlist()
    {
        $data = Employee_details::where('is_deleted', 0)
        ->where('emp_role', Auth::user()->name)
        ->latest()
        ->select('employee_detail.*')
        ->paginate(5);
        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    public function developerlist()
    {
       $data = Employee_details::where('is_deleted', 0)
    ->where('emp_name', Auth::user()->name)
    ->latest()
    ->select('employee_detail.*')
    ->paginate(5);
        return view('developerdash', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function logout1()
    {
        Auth::logout();
    
        // Redirect the user to the desired location after logout
        return redirect('/');
    }
}
