<div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-1 justify-between">
  @if (count($lessons) > 0)
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
   
</div>
