import { cookies } from "next/headers";
import { redirect } from "next/navigation";

export default function Home() {
  // Giả sử token hoặc cookie tên 'token' dùng để kiểm tra đăng nhập
  const cookieStore = cookies();
  const token = cookieStore.get("token");

  if (!token) {
    // Chưa đăng nhập, redirect tới /login
    redirect("/login");
  } else {
    // Đã đăng nhập, redirect tới /dashboard
    redirect("/dashboard");
  }

  return null; // Không cần render gì ở đây vì redirect rồi
}
