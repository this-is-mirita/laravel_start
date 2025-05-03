<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;


class DestroyController extends BaseController
{
    public function __invoke(Post $post)
    {
        // TODO: Implement __invoke() method.
        // Удаляем пост
        $post->delete();

        // После удаления перенаправляем на страницу списка постов
        return redirect()->route('post.index');

    }
}
