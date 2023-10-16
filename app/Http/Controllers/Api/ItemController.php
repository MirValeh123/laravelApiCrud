<?php

namespace App\Http\Controllers\Api;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;



class ItemController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/items",
 *     summary="Get a list of items",
 *     @OA\Parameter(
 *         name="perPage",
 *         in="query",
 *         description="Number of items per page",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ItemResource")
 *         )
 *     )
 * )
 */

    public function index(Request $request)  {
        $perpage=$request->get('perPage',5);
        $items=Item::paginate($perpage);

        return ItemResource::collection($items);
    }
    /**
     * @OA\Get(
     *     path="/api/items/{id}",
     *     summary="Get a specific item by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the item",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ItemResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found"
     *     )
     * )
     */
    public function show($id){
        $item = Item::find($id);
        return ItemResource::make($item);
    }

     /**
     * @OA\Post(
     *     path="/api/items",
     *     summary="Create a new item",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Item created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ItemResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request){
        $data=$request->only('name','qty','price','color','weight');
        $item=Item::create($data);
        return ItemResource::make($item);
    }

     /**
     * @OA\Put(
     *     path="/api/items/{id}",
     *     summary="Update an existing item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the item",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ItemResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request,$id){
        $data=$request->only('name','qty','price','color','weight');
        // dd($data);
        $item=Item::find($id);
        $item->update($data);
        return ItemResource::make($item);
    }


    /**
     * @OA\Delete(
     *     path="/api/items/{id}",
     *     summary="Delete an item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the item",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found"
     *     )
     * )
     */

    public function delete($id){
        // dd($data);
        $item=Item::find($id);
        $item->delete();
        return response()->json(['status'=>'deleted successfully']);
    }

     /**
     * @OA\Put(
     *     path="/api/items/restore/{id}",
     *     summary="Restore a deleted item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the item",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item restored successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ItemResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found in the deleted items"
     *     )
     * )
     */
    public function restore($id){
        $item=Item::withTrashed($id);
        $item->restore();
        return ItemResource::make($item);
    }
}
