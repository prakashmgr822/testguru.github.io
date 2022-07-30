
<div class="form-group row">
    <div class="col-6">
        <label for=""> Full Name *</label>
        <input type="text" required class="form-control" name="name" value="{{ old('name',$item->name) }}"
               placeholder="Enter name">
    </div>
    <div class="col-6">
        <label for=""> Email Address *</label>
        <input type="email" required class="form-control" name="email" value="{{ old('email',$item->email) }}"
               placeholder="Enter email address">
    </div>

</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for=""> Password *</label>
        <input type="password" {{$item->email?"":"required"}} class="form-control" name="password"
               placeholder="Leave empty for old password">
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for=""> Phone number</label>
        <input type="tel" class="form-control" name="phone" value="{{ old('phone',$item->phone) }}"
               placeholder="Enter Phone number">
    </div>
    <div class="col-md-6">
        <label for=""> Address</label>
        <input type="tel" class="form-control" name="address" value="{{ old('address',$item->address) }}"
               placeholder="Enter address">
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for=""> Date of Birth</label>
        <input type="date" class="form-control" name="level" value="{{ old('dob',$item->dob) }}"
               placeholder="Enter date of birth">
    </div>
    <div class="col-md-6">
        <label for=""> Gender</label>
        <select class="form-control" name="gender">
            <option {{$item->gender==="male"?"selected":""}} value="male">Male</option>
            <option {{$item->gender==="female"?"selected":""}} value="female">Female</option>
            <option {{$item->gender==="other"?"selected":""}} value="other">Other</option>
        </select>
    </div>
</div>
