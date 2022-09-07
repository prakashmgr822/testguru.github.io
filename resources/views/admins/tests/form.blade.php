@isset($item)
    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Title</label>
            <input type="text" class="form-control" name="name" value="{{old('name',$item->name)}}" id="title"
                   placeholder="Title">
        </div>

        <div class="col-md-6">
            <label class="col-form-label">Date</label>
            <input type="datetime-local" class="form-control"
                   @if($item->target_date) value="{{old('target_date')?? date('Y-m-d\TH:i', strtotime($item->target_date)) }}"
                   @endif name="target_date" id="target_date"
                   placeholder="Date">
        </div>
    </div>
    {{--    <div class="form-group row">--}}
    {{--        <div class="col-md-12">--}}
    {{--            <label for="">Image</label>--}}
    {{--            <input type="file" {{$item->getFirstMediaUrl()? '':' '}} class="form-control" name="image">--}}
    {{--            @if($item->getImage())--}}
    {{--                <img src="{{ $item->getFirstMediaUrl() }}" alt="" width="50%">--}}
    {{--            @endif--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="form-group row">
        <div class="col-6 mt-4">
            <label for="">Exam Duration</label>
            <input type="number" name="exam_duration" class="form-control"
                   value="{{old('exam_duration',$item->exam_duration)?? ''}}" placeholder="Exam Duration (in minutes)">
        </div>
        <div class="col-6 mt-4">
            <label for="">Correct Marks</label>
            <input step="0.01" type="number" name="correct_marks" class="form-control"
                   value="{{old('description',$item->correct_marks)}}" min="0"
                   placeholder="Enter marks for correct questions.">
        </div>
    </div>
    <div class="form-group row">

        <div class="col-6">
            <label for="">Grade</label>
            <select name="grade_id" id="" class="form-control">
                <option value="{{null}}">None</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ old('grade_id',$item->grade_id)==$grade->id?'selected':'' }}>{{$grade->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <label for="">Status</label>
            <select name="status" id="" class="form-select form-control">
                <option value="0" {{old('status',$item->status)==0?'selected':''}}>Pending</option>
                <option value="1" {{old('status',$item->status)==1?'selected':''}}>Completed</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 mt-4">
            <label for="">Description</label>
            <textarea name="description" rows="4"
                      class="form-control">{{old('description',$item->description)}}</textarea>
        </div>
    </div>
@endisset

