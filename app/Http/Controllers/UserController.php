<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{    
    public function index(Request $request)
    {
        $request->all();

        $users = User::select();

        if ($request['withDeleted'] == 'on') {
            $users = $users->withTrashed();
        }

        if ($request['userName']) {
            $users = $users->where('name', 'like', '%' . $request['userName'] . '%');
        }

        if ($request['userEmail']) {
            $users = $users->where('email', 'like', '%' . $request['userEmail'] . '%');
        }

        if ($request['orderByFieldName']) {
            $users = $users->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }

        $users = $users->paginate(20);

        return view('admin.user.index', compact('users'));
    }

    public function create(int $id = null)
    {
        $user = null;

        if ($id) {
            $user = User::where('id', $id)->first();
        }

        return view('admin.user.form', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1',
            'email' => 'required|email|min:1|max:250|unique:users',
            'password' => 'nullable|string|min:1|max:1000',
            'passwordConfirmation' => 'nullable|string|min:1|max:10000',
        ]);

        $request = $request->only([
            'name',
            'email',
            'password',
        ]);

        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        $user = User::create($request);

        return redirect('admin/user')->with('message', __('user.messages.created_with_success'));
    }

    public function show(int $userId)
    {
        $product = null;

        if ($userId) {
            $user =  User::where('id', $userId)->first();
        }

        return view('admin.user.view', compact('user'));
    }

    public function update(Request $request, int $userId)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1',
            'email' => 'required|email|min:1|max:250',
            'password' => 'nullable|string|min:1|max:1000',
            'passwordConfirmation' => 'nullable|string|min:1|max:10000',
        ]);

        $request = $request->only([
            'name',
            'email',
        ]);

        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        User::where('id', $userId)->update($request);

        return redirect('admin/user')->with('message', __('user.created_with_success'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $userId = $request->post('id');
        User::where('id', $userId)->delete();

        return response()->json(__('user.deleted_with_success'), Response::HTTP_OK);
    }
}
