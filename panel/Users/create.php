<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Kullanıcı Kayıt Formu</h3>
                </div>

                <div class="card-body">
                    <form action="main.php?page=Users&action=save" method="POST">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    maxlength="100" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" maxlength="100"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="255">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" maxlength="20" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Şifre Tekrar</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select class="form-select" id="role" name="role">
                                <option value="customer" selected>Müşteri</option>
                                <option value="restaurant_owner">Restoran Sahibi</option>
                                <option value="courier">Kurye</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                checked>
                            <label class="form-check-label" for="is_active">
                                Hesap Aktif
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Kaydet
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>