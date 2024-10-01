<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;

        return response()->json([
            'message' => 'Successfully retrieved notifications', // Corrected syntax error here
            'data' => $notifications
        ], 200);
    }

    public function show($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved notification',
            'data' => $notification
        ], 200);
    }

    public function delete($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);
        
        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ], 200);
    }
    
    public function deleteAll()
    {
        auth()->user()->notifications()->delete();

        return response()->json([
            'message' => 'All notifications deleted successfully'
        ], 200);
    }
}