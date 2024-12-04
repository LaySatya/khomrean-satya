<div class="overflow-x-auto border rounded-md mt-5">
  <table class="table">
      <!-- head -->
      <thead class="bg-blue-600 rounded-md text-white text-[16px] text-center">
          <tr>
              <th>លរ</th>
              <th>ឈ្មោះ</th>
              <th>ភេទ</th>
              {{-- <th>វត្តមាន</th> --}}
              <th>កិច្ចការផ្ទះ</th>
              {{-- <th>សៀវភៅ</th> --}}
              {{-- <th>សកម្មភាព</th> --}}
              <th>ឃ្វីស</th>
              <th>ប្រឡង</th>
              <th>សរុប</th>
              <th>និទ្ទេស</th>
              <th>ផ្សេងៗ</th>
          </tr>
      </thead>
      <tbody class="text-[16px]">
        @if ($students && count($students) > 0)
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
                    {{-- <td class="text-center">{{ $s->attendance }}</td> --}}
                    <td class="text-center">{{ $s->homework }}</td>
                    {{-- <td class="text-center">{{ $s->book }}</td> --}}
                    {{-- <td class="text-center">{{ $s->activity }}</td> --}}
                    <td class="text-center">{{ $s->quiz }}</td>
                    <td class="text-center">{{ $s->exam }}</td>
                    <td class="text-center">{{ $total }}</td>
                    <td class="text-center">
                        <div class="rounded-lg py-1 {{ $color }}">
                            {{ $grade }}
                        </div>
                    </td>
                    <td class="text-center">--</td>
                
                </tr>
            @endforeach
        @else
                <tr>
                    <td colspan="11" class="text-center text-gray-500">មិនទាន់មានចំណាត់ថ្នាក់🎓</td>
                </tr>
    
        @endif

      </tbody>
  </table>
</div>
