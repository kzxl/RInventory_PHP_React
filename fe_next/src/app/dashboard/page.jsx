import { redirect } from "next/navigation";

// Hàm kiểm tra token (fake)
function checkAuth() {
  if (typeof window === "undefined") return false; // SSR không có localStorage
  return !!localStorage.getItem("token");
}

export default function DashboardPage() {
  if (!checkAuth()) {
    redirect("/login"); // Nếu chưa đăng nhập, redirect về login
  }

  return <h2>Dashboard - Protected Page</h2>;
}
