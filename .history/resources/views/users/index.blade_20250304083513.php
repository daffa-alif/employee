@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar User</h2>
    
    <!-- Tombol Tambah -->
    <button id="createUser" class="btn btn-primary mb-3">Tambah User</button>

    <!-- Tabel Users -->
    <table class="table table-bordered" id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="userForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah/Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select id="role" class="form-control">
                            <option value="user">User</option>
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">SuperAdmin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    let table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'role' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    $('#createUser').click(function () {
        $('#userModal').modal('show');
        $('#userForm')[0].reset();
        $('#user_id').val('');
    });

    $('#userForm').submit(function (e) {
        e.preventDefault();
        let id = $('#user_id').val();
        let url = id ? `/users/${id}` : "{{ route('users.store') }}";
        let type = id ? 'PUT' : 'POST';
        let data = {
            name: $('#name').val(),
            email: $('#email').val(),
            role: $('#role').val(),
        };
        if (!id) data.password = $('#password').val();

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function () {
                $('#userModal').modal('hide');
                table.ajax.reload();
            }
        });
    });

    $('#usersTable').on('click', '.edit', function () {
        let id = $(this).data('id');
        $.get(`/users/${id}/edit`, function (data) {
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#role').val(data.role);
            $('#userModal').modal('show');
        });
    });

    $('#usersTable').on('click', '.delete', function () {
        let id = $(this).data('id');
        if (confirm('Yakin ingin menghapus user ini?')) {
            $.ajax({
                url: `/users/${id}`,
                type: 'DELETE',
                success: function () {
                    table.ajax.reload();
                }
            });
        }
    });
});
</script>
@endsection
