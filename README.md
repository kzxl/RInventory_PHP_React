# RInventory - PHP + React (Next.js)

Hệ thống quản lý kho đơn giản, dễ mở rộng, sử dụng:

- **Slim Framework** cho RESTful API (PHP Backend)
- **Next.js (React)** cho giao diện người dùng (Frontend)
- **MySQL** làm cơ sở dữ liệu chính

## 🌟 Tính năng chính

- Quản lý nhập kho, xuất kho, tồn kho
- Quản lý khách hàng, người dùng
- Giao diện hiện đại, responsive (Next.js)
- API gọn nhẹ, rõ ràng theo RESTful (Slim PHP)
- Cấu trúc backend theo Repository + Service Pattern

---

## 📁 Cấu trúc thư mục

RInventory_PHP_React/
├── backend/ # Slim PHP API
│ ├── public/ # entrypoint index.php
│ ├── src/
│ │ ├── Controllers/
│ │ ├── Services/
│ │ ├── Repositories/
│ │ └── ...
│ ├── routes/
│ ├── config/
│ └── ...
├── frontend/ # Next.js UI
│ ├── pages/
│ ├── components/
│ ├── services/ # API client
│ └── ...
├── README.md


---

## 🚀 Cài đặt nhanh

### 🖥 Backend (Slim PHP)

```bash
cd backend
composer install
cp .env.example .env
# Cập nhật thông tin DB trong .env
php -S localhost:8000 -t public

🌐 Frontend (Next.js)

cd frontend
npm install
cp .env.local.example .env.local
# Cập nhật API_URL trong .env.local
npm run dev

🔐 Authentication

    API hỗ trợ login/logout (JWT hoặc session tùy chọn)

    Đăng nhập sẽ trả về token lưu localStorage để gọi API tiếp theo

📦 API endpoints mẫu

POST /api/login
POST /api/logout

POST /api/user/findall
POST /api/customer/create
POST /api/customer/update/{id}
POST /api/customer/delete/{id}

🛠 Công nghệ sử dụng
Layer	Tech
Frontend	React + Next.js
Backend	Slim Framework
DB	MySQL
Auth	JWT / Session
Style FE	Tailwind CSS
API Call	Axios
🤝 Góp ý & Phát triển

    Đóng góp bằng cách tạo issue hoặc pull request

    Chào mừng mọi ý tưởng mở rộng: báo cáo, export excel, phân quyền...
