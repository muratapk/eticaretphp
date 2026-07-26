<div class="container">
    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5 col-lg-4">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Giriş Yap</h3>

                    <form action="login_save.php" method="post">

                        <div class="mb-3">
                            <label class="form-label">Email Adresiniz</label>
                            <input type="text" name="email" class="form-control" placeholder="Kullanıcı Adı" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password" name="password" class="form-control" placeholder="Şifre" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" name="beniHatirla" type="checkbox" id="beniHatirla">
                            <label class="form-check-label" for="beniHatirla">
                                Beni Hatırla
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Giriş Yap
                            </button>
                        </div>

                    </form>

                    <hr>

                    <div class="text-center">
                        <a href="#">Şifremi Unuttum</a>
                    </div>

                    <div class="text-center mt-2">
                        Hesabınız yok mu?
                        <a href="kullanici_kayit.php">Kayıt Ol</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>