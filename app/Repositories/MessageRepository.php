<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Message;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MessageRepository {

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var Message
	 */
	private $message;


	/**
	 * Constructor 
	 * @param User $user 
	 */
	public function __construct(User $user, Message $message) {
		$this->user = $user;
		$this->message = $message;
	}

	/**
	 * Récupère tous les utilisateurs dont au moins un message à été envoyé
	 * @param  int    $userId
	 * @return 
	 */
	public function getConversations(int $userId) {
		
		$conversationTo = $this->message->newQuery()
			->join('users', 'messages.to_id', '=', 'users.id')
			->select('users.id', 'users.pseudo')
			->where('messages.from_id', '=', $userId);

		$conversations = $this->message->newQuery()
			->join('users', 'messages.from_id', '=', 'users.id')
			->select('users.id', 'users.pseudo')
			->where('messages.to_id', '=', Auth::id())
			->union($conversationTo)
			->get();

		return $conversations;
	}


	/**
	 * Enregistre un message
	 * @param  string $content 
	 * @param  int    $from_id 
	 * @param  int    $to_id   
	 * @return Message          
	 */
	public function createMessage(string $content, int $from_id, int $to_id) {
		return 
		$this->message->newQuery()->create([
			'content' => $content,
			'from_id' => $from_id,
			'to_id' => $to_id,
			'created_at' => Carbon::now()
		]);
	}


	/**
	 * Récupère les messages entre 2 users
	 * @param  int    $from 
	 * @param  int    $to   
	 * @return  Builder      
	 */
	public function getMessagesFor(int $from, int $to) {
		return 
		$this->message->newQuery()
			->whereRaw("((from_id = " .$from. " AND to_id = " .$to. ") OR (from_id = " .$to. " AND to_id = " .$from. "))")
			->orderBy('created_at', 'DESC')
			->with('from');
	}


	/**
	 * Récupère le nombre de messages non lus pour chaque conversation
	 * @param  int    $userId 
	 * @return Builder []
	 */
	public function unreadCount(int $userId) {
		return 
		$this->message->newQuery()
			->where('to_id', $userId)
			->groupBy('from_id')
			->selectRaw('from_id, COUNT(id) as count')
			->whereRaw('read_at IS NULL')
			->get()
			->pluck('count', 'from_id');
	}

	/**
	 * Marque tous les messages comme lus pour un utilisateur
	 * @param  int    $from 
	 * @param  int    $to   
	 * @return        
	 */
	public function readAllFrom(int $from, int $to) {
		$this->message->where('from_id', $from)->where('to_id', $to)->update(['read_at' => Carbon::now()]);
	}
}
