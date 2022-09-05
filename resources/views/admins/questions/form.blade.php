<div class="form-group row">
    <div class="col-12">
        <label class="col-form-label">Question</label>
        <div>
            <div id="questionToolbar"></div>
            <div id="questionEditor"></div>
            <textarea name="question" id="question" style="display:none"></textarea>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-6">
        <label class="col-form-label">Correct option</label>
        <select  required class="form-control" name="answer" id="answer">
            <option value="" selected>Please Choose the Correct Answer</option>
            <option value="1" {{old('answer',$item->answer)=="1"?"selected":""}}>Option A</option>
            <option value="2" {{old('answer',$item->answer)=="2"?"selected":""}}>Option B</option>
            <option value="3" {{old('answer',$item->answer)=="3"?"selected":""}}>Option C</option>
            <option value="4" {{old('answer',$item->answer)=="4"?"selected":""}}>Option D</option>
        </select>
    </div>
    <div class="col-6">
        <label class="col-form-label">Subject</label>
        <select name="subject_id" id="" class="form-control" required>
            <option value="">Please Choose the Subject</option>
            @foreach($subjects as $subject)
                <option value="{{$subject->id}}" @if(isset($item->subject->id)) {{old('subject_id', $item->subject->id) ==$subject->id ? 'selected' : '' }}@endif>{{$subject->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6">
        <label class="col-form-label">Option A</label>
        <div>
            <div id="option1Toolbar"></div>
            <div id="option1Editor"></div>
            <textarea name="option_1" style="display:none" id="option_1" required></textarea>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="col-form-label">Option B</label>
        <div>
            <div id="option2Toolbar"></div>
            <div id="option2Editor"></div>
            <textarea name="option_2" style="display:none" id="option_2" required></textarea>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6">
        <label class="col-form-label">Option C</label>
        <div>
            <div id="option3Toolbar"></div>
            <div id="option3Editor"></div>
            <textarea name="option_3" style="display:none" id="option_3" required></textarea>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="col-form-label">Option D</label>
        <div>
            <div id="option4Toolbar"></div>
            <div id="option4Editor"></div>
            <textarea name="option_4" style="display:none" id="option_4" required></textarea>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-6">
        <label class="col-form-label">Hint</label>
        <div>
            <div id="hintToolbar"></div>
            <div id="hint"></div>
            <textarea name="hint" style="display:none" id="hintBox"></textarea>
        </div>
    </div>
</div>


