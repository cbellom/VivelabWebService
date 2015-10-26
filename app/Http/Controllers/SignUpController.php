<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\UserSignUp;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserSignUp::all();
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }

        $rules = [
            'name'       => 'required',
            'lastname'   => 'required',
            'email'      => 'required|email',
            'phone'      => 'required',
            'post_id'    => 'required|numeric',
            'post_name'  => 'required'
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            $email = $request->input('email');
            $post = $request->input('post_id');
            if($this->hasBeentheUserRegistredFor($email , $post)){
              return [
                  'created' => false,
                  'errors'  => 'El correo '.$request->input('email').' ya ha sido registrado.'
              ];
            }
            $user = UserSignUp::create($request->all());
            return ['created' => true,
                    'data'=> $user
                   ];
        } catch (Exception $e) {
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }

    }

    function hasBeentheUserRegistredFor($email, $post){
      $userRegistrations = UserSignUp::where('email','=',$email)->get();
      foreach ($userRegistrations as $user){
        if($user->post_id == $post){
          return true;
        }
      }
      return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
