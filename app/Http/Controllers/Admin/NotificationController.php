<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $notifications = Notification::where('user_level', 'Admin')
            ->where('user_id', $user->id)
            ->where('is_read', 0);

        if(!empty($request->status)) {
            $notifications =  $notifications->where('status', $request->status);
        }
            
        $notifications = $notifications->paginate(50);

        return view('admin.notifications.index', [
            'notifications' => $notifications
        ]);
    }
}
