<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $id_user = $request->query('id_user');

        $query = Album::leftJoin('users', 'tbl_album.id_user', '=', 'users.id');

        if ($id_user) {
            $query->where('tbl_album.id_user', $id_user);
        }

        $album = $query->latest()
        ->select('tbl_album.*', 'users.id')
        ->get();

        return response()->json($album, 200);
    }
    public function show(string $id)
    {
        $album = Album::where('id_album',$id)->first();

        if (!$album) {
            return response()->json([
                'message' => "Album Not Found"
            ], 404);
        }

        return response()->json($album ,200);
    }
}
