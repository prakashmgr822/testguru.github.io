<div class="form-group row">
    <div class="col-6">
        <label for="">Grade</label>
        <select name="grade_id" id="grade" class="form-control" required>
            <option value="{{null}}">None</option>
            @foreach($grades as $grade)
                <option value="{{ $grade->id }}" {{ old('grade_id',$item->grade_id)==$grade->id?'selected':'' }}>{{$grade->name }}</option>
            @endforeach
        </select>
    </div>
    @if(isset($editSubject))
    <div class="col-6">
        <label for="">Subject Name</label>
        <input type="text" name="name" value="{{$item->name}}" class="form-control">
    </div>
    @endif
</div>
<div id="subject-name" class="my-3 mb-3" style="display: none">
    <div class="text-right">
        <button type="button" class="btn btn-success" id="add-subjects">Add subjects</button>
    </div>

        <table class="table mt-2 w-100">
            <thead>
            <tr>
                <th class="w-25 text-center">Name</th>
                <th><i class="fas fa-trash-alt" style="padding-left: 200px"></i></th>
            </tr>
            </thead>
            <tbody id="items">
            </tbody>
        </table>
</div>




