<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class CleanupExpiredToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sanctum:cleanup-expired-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus Access Token yang sudah expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedToken = PersonalAccessToken::whereNotNull('expires_at')->where('expires_at', '<', now())->delete();

        $this->info("Deleted {$deletedToken} expired tokens.");
    }
}
