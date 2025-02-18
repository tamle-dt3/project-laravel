<!-- home.html -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>
</head>
<body>
    <h1>Chào mừng đến với trang chính!</h1>
    <button id="logout">Đăng Xuất</button>
    <script>
        document.getElementById('logout').addEventListener('click', async function() {
            const response = await fetch('/api/v1/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                    'Content-Type': 'application/json',
                }
            });
            if (response.ok) {
                alert('Đăng xuất thành công');
                localStorage.removeItem('access_token');
                window.location.href = '/login';
            } else {
                alert('Đăng xuất thất bại');
            }
        });
    </script>
</body>
</html>