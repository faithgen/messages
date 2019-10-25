<?php

namespace FaithGen\Messages\Http\Controllers;

use App\Http\Controllers\Controller;
use FaithGen\Messages\Http\Requests\Message\CreateRequest;
use FaithGen\Messages\Http\Requests\Message\GetRequest;
use FaithGen\Messages\Http\Requests\Message\UpdateRequest;
use FaithGen\Messages\Http\Resources\Message as MessageResource;
use FaithGen\Messages\Services\MessageService;
use FaithGen\SDK\Http\Requests\IndexRequest;

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
}
