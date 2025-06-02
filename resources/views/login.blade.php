<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan Nasabah | Bank Fadilah</title>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <!-- Ganti dengan logo Bank Fadilah yang sebenarnya -->
            <img src="assets/logo-bank-fadilah.png" alt="Bank Fadilah Logo">
            <h1>SISTEM PENGADUAN NASABAH</h1>
            <p>Masukkan akun Anda untuk mengakses sistem</p>
        </div>

        <form id="loginForm">
            <div class="input-group">
                <label for="username">Username / Nomor Rekening</label>
                <input type="text" id="username" placeholder="Masukkan username atau nomor rekening" required>
                <span class="icon">👤</span>
                <div class="error-message" id="username-error">Username tidak valid</div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Masukkan password" required>
                <span class="icon">🔒</span>
                <div class="error-message" id="password-error">Password minimal 6 karakter</div>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Ingat saya
                </label>
                <a href="#">Lupa password?</a>
            </div>

            <button type="submit">MASUK</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="#">Daftar sekarang</a>
        </div>
    </div>
        @vite('resources/css/login.css')
        

</body>
</html>