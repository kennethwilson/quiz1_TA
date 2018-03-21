<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemModel;
use Exception;
class ItemController extends Controller
{
  protected $item;
  public function __construct(ItemModel $item)
  {
    $this->item = $item;
  }
  public function all()
  {
    $items = $this->item->all();
    return response()->json($items,200);
  }
  public function find($id)
  {
    $item = $this->item->find($id);
    return response()->json($item,200);
  }
  public function add_item(Request $request)
  {
    $additem = [
      "user_id"  =>$request->user_id,
      "name"     => $request->name,
      "price"    => $request->price,
      "stock"    => $request->stock
    ];
    try{
      $add= $this->item->create($additem);
      return response('Item Added', 201);
    }
    catch(Exception $ex)
    {
      return response('Failed', 400);
    }
  }
  public function delete($id)
  {
    try{
      $item = $this->item->where('id',$id) ->delete();
      return response('Deleted', 201);
    }
    catch(Exception $ex)
    {
      return response('Failed', 400);
    }
  }
  public function update_item(Request $request,$id)
  {
    try{
      $query = $this->item->where('id',$id)->find($id);

        $query->name =$request->name;
        $query->price=$request->price;
        $query->stock =$request->stock;

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
