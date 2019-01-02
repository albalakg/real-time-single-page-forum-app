<?php

namespace App\Http\Controllers;

use App\Model\Reply;
use App\Model\Question;
use App\Events\ReplyEvent;
use Illuminate\Http\Request;
use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Notifications\NewReplyNotification;


class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        if($reply->user_id != $question->user_id){
            $user->notify(new NewReplyNotification($reply)); 
        }
        broadcast(new ReplyEvent( new ReplyResource($reply)))->toOthers();

        return response(['reply' => new ReplyResource($reply)], 201);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply) //Question is for removing the problem of "2 argguments must pass"
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Reply $reply, Request $request)
    {
        $reply->update($request->all());
        return response('Updated', 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();

        return response(null, 204);
    }
}
