<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SyncRedisClicks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-redis-clicks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync clicks from Redis to the database';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $links = Link::all();


        foreach ($links as $link) {
            $clicks = Redis::get("link:{$link->id}");
            if ($clicks !== null) {
                $link->update(['clicks' => $clicks]);
            }
        }

        $this->info('Redis clicks synchronized to the database.');
    }
}
