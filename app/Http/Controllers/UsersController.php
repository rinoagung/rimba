<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json([
            'success' => true,
            'message' => 'List Semua User',
            'data'    => $user,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'age'   => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak valid!',
                'data'   => $validator->errors(),
                'status' => 401
            ], 401);
        } else {
            $dataUser = [
                'name'     => $request->input('name'),
                'email'   => $request->input('email'),
                'age'   => $request->input('age'),
            ];
            if ($request->has('id')) {
                $dataUser['id'] = $request->input('id');
            }

            $user = User::create($dataUser);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Disimpan!',
                    'data' => $user,
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Disimpan!',
                    'status' => 400
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail User!',
                'data'      => $user,
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
                'status' => 404
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'age'   => 'required|integer',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid!',
                'data'   => $validator->errors(),
                'status' => 401
            ], 401);
        } else {

            $user = User::whereId($id)->update([
                'name'     => $request->input('name'),
                'email'   => $request->input('email'),
                'age'   => $request->input('age'),
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Diupdate!',
                    'data' => User::find($id),
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Diupdate!',
                    'status' => 400
                ], 400);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        $user?->delete();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Berhasil Dihapus!',
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Gagal Dihapus!',
                'status' => 400
            ], 400);
        }
    }
}
