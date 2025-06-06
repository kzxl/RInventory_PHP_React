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
        <Layout style={{height:"100%"}}>  
          <Sider     
              width={300}         
              collapsed={collapsed}
              onCollapse={setCollapsed}
              breakpoint="lg"
              collapsedWidth={screens.md ? 80 : 0}              
              style={{ background: '#001529' }}              
            >
              <Sidebar collapsed={collapsed} />
            </Sider>
          <Layout>
          <Header            style={{ padding: '0', background: '#fff'}}
          >
            <AppHeader collapsed={collapsed} onToggleSidebar={toggleCollapsed} />
          </Header>          
            <Content style={{margin: '15px 10px 10px 10px'} } >  
            <div
            style={{
              
              padding: 5,
              minHeight: 360,
              background: "#fff",
              borderRadius: 10,
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
