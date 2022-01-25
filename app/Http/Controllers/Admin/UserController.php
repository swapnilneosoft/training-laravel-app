<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusManage($id)
    {
        $user = User::find($id);
        $user->status = $user->status == 1 ? 0 : 1;
        if ($user->update()) {
            return redirect()->route("user-list")->with("success", "Status has been updated !");
        }
        return redirect()->route("user-list")->with("error", "Unable to update status !");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserRequest $request)
    {
        $user =  User::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "status" => $request->status,
            "role_id" => $request->role_id,

        ]);

        if ($user) {
            return redirect()->route('user-list')->with("success", "User has been added !");
        }
        return redirect()->back()->with("error", "unable to add user please try again !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view("admin.pages.user.edit", ["user" => $user, "roles" => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validate = $request->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required", "email", Rule::unique("users")->ignore($request->id)],
            "status" => ["required"],
            "role_id" => ["required"],
            "id" => ["required"]
        ]);


        if ($validate) {

            $user = User::find($request->id);

            if (!empty($request->password)) {
                if ($request->password != $request->confirm_password) {
                    return back()->with("error", "password and confirm password should be same");
                }
                $user->password = Hash::make($request->password);
            }
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->role_id = $request->role_id;

            if ($user->update()) {
                return redirect()->route("user-list")->with("success", "User has been updated !");
            }

            return redirect()->back()->with("error", "Unable to update user try again");
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
        if (User::find($id)->delete()) {
            return redirect()->route("user-list")->with("success", "User has been deleted !");
        }
        return redirect()->back()->with("error", "Unable to delete user try again");
    }

    public function search($q)
    {
        $users = User::where("firstname", "like", "%$q%")->orWhere("email", "like", "%$q%")->get();


        $list = [];
        foreach ($users as $user) {
            $list[] = [
                "id" => $user->id,
                "firstname" => $user->firstname,
                "lastname" => $user->lastname,
                "email" => $user->email,
                "role" => $user->getRole->name,
                "status" => $user->status,
            ];
        }

        return response()->json($list, 200);
    }
}
