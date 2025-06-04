// middleware.js
import { NextResponse } from "next/server";

export function middleware(req) {
  const token = req.cookies.get("token"); // Hoặc lấy từ cookie
  const { pathname } = req.nextUrl;

  // Các route không cần auth
  const publicPaths = ["/", "/login"];

  if (!publicPaths.includes(pathname) && !token) {
    return NextResponse.redirect(new URL("/login", req.url));
  }

  return NextResponse.next();
}

export const config = {
  matcher: ["/dashboard/:path*"], // áp dụng middleware cho các đường dẫn dashboard, ... cần bảo vệ
};
