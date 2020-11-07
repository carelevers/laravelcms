<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Resources\contentResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helper\Helper;

class ContentController extends Controller
{

    public function index(Content $content)
    {

        return ContentResource::collection(Content::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return contentResource
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'template' => 'required',
            'friendlyurl' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $content = new Content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/content');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $content->image = $name;
        }

        $content->user_id = $request->user_id;
        $content->title = $request->title;
        $content->body = $request->body;
        $content->template = $request->template;
        $content->status = $request->status;
        $content->friendlyurl = $request->friendlyurl;
        $content->save();

        return new ContentResource($content);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return ContentResource
     */
    public function show(Content $content)
    {
        return new ContentResource($content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return contentResource
     */
    public function update(Request $request, Content $content)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/content');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $content->image = $name;
        }

        $content->title = $request->title;
        $content->body = $request->body;
        $content->template = $request->template;
        $content->status = $request->status;
        $content->friendlyurl = $request->friendlyurl;

        $content->update(['image' => $content->image,"title"=>$content->title,"body"=>$content->body,'template'=>$content->template,'status'=>$content->status,'friendlyurl'=>$content->friendlyurl]);

        return new ContentResource($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return response()->json(null, 204);
    }

    public function all()
    {

        return view('landing', [
            'contents' => Content::latest()->paginate(5)
        ]);
    }

    public function single(Content $content)
    {
        return view('pageSingle', compact('content'));
    }
    public function landing(Content $content){
        return view('landing', [
            'heading' => Content::where('id', "1")->first(),
            'contentOne' => Content::where('id', "2")->first(),
            'contentTwo' => Content::where('id', "3")->first(),
            'posts' => Post::latest()->paginate(5)
        ]);
    }
}
