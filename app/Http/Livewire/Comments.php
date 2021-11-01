<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination, WithFileUploads;

    public $newComment;
    public $image;
    public $ticketId;

    protected $rules = [
        'newComment' => 'required|max:255',
    ];
    protected $listeners = ['ticketSelected'];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /** Real time validation*/
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['newComment' => 'required|max:255']);
    }

    public function saveImage()
    {
        $this->validate([
            'image' => 'required|image|max:1024', // 1MB Max
        ]);
        return $this->image->store('images','public');
    }

    public function add()
    {
        $this->validate();

        $comment = Comment::create([
            'body' => $this->newComment,
            'image' => $this->saveImage(),
            'support_ticket_id' => $this->ticketId,
            'user_id' => 1
        ]);
        $this->newComment = '';
        $this->image = '';

        session()->flash('message', 'Comment created successfully :)');
    }

    public function remove($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully :)');
    }

    public function render()
    {
        $comments = Comment::with('creator')
            ->where('support_ticket_id', $this->ticketId)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('livewire.comments', compact('comments'));
    }

}
