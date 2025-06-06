// Sidebar.jsx
"use client";

import { Menu } from "antd";
import {
  DashboardOutlined,
  BoxPlotOutlined,
  ShoppingOutlined,
  FileTextOutlined,
  SettingOutlined,
} from "@ant-design/icons";
import Link from "next/link";
import { usePathname } from "next/navigation";

const navItems = [
  { key: "/", icon: <DashboardOutlined />, label: "Tổng quan" },
  { key: "/customer", icon: <DashboardOutlined />, label: "Khách hàng" },
  { key: "/product", icon: <BoxPlotOutlined />, label: "Sản phẩm" },
  { key: "/user", icon: <ShoppingOutlined />, label: "Nhân viên" },
  { key: "/xuat-kho", icon: <ShoppingOutlined />, label: "Xuất kho" },
  { key: "/report", icon: <FileTextOutlined />, label: "Báo cáo" },
  { key: "/setting", icon: <SettingOutlined />, label: "Cài đặt" },
];

export default function Sidebar({ collapsed }) {
  const pathname = usePathname();

  return (
    <Menu
      theme="dark"
      mode="inline"
      selectedKeys={[pathname]}
      inlineCollapsed={collapsed}
      items={navItems.map(({ key, icon, label }) => ({
        key,
        icon,
        label: <Link href={key}>{label}</Link>,
      }))}
    />
  );
}
