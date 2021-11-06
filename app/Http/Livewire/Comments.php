<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    //Instances
    protected $paginationTheme = 'bootstrap';
    public $newComment, $photo, $photoPreview = false, $ticketId, $showAddCommentDiv = false, $btnAddNewComment = 'disabled';

    protected $listeners = [

        'ticketSelected', //if emited comes here in specified listener and should have its function 
    ];


    //Methods
    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
        $this->btnAddNewComment = 'enabled';
    }

    public function updatedNewComment()
    {
        $this->validate(['newComment' => 'required|max:20']);
    }

    public function updatedPhoto()
    {
        $this->validate(['photo' => 'image|max:1024']);
        $this->photoPreview = true;

        // 'photo' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,docx|max:1024'
    }

    public function addComment()
    {
        $this->updatedNewComment();

        if (isset($this->photo)) {
            $this->updatedPhoto();
            $photoPath = $this->photo->store('public/photos');
        } else {
            $photoPath = 'public/photos/default_img.png';
        }

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'photo' => $photoPath,
            'user_id' => 1,
            'support_ticket_id' => $this->ticketId,
        ]);
        // $this->comments->push($createdComment); //add to the last
        // $this->comments->prepend($createdComment); //add to the top

        $this->newComment = $this->photoPreview = "";
        $this->photo = null;
        session()->flash('messageSuccess', 'Comment  added successfully 😃');
        $this->emit('alerted');
    }

    public function removeComment($commentId)
    {
        Comment::find($commentId)->delete();
        // $this->comments = $this->comments->except($commentId);
        session()->flash('messageSuccess', 'Comment  deleted successfully 😃');
        $this->emit('alerted');
    }

    // public function mount()
    // {
    //     $this->comments = Comment::latest()->get();
    // }

    public function render()
    {
        return view('livewire.comments', [

            'comments' =>  Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }
}
