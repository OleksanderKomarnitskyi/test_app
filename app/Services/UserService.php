<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

final  class UserService extends MySqlService
{

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function create(array $data): User
    {
        DB::beginTransaction();
        try {

            $data['password'] = bcrypt($data['password']);
            $data['email_verified_at'] = Carbon::now();
            $user = User::create($data);

            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }


}
