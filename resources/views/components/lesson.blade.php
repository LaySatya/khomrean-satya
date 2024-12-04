<div>
    <form action="/" method="GET" class="flex items-center space-x-4 p-4 border rounded-lg max-w-lg mx-auto">
        <input type="text" name="title" placeholder="Search by title" value="{{ request('title') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <button type="submit" 
                class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            រកមេរៀន
        </button>
    </form>
      
</div>
<div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-1 justify-between">
    @if (request('title'))
    <h2 class="text-xl font-semibold text-center mt-5">ស្វែងរក: "{{ request('title') }}"</h2>
    @if (count($resultLessons) > 0)
        @foreach ($resultLessons as $index => $lesson)
            <div class="card card-compact bg-base-100 md:w-96 w-11/12 shadow-sm border mx-auto mt-3">
                <div class="aspect-w-16 aspect-h-9 rounded-lg">
                    <iframe src="{{ $lesson->video_url }}" id="video-{{ $index }}"  class="video-frame rounded-t-lg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $lesson->title }}</h2>
                    <p>{{ $lesson->description }}</p>
                    <div class="card-actions justify-end">
                        <a href="">
                            <button class="btn btn-md btn-primary">មើលមេរៀន</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-2xl mt-5">មិនទាន់មានមេរៀននេះ "{{ request('title') }}"</p>
    @endif
@else
    @if (count($lessons) > 0)
        <!-- Original lesson display logic -->
        @foreach ($lessons as $index => $l)
            <div class="card card-compact bg-base-100 md:w-96 w-11/12 shadow-sm border mx-auto mt-3">
                <div class="aspect-w-16 aspect-h-9 rounded-lg">
                    <iframe src="{{ $l->video_url }}" id="video-{{ $index }}"  class="video-frame rounded-t-lg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $l->title }}</h2>
                    <p>{{ $l->description }}</p>
                    <div class="card-actions justify-end">
                        <a href="">
                            <button class="btn btn-md btn-primary">មើលមេរៀន</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="flex justify-center items-center w-full lg:text-nowrap text-wrap">
            <p class="text-center text-3xl lg:ml-96">មិនទាន់មានមេរៀន បងនឹងដាក់មេរៀនអោយ👌💕</p>
        </div>
    @endif
@endif

</div>
