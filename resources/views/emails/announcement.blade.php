<x-mail::message>
# {{ $post->title }}

{{ $post->content_overview }}

<x-mail::button :url="$post->getUrl()">
Read Full Announcement
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>