'use client'

import { useEffect, useState } from 'react';
import BaseTable from "@/components/BaseTable";
import { Button, Row,Input, Switch, Form } from "antd";
import { UserService } from './service/userService';
import BaseModalForm from '@/components/modal/BaseFormModal';

export default function UserPage() { 
  const [users, setUsers] = useState([]);
  const [openModal, setOpenModal] = useState(false);
  const [editUser, setEditUser] = useState(null);
  
  const columns = [
  { title: 'Tên nhân viên', dataIndex: 'full_name', key: 'full_name' },
  { title: 'Email', dataIndex: 'email', key: 'email' },
  { title: 'Số điện thoại', dataIndex: 'phone', key: 'phone' },
  { title: 'Trạng thái hoạt động', dataIndex: 'is_active', key: 'is_active' },
  {
    title: 'Hành động',
    key: 'action',
    render: (_, record) => (
      <>
        <Button onClick={() => { setEditUser(record); setOpenModal(true); }}>Sửa</Button>
        <Button danger type="link" onClick={() => console.log('Xoá', record)}>Xoá</Button>
      </>
    ),
  },
];

const loadData = async () => {
    const data = await UserService.getAllUsers();
    setUsers(data);
  };

  useEffect(() => {
    loadData();
  }, []);

  const handleSubmit = async (formData) => {
    if (editUser) {
      await UserService.updateUser(editUser.id, formData);
    } else {
      await UserService.createUser(formData);
    }
    setOpenModal(false);
    setEditUser(null);
    loadData();
  };

  return (
    <div className="p-4">
      <Button type="primary" onClick={() => setOpenModal(true)}>Thêm user</Button>
      <div style={{padding:5}}/>
      <BaseTable data={users} columns={columns} />
    
    <BaseModalForm
        title={editUser ? 'Cập nhật user' : 'Thêm user'}
        open={openModal}
        onClose={() => { setOpenModal(false); setEditUser(null); }}
        onSubmit={handleSubmit}
        initialValues={editUser || { is_active: true }}
      >
        <Form.Item name="full_name" label="Họ tên" rules={[{ required: true }]}>
          <Input />
        </Form.Item>
        <Form.Item name="email" label="Email" rules={[{ required: true, type: 'email' }]}>
          <Input />
        </Form.Item>
        <Form.Item name="phone" label="SĐT">
          <Input />
        </Form.Item>
        <Form.Item name="is_active" label="Kích hoạt" valuePropName="checked">
          <Switch />
        </Form.Item>
        {!editUser && (
          <Form.Item name="password" label="Mật khẩu" rules={[{ required: true }]}>
            <Input.Password />
          </Form.Item>
        )}
      </BaseModalForm>
    </div>
  );
}