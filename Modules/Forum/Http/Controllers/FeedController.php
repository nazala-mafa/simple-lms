<?php

namespace Modules\Forum\Http\Controllers;

use App\Models\Dislike;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Forum\Entities\Feed;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $skip = ($request->limit ?? 0) * $request->page ?? 0;
        $feeds = Feed::orderBy('created_at', 'desc')->skip($skip)->take($request->limit)->get()->map(fn($feed) => [
            'id' => $feed->id,
            'caption' => $feed->caption,
            'created_at' => $feed->created_at,
            'updated_at' => $feed->updated_at,
            'author' => $feed->author,
            'images' => $feed->images->map(fn($image) => [
                'uri' => $image->uri
            ]),
            'liked' => $feed->likes()->where('user_id', auth()->id())->exists(),
            'likes_count' => $feed->likes()->count(),
            'disliked' => $feed->dislikes()->where('user_id', auth()->id())->exists(),
            'dislikes_count' => $feed->dislikes()->count(),
            'comments_count' => $feed->comments()->count(),
        ]);

        return response()->json([
            'data' => $feeds
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
        ]);

        $image = $request->file('image');
        $dir = public_path('uploads');
        $newName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($dir, $newName);

        $feed = new Feed();
        $feed->user_id = auth()->id();
        $feed->school_id = auth()->user()->school_id;
        $feed->caption = $request->caption;
        $feed->save();

        $feed->images()->create([
            'user_id' => auth()->id(),
            'uri' => url("/uploads/$newName"),
            'path' => $dir . '.' . $newName
        ]);

        return response()->json([
            'message' => "Your Feed added successfully."
        ], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Feed $feed)
    {
        $data = [
            'id' => $feed->id,
            'caption' => $feed->caption,
            'created_at' => $feed->created_at,
            'updated_at' => $feed->updated_at,
            'author' => $feed->author,
            'images' => $feed->images->map(fn($image) => [
                'uri' => $image->uri
            ]),
            'comments' => $feed->comments->map(fn($comment) => [
                'id' => $comment->id,
                'author_name' => $comment->author->name,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at,
            ])
        ];

        return response()->json([
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Feed $feed)
    {
        $feed->delete();

        return response()->json([
            'message' => "Your feed deleted successfully."
        ], 200);
    }

    public function like($feed_id)
    {
        $feed = Feed::findOrFail($feed_id);

        if (!$feed->likes()->where('user_id', auth()->id())->exists()) {
            $feed->dislikes()->where('user_id', auth()->id())->get()->map(fn($feed) => $feed->delete());

            $feed->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return response()->json([
            'message' => "liked $feed->caption successfully",
        ], 200);
    }

    public function dislike($feed_id)
    {
        $feed = Feed::findOrFail($feed_id);

        if (!$feed->dislikes()->where('user_id', auth()->id())->exists()) {
            $feed->likes()->where('user_id', auth()->id())->get()->map(fn($feed) => $feed->delete());

            $feed->dislikes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return response()->json([
            'message' => "disliked $feed->caption successfully",
        ], 200);
    }

    public function store_comment($feed_id)
    {
        $feed = Feed::findOrFail($feed_id);

        $feed->comments()->create([
            'user_id' => auth()->id(),
            'comment' => request()->comment
        ]);

        return response()->json([
            'message' => "comment $feed->caption successfully",
        ], 200);
    }
}