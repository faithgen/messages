<?php

namespace FaithGen\Messages\Http\Controllers;

use FaithGen\Messages\Http\Requests\CreateRequest;
use FaithGen\Messages\Http\Requests\GetRequest;
use FaithGen\Messages\Http\Requests\UpdateRequest;
use FaithGen\Messages\Http\Resources\Message as MessageResource;
use FaithGen\Messages\MessageService;
use FaithGen\Messages\Models\Message;
use FaithGen\SDK\Helpers\CommentHelper;
use FaithGen\SDK\Http\Requests\CommentRequest;
use FaithGen\SDK\Http\Requests\IndexRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use InnoFlash\LaraStart\Helper;
use InnoFlash\LaraStart\Traits\APIResponses;

class MessageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, APIResponses, DispatchesJobs;
    /**
     * @var MessageService
     */
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Fetches the ministry`s messages.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $messages = auth()->user()->messages()
            ->where(fn ($message) => $message->search(['title', 'message'], $request->filter_text))
            ->latest()
            ->paginate(Helper::getLimit($request));

        MessageResource::wrap('messages');

        return MessageResource::collection($messages);
    }

    /**
     * Creates a message.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request)
    {
        return $this->messageService->createFromParent($request->validated(), 'Message created successfully!');
    }

    /**
     * Updates a message.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(UpdateRequest $request)
    {
        return $this->messageService->update($request->validated(), 'Message updated successfully');
    }

    /**
     * Deletes a message.
     *
     * @param GetRequest $request
     * @return mixed
     */
    public function destroy(GetRequest $request)
    {
        return $this->messageService->destroy('Message deleted successfully!');
    }

    /**
     * Comments a message.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(CommentRequest $request)
    {
        return CommentHelper::createComment($this->messageService->getMessage(), $request);
    }

    /**
     * Fetches a message`s comments.
     *
     * @param Request $request
     * @param Message $message
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function comments(Request $request, Message $message)
    {
        $this->authorize('view', $message);

        return CommentHelper::getComments($message, $request);
    }
}
