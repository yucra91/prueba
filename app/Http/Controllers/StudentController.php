<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResouce;
use App\Models\Persona;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // public function index()
    // {
      
    //     return response()->json([
    //         'ok'=>true,
    //         'Student'=> Student::with('users','personas')->get()
    //     ]);
    // }

    public function index(Request $request)
    {
        if($request->name){

            $name_person= Student::from('students as s')
            ->join('personas as p','p.id','s.persona_id')
            ->where('p.first_name','like',"%".$request->name."%")
            ->select('s.*')
            ->with('users','personas')->get();
            
            return response()->json([
                'ok'=>true,
                'Student'=> $name_person
            ]);
        }

        return response()->json([
            'ok'=>true,
            'Student'=> Student::with('users','personas')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'ci'=>'required',
            'cellphone'=>'required',
        ]);
       $per = new Persona();
       $per->first_name =   $request->first_name;
       $per->last_name  =   $request->last_name;
       $per->ci  =   $request->ci;
       $per->cellphone  =   $request->cellphone;
        $per->save();

        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
        
        $user =new User();
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remenber_token =$token;
        $user->assignRole('student');

        $student = new Student();
        $student->user_id = $user->id;
        $student->persona_id = $per->id;  
        $student->colegio_id = $request->colegio_id;  
        $student->save();

        return response()->json([
            'ok'=>true,
            'msg'=>'Registrado correctamente',
            'access_token'=>$token,
            'studen'=>$student
        ],200);
    }

    
    
    public function show(Student $student)
    {
        return new StudentResouce( Student::with('users','personas')
        ->where('id',$student->id)->get());
    }
    // public function update(Request $request,  Student $student)
    // {
     
    //     $request->validate([
    //         'first_name'=>'required',
    //         'last_name'=>'required',
    //         'ci'=>'required',
    //         'cellphone'=>'required',
      
    //     ]);

    //     $students = Student::findOrFail($student->id)
    //                     ->personas()
    //                     ->where('id',$student->persona_id)->first();

    //     $students = Student::findOrFail($student->id)            
    //                     ->users()
    //                     ->where('id',$student->user_id)->first();
    //     $students->update($request->all());
    //     return new StudentResouce($students);

    // }

    public function update($id,Request $student)
    {   
   
        $students_person = Student::findOrFail($id)
                        ->personas()->get()->first();
        $update_persona = Persona::findOrFail($students_person->id);
        $update_persona->first_name = $student->first_name;
        $update_persona->last_name = $student->last_name;
        $update_persona->ci = $student->ci;
        $update_persona->cellphone = $student->cellphone;
        $update_persona->save();
        

        $students_user = Student::findOrFail($id)                     
                        ->users()->get()->first();
        $update_user = User::findOrFail($students_user->id);

        $update_user->email = $student->email;

        if($student->password!=null){           
            $update_user->password = bcrypt($student->password);
           $update_user->save();

            return $update_user;
        }
        $update_user->save();
        
    }


    public function destroy(Student $student)
    {
        $student ->delete();
        return new StudentResouce($student);
    }
}
