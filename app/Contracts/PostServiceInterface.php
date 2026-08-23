<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PostServiceInterface
{
    public function createPost(array $data, ?string $imagePath = null): Post;

    public function getAllPosts(): Collection;

    public function getFilteredPosts(array $filters = [], int $perPage = 9): LengthAwarePaginator;

    public function getPostWithRelations(int $id): ?Post;

    public function updatePost(Post $post, array $data, ?string $imagePath = null): Post;

    public function deletePost(Post $post): bool;

    public function canUserAnswer(int $userId, int $postId): bool;
}
