<?php

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Service
{

    public function store($res)
    {
        try {
            Db::beginTransaction();

            $tags = $res['tags'];
            $category = $res['category'];
            unset($res['tags'], $res['category']);


            $tagIds = $this->getTagIds($tags);
            $res['category_id'] = $this->getCategoryIds($category);

            // Создаем новый пост с полученными данными
            $post = Post::create($res);
            $post->tags()->attach($tagIds);

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }


        return $post;
    }


    public function update($post, $data)
    {
        try {
            Db::beginTransaction();
            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tagIds = $this->getTagIdsWithUpdate($tags);
            $data['category_id'] = $this->getCategoryIdsWithUpdate($category);

            // Обновляем пост с новыми данными
            $post->update($data);

            // Синхронизируем теги
            $post->tags()->sync($tagIds);

            // Возвращаем свежий объект поста
            $updatedPost = $post->fresh();
            if (!$updatedPost) {
                throw new \Exception("Post not found after update.");
            }

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            \Log::error('Post update failed: ' . $exception->getMessage());
            return $exception->getMessage();
        }

        return $updatedPost;
    }


    private function getCategoryIds($item)
    {
        $category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
    }

    private function getTagIds($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {

            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    private function getCategoryIdsWithUpdate($item)
    {
        if (!isset($item['id'])) {
            $category = Category::create($item);
        } else {
            $category = Category::find($item['id']);
            $category->update($item);
            $category = $category->fresh();
        }
        return $category->id;
    }

    private function getTagIdsWithUpdate($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            if (!isset($tag['id'])) {
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }
}
