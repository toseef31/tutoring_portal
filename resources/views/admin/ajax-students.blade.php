<option value="">Select Student</option>
@foreach($students as $student)
<option value="{{ $student->student_id }},{{ $student->user_id }}">{{$student->student_name}}</option>

@endforeach
