<h1 class="order-1">
{{ $comments['sort'] ?? 'asdf'}}
</h1>
@foreach ($comments['comments'] as $comment)
<div class="comment relative my-4 border-2 rounded-xl">
  <div class="header flex flex-col border-b-2 md:flex-row">
    <div class="user basis-1/2">
      <p class="user px-4 py-2 text-left">{{ $comment['user'] }}</p>
    </div>
    <div class="comments-stars flex flex-row-reverse justify-end">
      <svg class="@if ($comment['rating'] >= 5) text-yellow-200 @endif relative top-1/2 -translate-y-1/2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <path
          d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
      </svg>
      <svg class="@if ($comment['rating'] >= 4) text-yellow-200 @endif relative top-1/2 -translate-y-1/2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <path
          d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
      </svg>
      <svg class="@if ($comment['rating'] >= 3) text-yellow-200 @endif relative top-1/2 -translate-y-1/2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <path
          d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
      </svg>
      <svg class="@if ($comment['rating'] >= 2) text-yellow-200 @endif relative top-1/2 -translate-y-1/2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <path
          d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
      </svg>
      <svg class="@if ($comment['rating'] >= 1) text-yellow-200 @endif relative top-1/2 -translate-y-1/2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <path
          d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
      </svg>
    </div>
    <div class="likes basis-1/2 flex justify-end">
      <p class="likes p-2 text-left">{{ $comment['likes'] }} likes</p>
      <svg @auth onclick="like(this, {{ $comment['commentId'] }})" @endauth
        class="h-8 w-8 m-1 @if ($comment['like']) text-yellow-400 @endif @auth cursor-pointer hover:text-red-500 transition-all @endauth"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
      </svg>
    </div>
  </div>
  <p class="comment px-4 py-2">{{ $comment['comment'] }}</p>
</div>
@endforeach
@if ($comments['pages'] > 0)
<div class="pagination flex justify-end">
  @for ($i = 1; $i <= $comments['pages']; $i++)
  <div onclick="loadComments('all', {{$i}})" class="@if ($comments['page'] == $i) active @endif relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-800 hover:text-white transition cursor-pointer">
    {{$i}}
  </div>
  @endfor
</div>
@endif
