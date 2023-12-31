<?php

namespace App\Services;

use App\Enums\Statuses;
use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

final  class PostService extends MySqlService
{
    /**
     * @param array $data
     * @return Post|Exception
     * @throws Exception
     */
    public function create(array $data): Post|Exception
    {
        DB::beginTransaction();
        try {
            $post = Post::create($data);

            if (isset($data['user_id'])) {
                $post->author()->associate($data['user_id']);
            }
            $post->save();

            DB::commit();

            return $post;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    /**
     * @param Post $post
     * @param array $data
     * @return bool|Exception
     * @throws Exception
     */
    public function updateStatus(Post $post, array $data): bool|Exception
    {
        DB::beginTransaction();
        try {

            if ($data['status'] == Statuses::Active->value) {
                $data['publish_date'] = Carbon::now()->format('Y-m-d H:i:s');
            }

            $post = $post->update($data);

            DB::commit();

            return $post;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

    }

}
