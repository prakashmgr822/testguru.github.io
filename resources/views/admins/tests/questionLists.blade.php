@if($item)
    <div class="text-right">
        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add Questions</button>
    </div>
    <hr>
@endif
<table class="table table-hover">
    <thead>
    <tr>
        <th class="text-center">S.N</th>
        <th class="text-center">Grade</th>
        <th class="text-center">Subject</th>
        <th class="text-center">Question</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @if($item->questions->isNotEmpty())
        @foreach($item->questions as $i => $question)
            <tr>
                <td class="text-center">{{$i+1}}</td>
                <td class="text-center">N/A</td>
                <td class="text-center">{{$question->subject->name}}</td>
                <td class="text-center">{!! $question->question !!}</td>
                <td class="text-center">
                    <a target="_blank" href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-clean btn-icon btn-hover-danger">
                        <i class="fas fa-edit" style="font-size: 17px"></i></a>
                    <form class="d-inline" action="{{ route('questionDelete',['question_id' => $question->id, 'test_id' => $item->id]) }}"
                          method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-clean btn-icon">
                            <i class="fas fa-times-circle close " style="font-size: 20px; color: black"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).on('click', '.close', function () {--}}
{{--            $(this).parent().parent().remove();--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
