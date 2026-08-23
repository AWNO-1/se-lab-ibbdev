<?php

namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class PostService implements PostServiceInterface
{
    protected ReputationServiceInterface $reputationService;

    public function __construct(ReputationServiceInterface $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    public function createPost(array $data, ?string $imagePath = null): Post
    {
        $post = Post::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'body' => $data['body'],
            'image_path' => $imagePath,
        ]);

        return $post;
    }

    public function getAllPosts(): Collection
    {
        return Post::with('user')->latest()->get();
    }

    public function getFilteredPosts(array $filters = [], int $perPage = 9): LengthAwarePaginator
    {
        $query = Post::with(['user', 'answers.user'])->withCount('answers');

        // Search
        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Filter by solved status
        if (isset($filters['filter'])) {
            if ($filters['filter'] === 'solved') {
                $query->where('is_solved', true);
            } elseif ($filters['filter'] === 'unsolved') {
                $query->where('is_solved', false);
            } elseif ($filters['filter'] === 'my' && ! empty($filters['user_id'])) {
                $query->where('user_id', $filters['user_id']);
            }
        }

        // Filter by user (for profile)
        if (! empty($filters['user_id']) && empty($filters['filter'])) {
            // Only if not already filtered by 'my'
            if (! isset($filters['filter']) || $filters['filter'] !== 'my') {
                // Don't auto-filter, just allow explicit
            }
        }

        // Sort
        $sort = $filters['sort'] ?? 'latest';
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'popular') {
            $query->orderByDesc('answers_count')->latest();
        } else {
            $query->latest();
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getPostWithRelations(int $id): ?Post
    {
        return Post::with('user', 'answers')->find($id);
    }

    public function updatePost(Post $post, array $data, ?string $imagePath = null): Post
    {
        $updateData = [
            'title' => $data['title'] ?? $post->title,
            'body' => $data['body'] ?? $post->body,
        ];

        if ($imagePath !== null) {
            // Delete old image if exists
            if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
                Storage::disk('public')->delete($post->image_path);
            }
            $updateData['image_path'] = $imagePath;
        }

        if (isset($data['is_solved'])) {
            $updateData['is_solved'] = (bool) $data['is_solved'];
        }

        $post->update($updateData);

        return $post->fresh();
    }

    public function deletePost(Post $post): bool
    {
        if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }

        return $post->delete();
    }

    public function canUserAnswer(int $userId, int $postId): bool
    {
        $post = Post::find($postId);

        return $post && $post->user_id !== $userId;
    }
}
