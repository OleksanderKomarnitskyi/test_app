<?php

namespace App\Http\Controllers;


use App\Enums\Statuses;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostStatusRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class PostController extends Controller
{

    /**
     * @var PostService
     */
    private PostService $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $posts = Post::with('author')->get();

        return PostResource::collection($posts);
    }

    /**
     * @param StorePostRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->user()->id;
        $data['status'] = Statuses::Draft->value;

        $post = $this->postService->create($data);

        if($post) {
            return response()->json(['message' => "Post create successful"], 201);
        } else {
            return response()->json(['message' => 'Server Error'], 500);
        }

    }

    /**
     * @param UpdatePostStatusRequest $request
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function updateStatus(UpdatePostStatusRequest $request, Post $post): JsonResponse
    {
        $data = $request->validated();
        $result = $this->postService->updateStatus($post, $data);
        $post->refresh();

        if($result) {
            if ($post->status == Statuses::Active->value) {
                return response()->json(['message' => "Post activate successful"]);
            } elseif ($post->status == Statuses::Draft->value) {
                return response()->json(['message' => "Post is deactivate successful"]);
            } else {
                return response()->json(['message' => "Post update successful"]);
            }
        } else {
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
