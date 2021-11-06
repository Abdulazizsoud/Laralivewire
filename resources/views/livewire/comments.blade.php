<div>
    @if ($btnAddNewComment == 'disabled')
        <small class="text-danger">*(Add New Comment) button is disabled until you select a ticket*</small>
    @endif

    <div class="row">
        <h2 class="pb-3 col-md-8" style="font-weight:bold">Comments</h2>
        <button {{ $btnAddNewComment }} type="button" wire:click="$toggle('showAddCommentDiv')"
            class="btn btn-primary mb-3 col-md-4">
            Add New Comment
        </button>
    </div>

    @if (session()->has('messageSuccess'))<div class="alert alerted alert-success"> {{ session('messageSuccess') }}</div>@endif

    <div class="row">

        @if ($showAddCommentDiv)
            <form action="" wire:submit.prevent="addComment" class="col-md-12" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <label for="">Description:</label> @error('newComment') <span
                            class="error text-danger">{{ $message }} </span> @enderror
                        <input class="form-control" type="text" wire:model.lazy="newComment">

                        <br>

                        <label for="">Image:</label> @error('photo') <span
                            class="error  text-danger">{{ $message }}</span> @enderror
                        <div class="row col-md-12">
                            <input class='form-control col-md-8' type="file" wire:model="photo">

                            <button class='btn btn-success col-md-2 float-right' type="submit"
                                wire:loading.attr="disabled" wire:target="photo">
                                <div wire:loading wire:target="addComment">
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                </div>
                                Add
                            </button>
                        </div>

                        <div wire:loading wire:target="photo">
                            <br>
                            <div class="alert alert-info col-md-12"> loading Image... </div>
                        </div>
                        @if ($photoPreview) Photo Preview: <br> <img src="{{ $photo->temporaryUrl() }}" width="200"> @endif
                    </div>
                </div>
            </form>
        @endif

        <div class="col-md-12 mt-5">

            @if (session()->has('messageError'))<div class="alert alerted alert-danger"> {{ session('messageError') }}</div>@endif

            @foreach ($comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title col-md-12">{{ $comment->creator->name }}
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            <a href="#" class="btn btn-danger float-right"
                                wire:click="removeComment({{ $comment->id }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </h5>
                        <p class="card-text">
                            <img src="{{ Storage::url($comment->photo) }}" alt="" width="100">
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>
            @endforeach

            <br>

            {{ $comments->links() }}
        </div>
    </div>

</div>
