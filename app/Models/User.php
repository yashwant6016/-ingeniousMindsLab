<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function experience(){
        return $this->hasMany(Experience::class,'user_id');
    }
    
    public function education(){
        return $this->belongsTo(Education::class,'id');
    }
    public function validation_rules($request)
    {
            return Validator::make($request->all(), [
                'name'     => 'required|max:30',
                'email' => 'required|email|max:255|unique:users',
                'phone'    => 'required|numeric',
                'gender'    => 'required',
                'education'    => 'required',
                'hobby'    => 'required',
                'experience'    => 'required',
                'picture'    => 'required',
                'message'    => 'required',
            ]);
    }
    public function insert_records($request){
        try{
               $validator=User::validation_rules($request);
               if($validator->fails())
               {
                   return array('status'=>false,'validator_error'=>$validator);
               }   
               if ($request->hasFile('picture')) {
                    $image=$request->file('picture')->store('public/demo');
                }
                // dd($request->hobby);
               $hobby=implode(',' , $request->hobby);
               $user=new User();
               $user->name=$request->name;
               $user->email=$request->email;
               $user->gender=$request->gender;
               $user->phone=$request->phone;
               $user->education=$request->education;
               $user->hobby=$hobby;
               $user->image=$image;
               $user->message=$request->message;
               $user->save();
               foreach($request->experience as $experience){
                $exp=new Experience();
                $exp->user_id=$user->id;
                $exp->experience=$experience;
                $exp->save();
               }
               return array('status'=>true,'success'=>$user);
           }catch (\Exception $e) {
               return array('status'=>false,'error'=>$e->getMessage());
           }  
    }

    public function update_records($request)
    {
        try{
            $validator=User::validation_rules($request);
            if($validator->fails())
            {
                return array('status'=>false,'validator_error'=>$validator);
            }
              
            if ($request->hasFile('picture')) {
                $image=$request->file('picture')->store('public/demo');
            }
            $hobby=implode($request->hobby);
            $updateUser=User::find($request->id);
            if(!empty($updateUser))
            {
                $updateUser->name=$request->name;
                $updateUser->email=$request->email;
                $updateUser->gender=$request->gender;
                $updateUser->education=$request->education;
                $updateUser->hobby=$hobby;
                $updateUser->image=$image;
                $updateUser->message=$request->message;
                $updateUser->save();
                return array('status'=>true,'success'=>'updated');
            }
        }
        catch (\Exception $e) {
            return array('status'=>false,'error'=>$e->getMessage());
        }
    }

    public function getdata($request){
        // dd($request->all());
        if(isset($request->id) && !empty($request->id))
       {
          return User::with('experience')->with('education')->where('id',$request->id)->get()->first();
       }else{
        $User = User::with('experience')->with('education');
            if(!empty($request->search['value']))
            {
                $search=$request->search['value'];
                $User->where('name', 'like', '%'.$search.'%')->orwhere('email', 'like', '%'.$search.'%');
            }
            $totalRecord=$User->count();
            if(!empty($request->length))
            {
                $User=$User->skip($request->start)->take($request->length);
            }
            $User=$User->get();
            return array('user'=>$User,'totalRecord'=>$totalRecord);
       }
    }
    public function deleteUser($id){
        if(!empty($id)){
        $user=User::find($id)->delete();
            return array('status'=>true, 'User'=>$user, 'Success'=>'User Deleted Successfully');
        }
        return array('status'=>false,'error'=>"Something Went Wrong");
    }
}
