@extends('backEnd.layouts.masters')
@section('page-title', 'Employees')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div>
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between bg-light-subtle">
                  
                        <h3>List of Employees</h3>
                        <a href="{{ route('admin.employee.create') }}" class="btn btn-outline-primary">Add a new Employee</a>
                    
                </div>
                <div class="card-body">
                   
                    <table class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Employee ID</th>
                                <th>Contact No.</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $employees as $employee )
                                  <tr>
                                        <td>{{ $loop->index + 1 }}</td>     
                                        <td class="col-image"><img border-radius: 50%; width="50" class="img-fluid rounded" src="{{ asset(Storage::url($employee->image)) }}"></td>
                                        <td>{{ $employee->name }}</td>     
                                        <td>{{ $employee->gender }}</td>     
                                        <td>{{ $employee->identity }}</td>     
                                        <td>{{ $employee->number }}</td>     
                                        <td>{{ $employee->designation->name ?? 'null'}}</td>    
                                        <td>{{ $employee->designation->department->name ?? 'null'}}</td>
                                        <td>{{ $employee->address ?? 'null' }}</td>       
                                        <td>
                                            <div class="actions">
                                                
                                                <a href="{{ route('admin.employee.edit',$employee->id) }}" class="btn btn-outline-info btn-sm"> <i class="fas fa-edit"></i></a>
    
                                                {{-- delete method --}}
                                                <a href="" class="btn btn-outline-danger btn-sm"
                                                    onclick="
                                                        event.preventDefault();
                                                        Swal.fire({
                                                         title: '{{ session()->get('warning') }}',
                                                         text: 'You won\'t be able to revert this!',
                                                         icon: 'warning',
                                                         showCancelButton: true,
                                                         confirmButtonColor: '#3085d6',
                                                         cancelButtonColor: '#d33',
                                                         confirmButtonText: 'Yes, delete it!'
                                                           }).then((result) => {
                                                             if (result.isConfirmed) {
                                                                
                                                                document.getElementById('deleteEmployee-{{ $employee->id }}').submit();
                                                               
                                                                }
                                                            }); 
                                                    "
                                                ><i class="fas fa-trash"></i></a>
                                                
                                                <form action="{{ route('admin.employee.destroy' , $employee->id) }}" method="post" id="deleteEmployee-{{ $employee->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                 </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection