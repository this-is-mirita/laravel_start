<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;

class PostController extends Controller
{
    // Вывод всех постов, отсортированных по ID
    public function index()
    {
        // Получаем все посты и сортируем по id
        $posts = Post::find(1);
        $categories = Category::find(1);
        $tag = Tag::find(1);
        //dd($posts->tags);
        // Можно раскомментировать и использовать если потребуется фильтрация по категории или тегу
        // $tag = Tag::find(1);
        // $category = Category::find(1);
        // $posts = Post::where('category_id', $category->id)->orderBy('id')->get();

        return view('post.index', compact('posts'));
    }

    // Создание поста и получение данных из формы
    public function store()
    {
        // Валидация входных данных
        $res = request()->validate([
            'title' => 'string|required|',  // Название поста, строка, обязательное
            'content' => 'string|required', // Контент поста, строка, обязательное
            'image' => 'string|required',  // Путь к изображению, строка, обязательное
            'category_id' => '',  // ID категории поста (можно ввести по умолчанию или добавить правило валидации)
            'tags' => ''
        ]);
        ;
        $tags = $res['tags'];
        unset($res['tags']);


        // Создаем новый пост с полученными данными
        $post = Post::create($res);
        $post->tags()->withTimeStamps()->attach($tags);

        // После успешного создания перенаправляем на страницу списка постов
        return redirect()->route('post.index');
    }

    // Просмотр одного поста
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    // Редактирование поста
    public function edit(Post $post)
    {
        // Получаем все категории для выбора
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    // Обновление данных поста
    public function update(Post $post)
    {
        // Валидация новых данных для обновления
        $data = request()->validate([
            'title' => 'string|required',
            'content' => 'string|required',
            'image' => 'string|required',
            'category_id' => '',  // ID категории поста
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        // Обновляем пост с новыми данными
        $post->update($data);

        $post->tags()->withTimeStamps()->sync($tags);
        // После успешного обновления перенаправляем на страницу просмотра поста
        return redirect()->route('post.show', $post->id);
    }

    // Удаление поста
    public function destroy(Post $post)
    {
        // Удаляем пост
        $post->delete();

        // После удаления перенаправляем на страницу списка постов
        return redirect()->route('post.index');
    }

    // Переход на страницу создания нового поста
    public function create()
    {
        // Получаем все категории для выбора при создании
        $categories = Category::all()->sortBy('id');
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    // Пример закомментированных методов для работы с записями

    // Пример для восстановления или удаления записей (с использованием softDeletes)
    // public function delete()
    // {
    //     $post = Post::withTrashed()->find(1); // Для восстановления удаленной записи
    //     $post->restore();
    //     dd('deleted');
    // }

    // Пример создания записи с условием или обновления существующей записи
    // public function firstOrCreate()
    // {
    //     $post = Post::firstOrCreate([
    //         'title' => 'test 2',
    //     ], [
    //         'content' => 'test 2',
    //         'image' => '/img some.jpg',
    //         'likes' => 21111,
    //         'is_published' => 1,
    //     ]);
    //     dump($post->title, $post->content);
    //     dump('finished');
    // }

    // Пример обновления записи, если она существует, или создание новой
    // public function updateOrCreate()
    // {
    //     $post = Post::updateOrCreate([
    //         'title' => 'test 33',
    //     ], [
    //         'title' => 'test 3 update',
    //         'content' => 'test 3 update',
    //         'image' => '/updateOrCreate another.jpg',
    //         'likes' => 2111,
    //         'is_published' => 1,
    //     ]);
    //     dump($post->title);
    //     dump('finished');
    // }
}
