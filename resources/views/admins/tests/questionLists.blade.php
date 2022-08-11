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
                <td class="text-center"><span class="fas fa-times-circle close" style="cursor: pointer;"></span></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

@push('scripts')
    <script>
        $(document).on('click', '.close', function () {
            $(this).parent().parent().remove();
        })
    </script>
@endpush
