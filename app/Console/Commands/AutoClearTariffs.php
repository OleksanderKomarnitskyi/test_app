<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoClearTariffs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-clear-tariffs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto clear tariffs for users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $users = User::where('tariff_expire_date' >=  $now)->get();

        foreach ($users as $user) {
            $user->npdate([
                'tariff_expire_date' => null,
                'available_posts' => 0,
            ]);
        }

    }
}
