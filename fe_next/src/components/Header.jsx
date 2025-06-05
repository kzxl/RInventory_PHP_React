'use client'

import { Layout, Input, Badge, Avatar, Dropdown, Menu, Button, Row } from 'antd'
import { BellOutlined, UserOutlined, LogoutOutlined, MenuOutlined } from '@ant-design/icons'

const { Header } = Layout
const { Search } = Input

export default function AppHeader({ collapsed, onToggleSidebar }) {
  const userMenu = (
    <Menu
      items={[
        { key: 'profile', label: 'Thông tin cá nhân', icon: <UserOutlined /> },
        { key: 'logout', label: 'Đăng xuất', icon: <LogoutOutlined /> },
      ]}
    />
  )

  return (
    <Header
      className="bg-white flex items-center justify-between px-4 shadow-sm"
      style={{ height: 64, paddingRight: 24, paddingLeft: 24 }}
    >
      <div className="flex items-center gap-4">
        {/* Nút toggle sidebar cho mobile */}
        <Button
          type="text"
          icon={<MenuOutlined />}
          className="md:hidden"
          onClick={onToggleSidebar}
          aria-label="Toggle sidebar"
        />

        {/* Logo / tên (ẩn trên mobile khi sidebar thu gọn) */}
        <div className="hidden md:block text-xl font-bold text-blue-700 select-none">
          KhoPro
        </div>
      </div>

      {/* Có thể bỏ hoặc thu gọn thanh tìm kiếm */}
      {/* Nếu muốn giữ, bạn có thể đặt flex-grow ở giữa, hoặc bỏ */}
      {/* <div className="hidden md:block flex-1 mx-6 max-w-md">
        <Search placeholder="Tìm kiếm sản phẩm, đơn hàng..." allowClear />
      </div> */}

      <div className="flex items-center gap-4">
        {/* Icon thông báo */}
        <Badge count={3} size="small" offset={[0, 0]}>
          <BellOutlined style={{ fontSize: 20, cursor: 'pointer' }} />
        </Badge>

        {/* Avatar user + dropdown */}
        <Dropdown overlay={userMenu} placement="bottomRight" arrow>
          <Avatar
            size="large"
            icon={<UserOutlined />}
            style={{ cursor: 'pointer' }}
          />
        </Dropdown>
      </div>      
    </Header>
  )
}
