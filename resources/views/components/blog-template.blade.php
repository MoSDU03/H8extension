@props(['profileName' => 'Default Name', 'title', 'content', 'createdAt', 'post'])



<div class="box w-1">
    <div class="titles">
        <h2 class="h">{{ $post->title }}</h2>
        <span class="p-1">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <div class="b-1">
        <h3 class="h-1">{{ $profileName }}</h3>
        <p class="p-1">{{ $post->content }}</p>
    </div>
    <div class="b-2">
        <x-secondary-button class="button-space" type="submit">
            {{__('Like') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="button" onclick="toggleCommentSection({{ $post->id }})">
            {{ __('Comment') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="submit">
            {{__('Share') }}
        </x-secondary-button>
    </div>
    <!-- Hidden Comment Section -->
    <div id="comment-section-{{ $post->id  }}" class="comment-section" style="display: none;"">
        <form method="POST" action="{{ route('posts.comments.store', $post->id) }}">
            @csrf
            <textarea name="content" class="block mt-1 w-full" rows="3" placeholder="Write a comment..."></textarea>
            <x-primary-button class="ms-3" type="submit">
                {{ __('Post Comment') }}
            </x-primary-button>
        </form>

        @foreach($post->comments as $comment)
        <!-- You can style this however you like -->
        <div class="existing-comment">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->content }}</p>
            <span>{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        @endforeach
    </div> 
</div>
