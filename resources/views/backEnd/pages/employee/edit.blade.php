@extends('backEnd.layouts.masters')
@section('page-title', 'update your Employee')

@section('content')

<div class="containe">
    <div class="row">
        <div class="col-7 m-auto">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between  bg-light-subtle">
                  
                        <h3>Edit Employee</h3>
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.employee.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="" class="form-label"> Enter Employee Name</label>
                                <input type="text" name="name" id="" class="form-control" value="{{ $employee->name }}">
            
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="mb-3 col-6">
                                <label for="" class="form-label"> Enter Employee Identity </label>
                                <input type="text" name="identity" id="" class="form-control" value="{{ $employee->identity }}">
            
                                @error('identity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="" class="form-label"> Enter Employee's Number</label>
                                <input type="text" name="number" id="" class="form-control" value="{{ $employee->number }}">
            
                                @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="" class="form-label"> Gender </label>
                                <div>
                                    <label for="gender_male">Male</label>
                                    <input type="radio" id="gender_male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    
                                    <label for="gender_female">Female</label>
                                    <input type="radio" id="gender_female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                </div>
                                
            
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                         
                        <div class="mb-3 col-10">
                            <label for="" class="form-label"> E-mail </label>
                            <input type="email" name="email" id="" class="form-control" value="{{ $employee->email }}">
        
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Select Department</label>
                            <select name="department_id" id="department" class="form-select">
                                <option value="">-- SELECT --</option>
                                @foreach ( $department_list as $department_id => $name)
        
                                <option value="{{ $department_id }}"
        
                                    @if ($employee->department_id == $department_id) 
                                    selected  @endif > {{ $name }} </option>
                                    
                                @endforeach
                            </select>
        
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="" class="form-label">Select Designation</label>
                            <select name="designation_id" id="designation" class="form-select">
                                <option value="">-- SELECT --</option>
                                @foreach ( $designation_list as $designation_id => $designation_name)
        
                                <option value="{{ $designation_id }}"
        
                                    @if ($employee->designation_id == $designation_id) 
                                    selected 
                                    @endif >{{ $designation_name }}</option>
                                    
                                @endforeach
                            </select>
        
                            @error('designation_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <textarea class="form-control" id="floatingTextarea" name="address" cols="30"> {{ $employee->address }} </textarea>
                        </div>

                        <div class="my-4">
                            <label class="form-label">attach a image </label>
                            <input type="file" class="form-control" name="image">
    
                          @error('image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
        
                        <button type="submit" class="btn btn-primary">Update</button>
        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('java')
    <script>
        $(function(){
 
            var departmentEL = $('#department')
            var designationEL = $('#designation')

            $(departmentEL).change(function(e){
                var department_id = e.target.value

                $.get('/data/department/' + department_id + '/designations' , function(data){
                        $(designationEL).html(data)
                })
            })

        })
    </script>
@endpush


