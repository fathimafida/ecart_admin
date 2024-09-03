<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTags(){

        $tags = Tag::all();
        return response()->json($tags);

    }

    public function getTagDetails( $id){

        $tag = Tag::find($id);
        if(!$tag){
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return response()->json($tag);
    }

    public function createTag(Request $request){
        $request->validate([
            "name"=>"required|string|max:255",
        ]);

        $tag = Tag::create([
            "name"=>$request->name
        ]);
        return response()->json($tag);
    }

    public function updateTag(Request $request, $id){

        $request->validate([
            "name"=>"required|string|max:255",
        ]);

        $tag = Tag::find($id);
        $tag->update([
            "name"=>$request->name
        ]);
        return response()->json($tag);
    }
    public function deleteTag($id){
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json($tag);
    }
}
