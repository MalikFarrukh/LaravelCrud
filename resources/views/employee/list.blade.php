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
            <h4>Employees List</h4>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
        </div>
        @if (Session::has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="border-0 card shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    @if ($employees->isNotEmpty())
                        @foreach ($employees as $employee)
                            <tr valign="middle">
                                <td>{{ $employee->id }}</td>
                                <td>
                                    @if ($employee->image != '' && file_exists(public_path() . '/uploads/employees/' . $employee->image))
                                        <img src="{{ url('uploads/employees/' . $employee->image) }}" alt=""
                                            width="40" height="40" class="rounded-circle">
                                    @else
                                        <img src="{{ url('assets/images/noImage.jpg') }}" alt="" width="40"
                                            height="40" class="rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                        @csrf
                                        @method('delete')

                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Record Not Found</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="mt-2">
            {{ $employees->links() }}
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>

<script>
    function deleteEmployee(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementbyId('employeeDeleteAction' + id).submit();
        }
    }
</script>
