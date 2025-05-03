<?php

namespace App\Http\Controllers\Post;


use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        // Получаем проверенные данные из запроса
        $data = $request->validated();

        // Вызываем метод обновления из сервиса
        $post = $this->service->update($post, $data);

        // Проверяем, что вернулся объект Post
        if (!$post instanceof Post) {
            // Если вернулась строка с ошибкой, можно вернуть сообщение или перенаправить на другую страницу
            return redirect()->route('post.index')->with('error', 'Ошибка обновления поста: ' . $post);
        }

        // После успешного обновления перенаправляем на страницу просмотра поста
        return redirect()->route('post.show', $post->id);
    }

}
