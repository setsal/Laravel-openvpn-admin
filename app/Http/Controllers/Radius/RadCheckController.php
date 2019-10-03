<?php

namespace App\Http\Controllers\Radius;

use App\Http\Controllers\Controller;
use App\Radius;
use Illuminate\Http\Request;

class RadCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $radius_users = Radius::where('username', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $radius_users = Radius::paginate($perPage);
        }

        return view('admin.radius.index', compact('radius_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        // $this->validate(
        //     $request,
        //     [
        //         'name' => 'required',
        //         'email' => 'required|string|max:255|email|unique:users',
        //         'password' => 'required'
        //     ]
        // );

        // $data = $request->except('password');
        // $data['password'] = bcrypt($request->password);
        // $user = User::create($data);
        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $radius_users = Radius::findOrFail($id);
        return view('admin.users.show', compact('radius_users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        // $user = User::select('id', 'name', 'email')->findOrFail($id);   
        // return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        // $this->validate(
        //     $request,
        //     [
        //         'name' => 'required',
        //         'email' => 'required|string|max:255|email|unique:users,email,' . $id
        //     ]
        // );

        // $data = $request->except('password');
        // if ($request->has('password')) {
        //     $data['password'] = bcrypt($request->password);
        // }

        // $user = User::findOrFail($id);
        // $user->update($data);
        // return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        // User::destroy($id);

        // return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
