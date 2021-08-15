<style>

</style>
<x-web-layout>
    <x-slot name="content">
        <div id="youtubeList">
            <div class="max-w-5xl my-5 mx-auto sm:px-6 lg:px-6">
                <div class="flex flex-wrap -mx-3">
                    @foreach($movies as $movie)
                        <div class="w-full md:w-1/2 px-3 mt-10">
                            <video
                              id="{{ $movie->id }}"
                              class="video-js vjs-default-skin"
                              controls
                              preload="auto"
                              width="480" height="270"
                              data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "{{ $movie->url_link }}"}] }'>
                            >
                            </video>

                        </div>
                        <div class="w-full md:w-1/2 px-3 mt-10 movie-box" style="padding-left: 30px">
                            <p class="text-sm text-red-900">{{ $movie->title }}</p>
                            <p class="text-sm">Shared by: {{ $movie->author->email }}</p>
                            <span>89
                                @if (Auth::user() != null)
                                    @if (Auth::user()->movieInteraction($movie->id) == App\Models\UserMovie::STATUS['up_voted'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 voted up_voted_fill up_voted" viewBox="0 0 20 20" fill="currentColor"  data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['up_voted']}}">
                                          <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 voted up_voted hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['up_voted']}}">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 voted up_voted up_voted_fill hidden" viewBox="0 0 20 20" fill="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['up_voted']}}">
                                          <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 voted up_voted" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['up_voted']}}">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 up_voted" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                @endif
                            </span>
                            &nbsp;&nbsp;
                            <span> 12
                                @if (Auth::user() != null)
                                    @if (Auth::user()->movieInteraction($movie->id) == App\Models\UserMovie::STATUS['down_voted'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 down_voted_fill voted down_voted" viewBox="0 0 20 20" fill="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['down_voted']}}">
                                          <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 down_voted hidden voted" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['down_voted']}}">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 down_voted_fill voted hidden down_voted" viewBox="0 0 20 20" fill="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['down_voted']}}">
                                          <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 down_voted voted" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-movie-id="{{$movie->id}}" data-vote="{{App\Models\UserMovie::STATUS['down_voted']}}">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 down_voted" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                    </svg>
                                @endif
                            </span>

                            <p class="text-sm">Description:</p>
                            <p class="readmore">
                                {{ mb_strimwidth($movie->description, 0, 350, "...") }}
                                @if(strlen($movie->description) > 350)
                                    <a href="#" class="readmore_link">read more</a>
                                @endif
                            </p>
                            @if(strlen($movie->description) > 350)
                                <p class="readless hidden">
                                    {{$movie->description}}
                                    <a href="#" class="readless_link">read less</a>
                                </p>
                            @endif
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </x-slot>
    @push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".readmore_link").on('click', function(e) {
                e.preventDefault();
                $(this).parent().addClass('hidden');
                $(this).parent().next('.readless').removeClass('hidden');
            });
            $(".readless_link").on('click', function(e) {
                e.preventDefault();
                $(this).parent().addClass('hidden');
                $(this).parent().prev('.readmore').removeClass('hidden');
            });
            $('.down_voted').css('cursor', 'pointer');
            $('.up_voted').css('cursor', 'pointer');
        @if(Auth::user())
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.up_voted').on('click', function(e) {
                if ($(this).hasClass('up_voted_fill')) {
                    $(this).addClass('hidden');
                    $(this).next().removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                    $(this).prev().removeClass('hidden');
                    btn = $(this).parent().next().children('svg.down_voted_fill').first();
                    if (!btn.hasClass('hidden')) {
                        btn.addClass('hidden');
                        btn.next().removeClass('hidden');
                    }
                }
            });

            $('.down_voted').on('click', function(e) {
                if ($(this).hasClass('down_voted_fill')) {
                    $(this).addClass('hidden');
                    $(this).next().removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                    $(this).prev().removeClass('hidden');
                    btn = $(this).parent().prev().children('svg.up_voted_fill').first();
                    if (!btn.hasClass('hidden')) {
                        btn.addClass('hidden');
                        btn.next().removeClass('hidden');
                    }
                }
            });
            $('.voted').on('click', function() {
                $.ajax({
                    type:'POST',
                    url: "{{ route('movies.vote') }}",
                    data: {
                        'movie_id': $(this).data('movie-id'),
                        'voted_status': $(this).data('vote')
                    },
                    success:function(data){
                        console.log(data);
                    }
                });
            });
        @else
            $('.down_voted, .up_voted').on('click', function() {
                if (confirm("Do you want login/registerr!")){
                    $('#email').focus();
                }
            });
        @endif
        });
    </script>
@endpush
</x-web-layout>