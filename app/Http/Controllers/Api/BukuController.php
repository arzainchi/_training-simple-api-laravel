<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use App\Models\Buku;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('id', 'DESC')->get();
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                "status" => 422,
                "message" => $request->validator->errors(),
                "data" => null,
            ], 422);
        }

        $payload = [
            "judul" => $request->judul,
            "pengarang" => $request->pengarang,
            "tahun" => $request->tahun,
        ];
        $data = Buku::create($payload);
        return response()->json([
            "status" => 201,
            "message" => "Success",
            "data" => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);

        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
                "data" => $data,
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
        $data = Buku::find($id);

        if (empty($data)) {
            return response()->json([
                "status" => 404,
                "message" => "Not Found",
                "data" => $data,
            ], 404);
        }
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                "status" => 422,
                "message" => $request->validator->errors(),
                "data" => null,
            ], 422);
        }

        $payload = [
            "judul" => $request->judul,
            "pengarang" => $request->pengarang,
            "tahun" => $request->tahun,
        ];
        $data = Buku::where('id', "=", $id)->update($payload);
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
        $data = Buku::find($id);

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
