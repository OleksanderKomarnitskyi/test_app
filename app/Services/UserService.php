<?php

namespace App\Services;

use App\Models\Tariff;
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

    /**
     * @param User $user
     * @param Tariff $tariff
     * @return bool|Exception
     * @throws Exception
     */
    public function applyTariff(User $user, Tariff $tariff): bool|Exception
    {
        DB::beginTransaction();
        try {
            $user->tariff_id = $tariff->id;
            $result = $user->update([
                'tariff_expire_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                'available_posts' => $tariff->posts_count
            ]);
            $user->save();

            DB::commit();

            return $result;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

    }


}
