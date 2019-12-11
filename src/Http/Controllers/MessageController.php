<?php

namespace FaithGen\Messages\Http\Controllers;

use App\Http\Controllers\Controller;
use FaithGen\Messages\MessageService;
use FaithGen\SDK\Http\Requests\IndexRequest;
use FaithGen\Messages\Http\Requests\GetRequest;
use FaithGen\Messages\Http\Requests\CreateRequest;
use FaithGen\Messages\Http\Requests\UpdateRequest;
use FaithGen\Messages\Http\Requests\CommentRequest;
use FaithGen\Messages\Http\Resources\Message as MessageResource;
use FaithGen\Messages\Models\Message;
use FaithGen\SDK\Helpers\CommentHelper;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    function index(IndexRequest $request)
    {
        $messages = auth()->user()->messages()
            ->where('title', 'LIKE', '%' . $request->filter_text . '%')
            ->orWhere('message', 'LIKE', '%' . $request->filter_text . '%')
            ->latest()->paginate($request->has('limit') ? $request->limit : 15);
        return MessageResource::collection($messages);
    }

    function create(CreateRequest $request)
    {
        return $this->messageService->createFromRelationship($request->validated(), 'Message created successfully!');
    }

    function update(UpdateRequest $request)
    {
        return $this->messageService->update($request->validated());
    }

    function destroy(GetRequest $request)
    {
        return $this->messageService->destroy('Message deleted successfully!');
    }

    public function comment(CommentRequest $request)
    {
        return CommentHelper::createComment($this->messageService->getMessage(), $request);
    }

    public function comments(Request $request, Message $message)
    {
        $this->authorize('message.view', $message);
        return CommentHelper::getComments($message, $request);
    }
}
