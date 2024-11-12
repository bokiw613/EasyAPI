@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden; /* Prevent scrollbars */
    }

    .centered-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 100vh; /* Ensure the container takes full viewport height */
    }

    .full-width-row {
        width: 100%; /* Ensure row takes full width */
        margin: 0; /* Remove default margin */
    }

    .role-edit-card {
        width: 100%; /* Full width of its parent */
        max-width: 800px; /* Adjust as needed */
        margin: 0 auto; /* Center align horizontally */
        padding: 20px; /* Add padding for inner spacing */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Optional: Add shadow for better visibility */
        border-radius: 8px; /* Optional: Rounded corners */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    @media (min-width: 992px) {
        .role-edit-card {
        width: 100%; /* Full width of its parent */
        max-width: 800px; /* Adjust as needed */
        margin-top:-10px;
    }
    }

    .permissions-list-container {
        max-height: 200px; /* Adjust height as needed */
        overflow-y: auto; /* Ensure scrolling only for content overflow */
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        width: 100%; /* Make the list take full width */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    .permission-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .permission-checkbox {
        margin-right: 10px;
        transform: scale(1.2); /* Membuat checkbox lebih besar */
    }

    .permission-label {
        font-size: 16px;
        color: #495057;
    }

    .form-group {
        margin-bottom: 1.5rem; /* Spacing between form elements */
    }

    .submit-button {
        margin-top: 20px; /* Add space above the button */
    }
</style>

<div class="centered-container">
    <div class="full-width-row justify-content-center">
        <div class="col-md-12">
            <div class="card role-edit-card">
                <div class="card-header">Edit Peran</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="role-form" action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class='form-group'>
                            <label for="name">Nama Peran</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="permissions">Izin</label>
                            <div id="permissions-list" class="permissions-list-container">
                                @foreach ($permissions as $permission)
                                    <div class="form-check permission-item">
                                        <input type="checkbox" class="form-check-input permission-checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label permission-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary submit-button">Perbarui Peran</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-primary mt-3">Kembali Ke Peran</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initial population of the selected permissions
        $('input.permission-checkbox:checked').each(function() {
            let permissionId = $(this).val();
            let permissionName = $(this).siblings('label').text();

            $('#selected-permissions').append(
                '<li data-id="' + permissionId + '">' + permissionName + 
                ' <span class="remove-permission">&times;</span></li>'
            );
        });

        // When a permission checkbox is clicked
        $('.permission-checkbox').on('change', function() {
            let permissionId = $(this).val();
            let permissionName = $(this).siblings('label').text();

            if ($(this).is(':checked')) {
                // Add to selected permissions list
                $('#selected-permissions').append(
                    '<li data-id="' + permissionId + '">' + permissionName + 
                    ' <span class="remove-permission">&times;</span></li>'
                );
            } else {
                // Remove from the selected permissions list
                $('#selected-permissions li[data-id="' + permissionId + '"]').remove();
            }
        });

        // When a permission is removed by clicking the "X"
        $(document).on('click', '.remove-permission', function() {
            let permissionId = $(this).parent().attr('data-id');

            // Uncheck the corresponding checkbox
            $('#permission' + permissionId).prop('checked', false);

            // Remove from the selected permissions list
            $(this).parent().remove();
        });

        // Form submission handler
        $('#role-form').on('submit', function(e) {
            e.preventDefault();

            // Prepare the form data including selected permissions
            let formData = $(this).serializeArray();
            let selectedPermissions = $('#selected-permissions li').map(function() {
                return $(this).attr('data-id');
            }).get();

            formData.push({ name: 'permissions', value: selectedPermissions });

            // Send the data to the server via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle successful update
                    alert('Role updated successfully!');
                    window.location.href = '{{ route("roles.index") }}';
                },
                error: function(xhr) {
                    // Handle errors
                    alert('An error occurred while updating the role.');
                }
            });
        });
    });
</script>
@endsection
