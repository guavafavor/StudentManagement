<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq)
    {
        $page = $rq->page ?? 1;
        $limit = $rq->limit ?? 8;
        $users = User::orderBy('created_at', 'asc')->skip(($page-1)*$limit)->take($limit)->get();

        return ['objects' => $users];
    }

    public function getPageNum(Request $rq) {
        $limit = $rq->limit ?? 8;
        
        return ['pageNum' => ceil(User::count()/$limit)];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::insert([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'email' => $request->email,
            'role_id' => $request->role,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['msg' => 'Thêm người dùng mới thành công'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['user' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {}
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)
            ->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'email' => $request->email,
                'role_id' => $request->role,
                'phone' => $request->phone,
                'active' => $request->active ?? 0
            ]);

        return response()->json(['msg' => 'Cập nhật người dùng thành công'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return response()->json(['msg' => 'Xóa người dùng thành công'], 200);
    }
}