<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Role;
use App\Models\User;
use App\Models\Users_role;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UsersRoleController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.user-role.';
        $this->routeName = 'user-role.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::where('type',1)->orderBy("created_at", "Desc")->get();


        return view($this->viewName . 'index', compact(['rows']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$roles=Role::all();

        return view($this->viewName . 'add',compact('roles'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [


            'email' => ['required', 'unique:users'],
            'name' => 'required',
        //   'password' => ['required', 'same:confirm-password'],

        ], [



            'name.required' => 'name_required',

            'email.required' => 'email_required',
            // 'password.required' =>'password_required',

            'email.unique' => 'email.unique',
        //  'password.same' =>'password_same',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withInput()
                ->withErrors($validator->messages());

        }
        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => 1,
                'password' => Hash::make('12345678'),
            ]);

$user->roles()->attach($request->role_id);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName.'index')->with('flash_del', 'Successfully Saved! - Your Password is:12345678 ');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
            // return redirect()->back()->withInput()->withErrors('حدث خطأ فى ادخال البيانات قم بمراجعتها مرة اخرى');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        $userRoles = $user->roles->all();
        $userorders=$user->orders->all();
        $roles=Role::all();
        $rows = OrderDetails::orderBy("created_at", "Desc")->get();
        return view($this->viewName . 'orders', compact(['user','userRoles','roles','rows','userorders']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::where('id',$id)->first();
        $userRoles = $row->roles->all();
        $roles=Role::all();

        return view($this->viewName . 'edit', compact(['row','userRoles','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [


            'email' => 'required|unique:users,email,' . $id,
            'name' => 'required',
            //    'password' => ['required', 'same:confirm-password'],

        ], [


            'name.required' => 'name_required',

            'email.required' => 'email_required',
            // 'password.required' =>'password_required',
            'email.unique' => 'email.unique',
            // 'password.same' =>'password_same',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withInput()
                ->withErrors($validator->messages());

        }
        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            //update user

            $input = [
                'name' => $request->get('name'),
             'email'=>$request->get('email'),
            ];


            $user = User::find($id);

            $user->update($input);
            $user->roles()->sync($request->role_id);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName.'index')->with('flash_del', 'Successfully Saved!');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
            // return redirect()->back()->withInput()->withErrors('حدث خطأ فى ادخال البيانات قم بمراجعتها مرة اخرى');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = User::where('id',$id)->first();


        try {
            $row->roles()->detach();
          $row->delete();

           return redirect()->back()->with('flash_del', 'Successfully Delete!');

       } catch (QueryException $q) {
           // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
           return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
           Because it related with another table');
       }
    }

    public function storeAssign(Request $request){

$user=User::where('id',$request->get('user_id'))->first();
$user->orders()->sync($request->get('checkboxlist'));
// dd($request->get('checkboxlist'));
return redirect()->back()->with('flash_del', 'Successfully Assign!');

    }
}
