<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\TypeHabitats;
use App\Repositories\MessageRepository;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    
    /**
	 * @var MessageRepository
	 */
	private $repository;


	/**
	 * Constructor 
	 * @param MessageRepository $repository 
	 */
	public function __construct(MessageRepository $repository) {
		$this->repository = $repository;
	}


    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {

        $typeHabitat = TypeHabitats::all();

    	$users = $this->repository->getConversations(Auth::id());

    	$unread = $this->repository->unreadCount(Auth::id());

    	return view('messages.index', compact('users', 'unread', 'typeHabitat'));
    }


    /**
     * [show description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show(User $user) {

        $typeHabitat = TypeHabitats::all();

    	$users = $this->repository->getConversations(Auth::id());

    	$messages = $this->repository->getMessagesFor(Auth::id(), $user->id)->paginate(50);

    	$unread = $this->repository->unreadCount(Auth::id());

    	if (isset($unread[$user->id])) {
    		$this->repository->readAllFrom($user->id, Auth::id());
    		unset($unread[$user->id]);
    	}

    	return view('messages.show', compact('users', 'user', 'messages', 'unread', 'typeHabitat'));
    }

    /**
     * Enregistre un message
     * @param  User   $user 
     * @param MessageRequest $request
     * @return [type]       
     */
    public function store(User $user, MessageRequest $request) {

    	$this->repository->createMessage($request->get('content'), Auth::id(), $user->id);

    	return redirect(route('messages.show', $user->id));
    }


}
