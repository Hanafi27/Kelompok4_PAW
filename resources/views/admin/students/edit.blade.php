<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="editForm" method="POST" action="{{ route('admin.students.update', ['user' => '__userId__']) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="editId">
                <div class="form-group">
                    <label for="editName">Nama:</label>
                    <input type="text" class="form-control" id="editName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" class="form-control" id="editEmail" name="email" required>
                </div>
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="form-group">
                        <label for="editRole">Peran:</label>
                        <select name="role" id="editRole" class="form-control" required>
                            <option value="user">Pengguna</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
</div>
