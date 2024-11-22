{{-- @extends('layouts.app') --}}
@extends('dashboard')

@section('content')
    <div class="flex justify-between">
        <h3 class="text-3xl font-bold">
            Students
        </h3>
        <!-- You can open the modal using ID.showModal() method -->
        <button class="btn btn-neutral" onclick="addStudents.showModal()">New</button>
        <dialog id="addStudents" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">ចុះឈ្មោះសិស្ស</h3>
                <div class="w-full mt-5">
                    <form action="/dashboard/students" method="POST">
                        @csrf
                        <div class="mt-5">
                            <label for="">ឈ្មោះ</label>
                            <input type="text" value="{{ old('name') }}" name="name" placeholder="ឈ្មោះ"
                                class="input input-bordered border-info w-full" />
                            @error('name')
                                <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <label for="">ភេទ</label>
                            <select class="select select-info w-full" name="gender">
                                <option disabled {{ old('gender') ? '' : 'selected' }}>ភេទ</option>
                                <option value="ស" {{ old('gender') == 'ស' ? 'selected' : '' }}>ស្រី</option>
                                <option value="ប" {{ old('gender') == 'ប' ? 'selected' : '' }}>ប្រុស</option>
                            </select>
                            @error('gender')
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
    <div class="overflow-x-auto border rounded-md mt-5">
        <table class="table">
            <!-- head -->
            <thead class="bg-blue-600 rounded-md text-white text-[16px] text-center">
                <tr>
                    <th>លរ</th>
                    <th>ឈ្មោះ</th>
                    <th>ភេទ</th>
                    <th>វត្តមាន</th>
                    <th>កិច្ចការផ្ទះ</th>
                    <th>សៀវភៅ</th>
                    <th>សកម្មភាព</th>
                    <th>ឃ្វីស</th>
                    <th>ប្រឡង</th>
                    <th>សរុប</th>
                    <th>និទ្ទេស</th>
                    <th>ផ្សេងៗ</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-[16px]">
                @foreach ($students as $s)
                @php
                    // Calculate total score
                    $total = $s->attendance + $s->homework + $s->book + $s->activity + $s->quiz + $s->exam;
            
                    // Determine the grade
                    if ($total >= 90) {
                        $grade = 'A';
                        $color = 'bg-green-500 text-white'; // A grade (Green)
                    } elseif ($total >= 80) {
                        $grade = 'B';
                        $color = 'bg-blue-500 text-white'; // B grade (Blue)
                    } elseif ($total >= 70) {
                        $grade = 'C';
                        $color = 'bg-yellow-500 text-white'; // C grade (Yellow)
                    } elseif ($total >= 60) {
                        $grade = 'D';
                        $color = 'bg-orange-500 text-white'; // D grade (Orange)
                    } elseif ($total >= 50) {
                        $grade = 'E';
                        $color = 'bg-gray-500 text-white'; // E grade (Red)
                    } else {
                        $grade = 'F';
                        $color = 'bg-red-500 text-white'; // F grade (Gray)
                    }
                @endphp
        
                    <tr class="border border-gray-300">
                        <td class="text-center">{{ $s->s_id }}</td>
                        <td class="text-center">{{ $s->name }}</td>
                        <td class="text-center">{{ $s->gender }}</td>
                        <td class="text-center">{{ $s->attendance }}</td>
                        <td class="text-center">{{ $s->homework }}</td>
                        <td class="text-center">{{ $s->book }}</td>
                        <td class="text-center">{{ $s->activity }}</td>
                        <td class="text-center">{{ $s->quiz }}</td>
                        <td class="text-center">{{ $s->exam }}</td>
                        <td class="text-center">{{ $total }}</td>
                        <td class="text-center">
                            <div class="rounded-lg py-1 {{ $color }}">
                                {{ $grade }}
                            </div>
                        </td>
                        <td class="text-center">--</td>
                        <td>
                            <button class="btn btn-circle text-success" onclick="addscore{{ $s->s_id }}.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            {{-- add score modal --}}
                            <dialog id="addscore{{ $s->s_id }}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="text-lg font-bold">ដាក់ពិន្ទុសិស្ស</h3>
                                    <div class="w-full mt-3">
                                        <form action="/dashboard/add-score-student/{{ $s->s_id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $s->s_id }}">
                                            <div class="mt-3">
                                                <label for="">វត្តមាន</label>
                                                <input type="text" value="{{ old('attendance') }}" name="attendance"
                                                    placeholder="ឈ្មោះ" class="input input-bordered border-info w-full" />
                                                @error('attendance')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <label for="">សៀវភៅ</label>
                                                <input type="text" value="{{ old('book') }}" name="book"
                                                    placeholder="សៀវភៅ" class="input input-bordered border-info w-full" />
                                                @error('book')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <label for="">កិច្ចការផ្ទះ</label>
                                                <input type="text" value="{{ old('homework') }}" name="homework"
                                                    placeholder="កិច្ចការផ្ទះ"
                                                    class="input input-bordered border-info w-full" />
                                                @error('homework')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <label for="">សកម្មភាព</label>
                                                <input type="text" value="{{ old('activity') }}" name="activity"
                                                    placeholder="សកម្មភាព"
                                                    class="input input-bordered border-info w-full" />
                                                @error('activity')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <label for="">ឃ្វីស</label>
                                                <input type="text" value="{{ old('quiz') }}" name="quiz"
                                                    placeholder="ឃ្វីស" class="input input-bordered border-info w-full" />
                                                @error('quiz')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <label for="">ប្រឡង</label>
                                                <input type="text" value="{{ old('exam') }}" name="exam"
                                                    placeholder="ប្រឡង" class="input input-bordered border-info w-full" />
                                                @error('exam')
                                                    <p class="text-red-500 text-sm mt-1" id="usernameError">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mt-5 flex justify-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                            <script>
                                    @if ($errors->has('attendance') || $errors->has('book') || $errors->has('homework') || $errors->has('activity') || $errors->has('quiz') || $errors->has('exam'))
                                        window.onload = function() {
                                            document.getElementById("addscore{{ $s->s_id }}").showModal();
                                        };
                                    @endif
                            </script>

                            <a href="#" class="btn btn-sm btn-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            {{-- <a href="/dashboard/remove-students/{{ $s->s_id }}"
                                class="btn btn-sm btn-circle btn-danger text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        // Automatically open the modal if there are validation errors
        @if ($errors->has('name') || $errors->has('gender'))
            window.onload = function() {
                document.getElementById('addStudents').showModal();
            };
        @endif
    </script>
@endsection
