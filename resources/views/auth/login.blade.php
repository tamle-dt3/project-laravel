<!-- login.html -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<body>
    <h1>Đăng Nhập</h1>
    <form id="loginForm">
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng Nhập</button>
    </form>
    
    <p>Chưa có tài khoản? <a href="/register" id="registerLink">Đăng ký ngay!</a></p>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const response = await fetch('/api/v1/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value
                })
            });
            const data = await response.json();
            if (response.ok) {
                alert(data.message);
                localStorage.setItem('access_token', data.access_token); // Lưu token vào localStorage
                window.location.href = '/home'; // Chuyển hướng đến trang chính
            } else {
                alert(data.error);
            }
        });
    </script>
</body>
</html>