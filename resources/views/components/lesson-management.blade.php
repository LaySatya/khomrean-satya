@extends('dashboard')

@section('content')
    <div class="flex justify-between">
        <h3 class="text-3xl font-bold">
            Lessons
        </h3>
        <!-- You can open the modal using ID.showModal() method -->
        <button class="btn btn-neutral" onclick="addLessons.showModal()">New</button>
        <dialog id="addLessons" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">បន្ថែមមេរៀន</h3>
                <div class="w-full mt-5">
                    <form action="/dashboard/courses" method="POST">
                        @csrf
                        <div class="mt-5">
                            <label for="">លីងវីឌីអូមេរៀន</label>
                            <input type="text" value="{{ old('video_url') }}" name="video_url"
                                placeholder="វីឌីអូមេរៀន" class="input input-bordered border-info w-full" />
                            @error('video_url')
                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <label for="">ចំណងជើង</label>
                            <input type="text" value="{{ old('title') }}" name="title" placeholder="ចំណងជើង"
                                class="input input-bordered border-info w-full" />
                            @error('title')
                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <label for="">ការពណ៍នា</label>
                            <input type="text" value="{{ old('description') }}" name="description" placeholder="ពណ៍នា"
                                class="input input-bordered border-info w-full" />
                            @error('description')
                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5 flex justify-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
    <div>
         {{-- alert --}}
         @if (session('success'))
         <div role="alert" class="alert alert-success mt-5">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                 viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
             <span>
                 {{ session('success') }}
             </span>
         </div>
     @endif

    </div>
    
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 justify-between">
                @if (count($lessons) > 0)
                    @foreach ($lessons as $index => $l)
                        <div class="card card-compact bg-base-100 md:w-72 w-11/12 shadow-sm border mx-auto mt-3">
                            <div class="aspect-w-16 aspect-h-9 rounded-lg">
                                <iframe src="{{ $l->video_url }}" id="video-{{ $index }}"  class="video-frame rounded-t-lg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                <h2 class="card-title">{{ $l->title }}</h2>
                                <p>{{ $l->description }}</p>
                                <div class="card-actions justify-end">
                                    {{-- <a href=""> --}}
                                        <button class="btn btn-md bg-red-400 text-white" onclick="deleteLesson{{ $l->lesson_id }}.showModal()">លុប</button>
                                        <button class="btn btn-md bg-blue-400 text-white" onclick="editLesson{{ $l->lesson_id }}.showModal()">កែ</button>
                                    {{-- </a> --}}
                                </div>
                            </div>
                        </div>    
                        <!-- Open the modal using ID.showModal() method -->
                        {{-- <button class="btn" onclick="deleteLesson{{ $l->lesson_id }}.showModal()">open modal</button> --}}
                        <dialog id="deleteLesson{{ $l->lesson_id }}" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">លុបវីឌីអូនមេរៀន</h3>
                                <p class="py-4">Are you sure?</p>
                                <div class="modal-action">
                                <form method="dialog">
                                    <!-- if there is a button in form, it will close the modal -->
                                    <button class="btn">Close</button>
                                </form>
                                <a class="btn bg-red-400 text-white" href="/dashboard/remove-lesson/{{ $l->lesson_id }}">លុប</a>
                                </div>
                            </div>
                        </dialog>
                        {{-- edit lesson--}}
                        {{-- <script>
                            @if ($errors->has('video_url') || $errors->has('title') || $errors->has('description'))
                                window.onload = function() {
                                    document.getElementById("editLesson{{ $l->lesson_id }}").showModal();
                                };
                            @endif
                        </script> --}}
                        <dialog id="editLesson{{ $l->lesson_id }}" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">កែមេរៀន</h3>
                                <div class="w-full mt-5">
                                    <form action="/dashboard/edit-lesson/{{ $l->lesson_id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-5">
                                            <label for="">លីងវីឌីអូមេរៀន</label>
                                            <input type="text" value="{{ $l->video_url }}" name="video_url"
                                                placeholder="វីឌីអូមេរៀន" class="input input-bordered border-info w-full" />
                                            @error('video_url')
                                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-5">
                                            <label for="">ចំណងជើង</label>
                                            <input type="text" value="{{ $l->title }}" name="title" placeholder="ចំណងជើង"
                                                class="input input-bordered border-info w-full" />
                                            @error('title')
                                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-5">
                                            <label for="">ការពណ៍នា</label>
                                            <input type="text" value="{{ $l->description }}" name="description" placeholder="ពណ៍នា"
                                                class="input input-bordered border-info w-full" />
                                            @error('description')
                                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                                            @enderror
                                        </div>
                
                                        <div class="mt-5 flex justify-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </dialog>

                    @endforeach    
                @else   
                    <div class="flex justify-center items-center w-full text-nowrap">
                        <p class="text-center text-3xl">មិនទាន់មានមេរៀន បងនឹងដាក់មេរៀនអោយ👌💕</p>
                    </div>
                @endif
            </div>
            
       <script>
        // Automatically open the modal if there are validation errors
        @if ($errors->has('video_url') || $errors->has('title') || $errors->has('description'))
            window.onload = function() {
                document.getElementById('addLessons').showModal();
            };
        @endif
        

        document.addEventListener('DOMContentLoaded', () => {
    const iframes = document.querySelectorAll('.video-frame');

        iframes.forEach(iframe => {
            iframe.addEventListener('play', () => {
                iframes.forEach(otherIframe => {
                    // Stop other videos when a new video is played
                    if (otherIframe !== iframe) {
                        otherIframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
                    }
                });
            });
        });
    });




    </script>
@endsection
