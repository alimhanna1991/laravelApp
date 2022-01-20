@props(['comment'])
<article class="flex bg-gray-100 rounded-xl border-gray-200 space-x-4">
    <div class="flex-shrenk-0">
        <img src="https://i.pravatar.cc/400?id={{$comment->id}}" width="400" height="400" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-blod">
                {{ $comment->author->username}}
            </h3>
            <p class="text-xs">
               <time>
               {{$comment->created_at->diffForHumans()}}
               </time>
            </p>

        <p>
            {{ $comment->body}}
            </p>
        </header>
    </div>
</article>
