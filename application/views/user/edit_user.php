<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= validation_errors(); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('user/edit/' . $user['id']); ?>" method="post" id="formEditUser">
                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" 
                                   placeholder="Masukkan username" value="<?= set_value('username', $user['username']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Masukkan nama lengkap" value="<?= set_value('name', $user['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Masukkan email" value="<?= set_value('email', $user['email']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="text-muted">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" name="password" id="password" class="form-control" 
                                   placeholder="Masukkan password baru (minimal 6 karakter)">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>

                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role; ?>" 
                                            <?= set_select('role', $role, $user['role'] == $role); ?>>
                                        <?= ucfirst($role); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="<?= site_url('user'); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#formEditUser').jvalidate({
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 6
            },
            role: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Username wajib diisi",
                minlength: "Username minimal 3 karakter"
            },
            name: {
                required: "Nama lengkap wajib diisi",
                minlength: "Nama minimal 3 karakter"
            },
            email: {
                required: "Email wajib diisi",
                email: "Format email tidak valid"
            },
            password: {
                minlength: "Password minimal 6 karakter"
            },
            role: {
                required: "Role wajib dipilih"
            }
        }
    });
});
</script>
