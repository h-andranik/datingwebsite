<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id        = Auth::user()->id;
        $user      = User::where('id', $id)->with('interests')->first();
        $interests = Interest::all();
        $arr       = Config::get('constants.astrology');

        for ($i = 0; $i <= count($arr); $i++) {
            if (isset($user->astrology)) {

                if ($arr[$i] == $user->astrology) {
                    unset($arr[$i]);
                }
            }
        }

        return view('settings', compact([
            'user',
            'interests',
            'arr'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *Undefined offset:
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request)
    {
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $user = Auth::user();
            $name = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);

            $user->update([
                'image' => $name,
            ]);
        };


        $user = Auth::user();

        $user->update([
            'state'     => $request->state,
            'city'      => $request->city,
            'country'   => $request->country,
            'age'       => $request->age,
            'gender'    => $request->gender,
            'birthday'  => $request->birthday,
            'astrology' => $request->astrology,
            'about'     => $request->about,
        ]);
        $user->interests()->sync($request->interest_id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchResults(Request $request)
    {
        if (empty($request->search)
            && empty($request->interest_id)
            && empty($request->min_age)
            && empty($request->max_age)
            && empty($request->astrology)) {

            return view('search');

        }

        $usersAstrology = [];
        if (!empty($request->astrology)) {
            $usersAstrology['astrology'] = $request->astrology;
        }

        $interest_id = $request->interest_id;

        if (!empty($interest_id)) {
            $users = User::whereHas('interests', function ($query) use ($interest_id) {
                $query->where('interest_id', 'LIKE', $interest_id . "%");

            })->where('name', 'LIKE', $request->search . "%")
                ->whereBetween('age', [$request->min_age, $request->max_age])
                ->where($usersAstrology)->get();
        } else {
            $users = User::where('name', 'LIKE', $request->search . "%")
                ->whereBetween('age', [$request->min_age, $request->max_age])
                ->where($usersAstrology)->get();
        }

        return view('search', compact([
            'users'
        ]));

    }

}
