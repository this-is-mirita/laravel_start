<?php

namespace App\Http\Controllers\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        // TODO: Implement __invoke() method.
        $res = $request->validated();
        $post = $this->service->store($res);

        //return $post instanceof Post ? new PostResource($post) : $post;
        // После успешного создания перенаправляем на страницу списка постов
        return redirect()->route('post.index');
    }
}
