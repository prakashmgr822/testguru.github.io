<div class="form-group row">
    <div class="col-6">
        <label for="">Name <span class="text-danger">*</span></label>
        <input type="text" required class="form-control" name="name" value="{{ old('name',$item->name) }}"
               placeholder="Enter Name">
    </div>
    <div class="col-6">
        <label for="">Email <span class="text-danger">*</span></label>
        <input type="email" required class="form-control" name="email" value="{{ old('email',$item->email) }}"
               placeholder="Enter E-Mail">
    </div>
</div>

<div class="form-group row">
    <div class="col-6">
        <label for=""> Password *</label>
        <input type="password" {{$item->email?"":"required"}} class="form-control" name="password"
               placeholder="Leave empty for old password">
    </div>
    <div class="col-6">
        <label for="">Grade</label>
        <select name="grade_id" id="" class="form-control">
            <option value="{{null}}">None</option>
            @foreach($grades as $grade)
                <option value="{{ $grade->id }}" {{ old('grade_id',$item->grade_id)==$grade->id?'selected':'' }}>{{$grade->name }}</option>
            @endforeach
        </select>
    </div>
</div>




<div class="form-group row">
    <div class="col-md-6">
        <label for=""> Date of Birth</label>
        <input type="date" class="form-control" name="dob" value="{{ old('dob',$item->dob) }}"
               placeholder="Enter date of birth">
    </div>
    <div class="col-md-6">
        <label for=""> Gender</label>
        <select class="form-control" name="gender">
            <option value="{{null}}">Unspecified</option>
            <option {{$item->gender==="male"?"selected":""}} value="male">Male</option>
            <option {{$item->gender==="female"?"selected":""}} value="female">Female</option>
            <option {{$item->gender==="other"?"selected":""}} value="other">Other</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-4">
        <label for="">Phone Number</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone',$item->phone) }}"
               placeholder="Enter Phone Number">
    </div>
    <div class="col-4">
        <label for="">Address</label>
        <input type="text" required class="form-control" name="address" value="{{ old('address',$item->address) }}"
               placeholder="Enter Address">
    </div>
    <div class="col-4">
        <label for="">Roll Number</label>
        <input type="text" class="form-control" name="roll_no" value="{{ old('roll_no',$item->roll_no) }}"
               placeholder="Enter Roll Number">
    </div>
</div>


