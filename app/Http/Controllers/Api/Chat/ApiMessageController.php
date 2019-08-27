<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Traits\TraitHelperMethods;
use App\Http\Resources\messageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Redis;

class ApiMessageController extends ApiController
{

    const MODEL = Message::class;
    const RESOURCE = messageResource::class;

    use TraitHelperMethods;

    public function store(Request $request)
    {
        $data = $request->all();
        $message = Message::create($data);

        $redis = Redis::connection();
        $redis->publish('message', json_encode($message));

        return response()->json($message, 200);

    }

    public function getUserNotification(Request $request)
    {
        $messages = Message::where('read', 0)->where('receiver_id', $request->user()->id)
            ->orderBy('created_at', 'desc')->get();
        return respnse()->json($messages, 200);

    }

    public function getUserMessages(Request $request)
    {
        $messages = Message::where('receiver_id', $request->user()->id)
            ->orderBy('created_at', 'desc')->get();
        return respnse()->json($messages, 200);
    }

    public function getUserMessageById(Request $request)
    {
        $message = Message::where('id', $request->id)->first();
        if (!$message->read) {
            $message->read = 1;
            $message->save();
        }
        return respnse()->json($message, 200);
    }

    public function getSentMessages(Request $request)
    {
        $messages = Message::where('sender_id', $request->user()->id)
            ->orderBy('created_at', 'desc')->get();
        return respnse()->json($messages, 200);
    }
}
