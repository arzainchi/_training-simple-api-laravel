<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengarangRequest;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengarang::orderBy('id', 'DESC')->get();

        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
                "data" => null,
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PengarangRequest $request)
    {
        if (isset($request->validator) && ($request->validator->fails())) {
            return response()->json([
                "status" => 422,
                "message" => $request->validator->errors(),
            ], 422);
        }

        $payload = [
            "nama" => $request->nama,
            "jenis_kelamin" => $request->jenis_kelamin,
            "tanggal" => $request->tanggal,
            "alamat" => $request->alamat,
        ];
        $data = Pengarang::create($payload);
        return response()->json([
            "status"    => 201,
            "message"   => "Success",
            "data"      => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pengarang::find($id);
        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Pengarang::find($id);
        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
            ], 404);
        }
        if (isset($request->validator) && ($request->validator->fails())) {
            return response()->json([
                "status" => 422,
                "message" => $request->validator->errors(),
            ], 422);
        }

        $data->nama = $request->nama;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->alamat = $request->alamat;
        $data->save();

        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pengarang::find($id);

        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
                "data" => $data,
            ], 404);
        }

        $data->delete();
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => null,
        ], 200);
    }
}
