<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        DB::enableQueryLog();

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'nickname' => $request->input('nickname'),
        ]);

        if (!$user) {
            return response()->json(['error' => 'User not created'], 400);
        }

        $queryLog = DB::getQueryLog();
        $lastQuery = end($queryLog);

        $unsafeFirstName = $request->input('first_name') . "'; DROP TABLE users; --";
        $unsafeLastName = $request->input('last_name');
        $unsafeEmail = $request->input('email');
        $unsafeNickname = $request->input('nickname');

        $sqlInjection = "INSERT INTO users (first_name, last_name, email, nickname) VALUES ('$unsafeFirstName', '$unsafeLastName', '$unsafeEmail', '$unsafeNickname')";

        return response()->json([
            'message' => 'User created!',
            'executed_query' => $lastQuery,
            'unsafe_sql_injection' => $sqlInjection,
        ], 200);
    }

    public function update(Request $request)
    {
        DB::enableQueryLog();

        $user = User::where('id', $request->input('id'))->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'nickname' => $request->input('nickname'),
        ]);

        if (!$user) {
            return response()->json(['error' => 'User not updated'], 400);
        }

        $queryLog = DB::getQueryLog();
        $lastQuery = end($queryLog);

        $unsafeFirstName = $request->input('first_name') . "'; DROP TABLE users; --";
        $unsafeLastName = $request->input('last_name');
        $unsafeEmail = $request->input('email');
        $unsafeNickname = $request->input('nickname');
        $unsafeId = $request->input('id');

        $sqlInjection = "update \"users\" set \"first_name\" = $unsafeFirstName, \"last_name\" = $unsafeLastName, \"email\" = $unsafeEmail, \"nickname\" = $unsafeNickname where \"id\" = $unsafeId";

        return response()->json([
            'message' => 'User updated!',
            'executed_query' => $lastQuery,
            'unsafe_sql_injection' => $sqlInjection,
        ], 200);
    }

    public function delete(Request $request)
    {
        DB::enableQueryLog();

        $user = User::where('id', $request->input('id'))->delete();

        if (!$user) {
            return response()->json(['error' => 'User not deleted'], 400);
        }

        $queryLog = DB::getQueryLog();
        $lastQuery = end($queryLog);

        $unsafeId = $request->input('id');

        $sqlInjection = "delete from \"users\" where \"id\" = $unsafeId";

        return response()->json([
            'message' => 'User deleted!',
            'executed_query' => $lastQuery,
            'unsafe_sql_injection' => $sqlInjection,
        ], 200);
    }

}
