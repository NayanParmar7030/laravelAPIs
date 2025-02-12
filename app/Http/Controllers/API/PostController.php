<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::all();

        return response()->json([
            'status' => true,
            'message' => 'Posts fetched successfully',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatePost = Validator::make($request->all(),[
            'title' => 'required',
            'image' => 'required'|'image'|'mimes:jpeg,png,jpg'|'max:2048',
            'description' => 'required'
        ]);

        if($validatePost->fails()){
            return response()->json(
                [
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validatePost->errors()->all()
            ], 401);
        }

        $img = $request->file('image');
        $imgName = time().'.'.$img->extension();
        $img->move(public_path('images'),$imgName);

        $data['post'] = Post::create([
            'title' => $request->title,
            'image' => $imgName,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $data
        ]);
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
