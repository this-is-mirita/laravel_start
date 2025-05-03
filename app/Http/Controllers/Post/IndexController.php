<?php

namespace App\Http\Controllers\Post;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        // TODO: Implement __invoke() method.
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);


        //return PostResource::collection($posts);
        return view('post.index', compact('posts'));
    }
}
//        $query = Post::query();
//        //        //// http://127.0.0.1:8000/posts?title=
////        if(isset($data['category_id'])) {
////            $query->where('category_id', $data['category_id']);
////        }
////        // http://127.0.0.1:8000/posts?title=...
////        if(isset($data['title'])) {
////            $query->where('title', 'like', "%{$data['title']}%");
////        }
////        // http://127.0.0.1:8000/posts?content=...
////        if(isset($data['content'])) {
////            $query->where('content', 'like', "%{$data['content']}%");
////        }
//        $posts = $query->get();
//dd($posts);
// TODO: Implement __invoke() method.
//        $posts = Post::paginate(10);
//        return view('post.index', compact('posts'));
