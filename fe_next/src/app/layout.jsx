'use client'

import 'antd/dist/reset.css'
import { useState, useEffect } from 'react'
import { Layout, Grid, theme  } from 'antd'
import Sidebar from '@/components/Sidebar'
import AppHeader from '@/components/Header'

const { Header, Sider, Content,Footer } = Layout
const { useBreakpoint } = Grid

export default function RootLayout({ children }) {
  const [collapsed, setCollapsed] = useState(false)
  const screens = useBreakpoint()

  // Mặc định collapse sidebar nếu màn hình nhỏ
  useEffect(() => {
    if (!screens.md) {
      setCollapsed(true)
    } else {
      setCollapsed(false)
    }
  }, [screens])

  // Toggle collapse sidebar
  const toggleCollapsed = () => {
    setCollapsed(!collapsed)
  }

  return (
    <html lang="vi">
      <body>
        <Layout style={{height:"100hv"}}>  
          <Sider
              
              collapsed={collapsed}
              onCollapse={setCollapsed}
              breakpoint="lg"
              collapsedWidth={screens.md ? 80 : 0}
              
              style={{ background: '#001529' }}
              
            >
              <Sidebar collapsed={collapsed} />
            </Sider>
          <Layout>
          <Header
            style={{ padding: '0', background: '#fff'}}
          >
            <AppHeader collapsed={collapsed} onToggleSidebar={toggleCollapsed} />
          </Header>
            <Content  style={{   margin: '24px 16px 0'      }} >  
            <div
            style={{
              padding: 24,
              minHeight: 360,
              background: "#fff",
              borderRadius: 30,
            }}
          >        
              {children}
              </div> 
            </Content>
            <Footer style={{ textAlign: 'center' }}>
          Thanh Đồng Composite ©{new Date().getFullYear()}
        </Footer>
          </Layout>
        </Layout>
      </body>
    </html>
  )
}
