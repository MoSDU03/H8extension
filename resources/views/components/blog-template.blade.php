@props([
    // every prop is being assigned with the $
    'profileName' => 'Default Name',
    'title', 
    'content', 
    'createdAt', 
    'post', 
    'showSubpageName' => false, // Default to false since it might not be always provided.
    'subpageName' => null, // Default to null since it might not be always provided.
    'subpage_slug', // Add this to accept the subpage slug
    'post_slug'
])


<div class="box w-1 slide-in">
    <div class="titles">
        <h3 class="h-1">{{ $subpageName }}</h3> <!-- Subpage name included -->
        <h2 class="h">{{ $title }}</h2>
    </div>
    <div class="b-1">
        <h3 class="h-1">{{ $profileName }}</h3>
        <p class="p-1">{{ $content }}</p>
        <span class="p-2">{{ $createdAt->diffForHumans() }}</span>
    </div>
    
    <div class="b-2">
        <!-- 'slug' is the one in the route and gets its value from '$subpage_slug '. The '$subpage_slug' value is being transfered from the parrent blade via the props at the top. -->
        <form method="POST" action="{{ route('posts.like.toggle', ['slug' => $subpage_slug, 'postSlug' => $post_slug]) }}"> 
            @csrf
            <x-secondary-button type="submit" class="button-space {{ $post->isLikedByUser(Auth::user()) ? 'liked' : 'not-liked' }}">
                {{ $post->likes->count() }} {{ __('Like') }}
            </x-secondary-button>
        </form>


        <!-- Show/Hide Comment Section -->
        <x-secondary-button class="button-space blog-comment-btn" type="button" data-post-id="{{ $post->id }}">
            {{ __('Comment') }}
        </x-secondary-button>

        <!-- <x-secondary-button class="button-space" type="button" id="share"> -->
          <!--  {{ __('Share') }} --> <!-- Placeholder for share functionality -->
        <!-- </x-secondary-button> -->

        <x-secondary-button class="button-space" type="button" id="share">
        {{ __('Share') }}
        </x-secondary-button>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="share-header">Where do you want to share this blog post?</div>
                <div class="share-buttons-container">
                    <div> <a href="#" id="share-facebook">Facebook<img src="/images/Facebook-icon.svg" alt="Facebook" style="width:42px;height:42px;"></a> </div>
                    <div> <a href="#" id="share-twitter">Twitter<img src="/images/Twitter-icon.jfif" alt="Twitter" style="width:42px;height:42px;"></a> </div>
                    <div> <a href="#" id="share-linkedin">LinkedIn<img src="/images/LinkedIn-icon.svg" alt="LinkedIn" style="width:42px;height:42px;"></a> </div>
                </div>
            </div>
        </div>        
        
        @if (auth()->check() && auth()->id() === $post->user_id)
            <!-- Form for deleting a post -->
            <form method="POST" id="delete-form-{{ $post->id }}" action="{{ route('subpages.posts.destroy', ['slug' => $subpage_slug, 'postSlug' => $post->slug]) }}">
                @csrf
                @method('DELETE')
                <x-danger-button class="button-space red end delete-post-btn" type="button" data-form-id="delete-form-{{ $post->id }}">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
        @endif


    </div>

    <!-- Hidden Comment Section -->
    <div id="comment-section-{{ $post->id }}" class="comment-section" style="display: none;">
        <!-- 'slug' is the one in the route and gets its value from '$subpage_slug '. The '$subpage_slug' value is being transfered from the parrent blade via the props at the top. -->
       <form method="POST" action="{{ route('posts.comments.store', ['slug' => $subpage_slug, 'postSlug' => $post_slug]) }}">
           @csrf
           <x-textarea-input name="content" class="block mt-1 w-full" rows="3" placeholder="Write a comment..."></x-textarea-input>
           <x-primary-button class="ms-3" type="submit">
               {{ __('Post Comment') }}
           </x-primary-button>
       </form>
       @foreach($post->comments as $comment)
       <x-comment-template 
           :profileName='$comment->user->name'
           :content='$comment->content'
           :createdAt='$comment->created_at->diffForHumans()'
           :comment='$comment'
       ></x-comment-template>
       @endforeach
   </div>
</div>


