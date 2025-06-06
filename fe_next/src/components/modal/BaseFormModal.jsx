'use client';

import { Modal, Form } from 'antd';
import { useEffect } from 'react';

export default function BaseModalForm({
  title,
  open,
  onClose,
  onSubmit,
  initialValues = {},
  children,
  okText = 'Lưu',
  cancelText = 'Hủy',
}) {
  const [form] = Form.useForm();

  useEffect(() => {
    if (open) {
      form.setFieldsValue(initialValues);
    } else {
      form.resetFields();
    }
  }, [open, initialValues, form]);

  const handleOk = async () => {
    try {
      const values = await form.validateFields();
      await onSubmit(values);
      form.resetFields();
    } catch (error) {
      console.log('Lỗi validate:', error);
    }
  };

  return (
    <Modal
      open={open}
      title={title}
      onCancel={onClose}
      onOk={handleOk}
      okText={okText}
      cancelText={cancelText}
    >
      <Form form={form} layout="vertical">
        {children}
      </Form>
    </Modal>
  );
}
