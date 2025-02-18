<!-- register.html -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
</head>
<body>
    <h1>Đăng Ký</h1>
    <form id="registerForm">
        <input type="text" id="name" placeholder="Tên" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Mật khẩu" required>
        <input type="password" id="password_confirmation" placeholder="Xác nhận mật khẩu" required>
        <button type="submit">Đăng Ký</button>
    </form>
    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const response = await fetch('/api/v1/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password_confirmation').value
                })
            });
            const data = await response.json();
            if (response.ok) {
                alert(data.message);
                window.location.href = '/login'; // Chuyển hướng đến trang đăng nhập
            } else {
                alert(JSON.stringify(data.errors));
            }
        });
    </script>
</body>
</html>