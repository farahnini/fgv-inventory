<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'message' => 'successfully retrieved notifications',
            'data' => $notifications
        ], 200);
    }

    public function show($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);

        if (!$notification) {
            return response()->json([
                'message' => 'notification not found'
            ], 404);
        }

        return response()->json([
            'message' => 'successfully retrieved notification',
            'data' => $notification
        ], 200);
    }

    public function destroy($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);

        if (!$notification) {
            return response()->json([
                'message' => 'notification not found'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'message' => 'successfully deleted notification'
        ], 200);
    }

    public function destroyAll()
    {
        auth()->user()->notifications()->delete();

        return response()->json([
            'message' => 'successfully deleted all notifications'
        ], 200);
    }
}
