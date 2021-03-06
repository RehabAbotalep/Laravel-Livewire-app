<div>
    <h1 class="text-3xl">Comments</h1>
    <div>

    </div>

    @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif
    <br>
    <section>
        <form wire:submit.prevent="saveImage">
            <input type="file" wire:model="image">
            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </form>
    </section>

    @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    <form class="my-4 flex" wire:submit.prevent="add">
        <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in your mind."
               wire:model.debounce.500ms="newComment">
        <div class="py-2">
            <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
        </div>
    </form>
    @foreach($comments as $comment)
        <div class="rounded border shadow p-3 my-2">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="font-bold text-lg">{{$comment->creator->name}}</p>
                    <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">
                        {{$comment->created_at->diffForHumans()}}
                    </p>
                </div>
                <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer"
                wire:click="remove({{$comment->id}})"></i>
            </div>
            <p class="text-gray-800">{{$comment->body}}</p>
            @if($comment->image)
                <img src="{{$comment->image_path}}" />
            @endif
        </div>
    @endforeach
    {{$comments->links()}}

</div>

