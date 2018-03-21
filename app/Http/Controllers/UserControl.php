<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use Exception;
class UserControl extends Controller
{
  protected $user;
  public function __construct(UserModel $user)
  {
    $this->user = $user;
  }
    public function register(Request $request)
    {
      $user = [
        "name"     => $request->name,
        "email"    => $request->email,
        "password" => md5($request->password)
      ];
      try{
        $add= $this->user->create($user);
        return response('Created', 201);
      }
      catch(Exception $ex)
      {
        return response('Failed', 400);
      }
    }
    public function all()
    {
      $users = $this->user->all();
      return response()->json($users,200);
    }

    public function find($user_id)
    {
      $user = $this->user->find($user_id);
      return response()->json($user,200);
    }
    public function delete($id)
    {
      try{
        $user = $this->user->where('id',$id) ->delete();
        return response('Deleted', 201);
      }
      catch(Exception $ex)
      {
        return response('Failed', 400);
      }
    }
    public function list_all_users_item()
    {
        $user  = $this->user->with('myItems')->get();
        return response()->json($user,200);
    }
    public function list_users_item($id)
    {
        $user  = $this->user->with('myItems')->where('id',$id)->get();
        return response()->json($user,200);
    }
    public function updaterecord(Request $request,$id)
    {
      try{
        $query = $this->user->where('id',$id)->find($id);
        if($request->pass == $query->pass)
        {
          $query->name =$request->name;
          $query->email=$request->email;
          $query->password =$request->pass;
        }
        else {
          $query->name =$request->name;
          $query->email=$request->email;
          $query->password = md5($request->pass);
        }
        try{
          $update =  $query->save();
          return response("Updated",201);
        }
        catch(Exception $ex)
        {
          return $ex;
          return response("Failed",400);
        }
      }
      catch(Exception $ex)
      {
        return response("Not found",400);
      }
  }
}
