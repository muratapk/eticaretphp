<div class="container">
    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Kayıt Ol</h3>

                    <form action="register_save.php" method="post">

                        <div class="mb-3">
                            <label class="form-label">Adınız</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Ad Soyad" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Soyadınız</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Kullanıcı Adı"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-Posta</label>
                            <input type="email" name="email" class="form-control" placeholder="ornek@mail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control" placeholder="Telefon numarası"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password" name="password" class="form-control" placeholder="Şifrenizi giriniz"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Şifre Tekrar</label>
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Şifrenizi tekrar giriniz" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="sozlesme" required>

                            <label class="form-check-label" for="sozlesme">
                                Kullanım şartlarını okudum ve kabul ediyorum.
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Kayıt Ol
                            </button>
                        </div>

                    </form>

                    <hr>

                    <div class="text-center">
                        Zaten hesabınız var mı?
                        <a href="kullanici.php">Giriş Yap</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>