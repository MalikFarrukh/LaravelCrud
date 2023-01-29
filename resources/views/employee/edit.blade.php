<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 9 CRUD</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Laravel 9 CRUD</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <h4>Edit Employees</h4>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
        </div>

        <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="border-0 card shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name"
                            class="form-control  @error('name') is-invalid @enderror"
                            value="{{ old('name', $employee->name) }}">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="
                            {{ old('email', $employee->email) }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <Textarea name="address" rows="4" cols="30" placeholder="Enter Address" class="form-control">{{ old('address', $employee->address) }}</Textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label"></label>
                        <input type="file" name="image" class="@error('image') is-invalid @enderror">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                        <div class="mt-2">
                            @if ($employee->image != '' && file_exists(public_path() . '/uploads/employees/' . $employee->image))
                                <img src="{{ url('uploads/employees/' . $employee->image) }}" alt=""
                                    width="100" height="100">
                            @else
                                <img src="{{ url('assets/images/noImage.jpg') }}" alt="" width="100"
                                    height="100">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <button class="btn btn-primary mt-3">Update Employee</button>
        </form>
    </div>

</body>

</html>
