<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Constants\UserConstants;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateCurrency extends Command
{
    /**
     * @var string
     */
    protected $signature = 'update:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates currency for all users';

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        DB::transaction(function () {
            $users = $this->userRepository->all();

            foreach ($users as $user) {
                $user->currency += $user->level * UserConstants::DEFAULT_CURRENCY_INCOME;
                $user->save();
            }
        });
    }
}
