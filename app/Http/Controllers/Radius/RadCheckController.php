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
                ->paginate($perPage);
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
        return view('admin.radius.create');
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
        if ( $request->attirbute = 'Auth-Type' ) {
            $this->validate(
                $request,
                [
                    'username' => 'required|string|unique:radius_mysql.radcheck',
                    'attribute' => 'required|string|max:50|in:Crypt-Password,Cleartext-Password,Auth-Type'
                ]
            );
        }
        else {
            $this->validate(
                $request,
                [
                    'username' => 'required|string|unique:radius_mysql.radcheck',
                    'attribute' => 'required|string|max:50|in:Crypt-Password,Cleartext-Password,Auth-Type',
                    'value' => 'string|max:50'
                ]
            );
        }
    

        $data = $request->except('value');
        switch($request->attribute){
            case 'Cleartext-Password':
                $data['value'] = $request->value;
                break;
            case 'Crypt-Password':
                $data['value'] = crypt($request->value, '$1$'.uniqid());
                break;
            case 'Auth-Type':
                $data['value'] = 'Reject';
                break;
            default:
                return redirect('admin/radius/users')->with('flash_message', 'Something Wrong !');
        }       

        $data['op'] = ':=';
        $radius_user = Radius::create($data);

        return redirect('admin/radius/users')->with('flash_message', 'User added !');
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
        return view('welcome');
        // $radius_users = Radius::findOrFail($id);
        // return view('admin.radius.show', compact('radius_users'));
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
        $radius_user = Radius::select('id', 'username', 'attribute', 'value')->findOrFail($id);   
        return view('admin.radius.edit', compact('radius_user'));
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
        if ( $request->attirbute = 'Auth-Type' ) {
            $this->validate(
                $request,
                [
                    'username' => 'required|string|max:20',
                    'attribute' => 'required|string|in:Crypt-Password,Cleartext-Password,Auth-Type'
                ]
            );
        }
        else {
            $this->validate(
                $request,
                [
                    'username' => 'required|string|max:20',
                    'attribute' => 'required|string|in:Crypt-Password,Cleartext-Password,Auth-Type',
                    'value' => 'string|max:50'
                ]
            );
        }

        $data = $request->except('value');
        switch($request->attribute){
            case 'Cleartext-Password':
                $data['value'] = $request->value;
                break;
            case 'Crypt-Password':
                $data['value'] = crypt($request->value, '$1$'.uniqid());
                break;
            case 'Auth-Type':
                $data['value'] = 'Reject';
                break;
            default:
                return redirect('admin/radius/users')->with('flash_message', 'Something Wrong !');
        }       

        $data['op'] = ':=';

        $radius_user = Radius::findOrFail($id);
        $radius_user->update($data);
        return redirect('admin/radius/users')->with('flash_message', 'Radius User updated !');
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
        Radius::destroy($id);
        return redirect('admin/radius/users')->with('flash_message', 'User deleted !');
    }
}
