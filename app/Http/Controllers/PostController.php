<?php

namespace App\Http\Controllers;

use App\Contracts\PostServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource with search, filters, pagination.
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
            'filter' => $request->query('filter', 'all'),
            'sort' => $request->query('sort', 'latest'),
            'user_id' => $request->query('user_id'),
        ];

        // Handle 'my' filter: if user wants own posts, set user_id
        if ($filters['filter'] === 'my' && auth()->check()) {
            $filters['user_id'] = auth()->id();
        }

        $posts = $this->postService->getFilteredPosts($filters, 9);

        return view('posts.index', compact('posts', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $imagePath = $request->file('image')?->store('posts', 'public') ?? $request->file('image_path')?->store('posts', 'public');

        $post = $this->postService->createPost($data, $imagePath);

        return redirect()->route('posts.show', $post)->with('success', 'تم طرح السؤال بنجاح ✓');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'answers.user']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validated();
        $imagePath = $request->file('image')?->store('posts', 'public') ?? $request->file('image_path')?->store('posts', 'public');

        $this->postService->updatePost($post, $data, $imagePath);

        return redirect()->route('posts.show', $post)->with('success', 'تم تحديث السؤال بنجاح ✓');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->deletePost($post);

        return redirect()->route('posts.index')->with('success', 'تم حذف السؤال بنجاح');
    }
}
