<?php

namespace App\Listeners;

use App\Events\AdminLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class AdminLoginLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminLogin  $event
     * @return void
     */
    public function handle(AdminLogin $event)
    {
        $data = [
            'admin_id' => intval($event->admin->id),
            'username' => $event->admin->username,
            'ip' => app('request')->getClientIp(),
            'created_at' => Carbon::now(),
        ];
        if ($event->admin->id) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        DB::table('admin_login_logs')->insert($data);
    }
}
