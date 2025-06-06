// components/BaseTable.js
import { Table } from 'antd';

const BaseTable = ({
  columns = [],
  data = [],
  loading = false,
  rowKey = 'id',
  pagination = { pageSize: 10 },
  onRowClick,
  onChange,
}) => {
  return (
    <Table
      columns={columns}
      dataSource={data}
      rowKey={rowKey}
      loading={loading}
      pagination={pagination}
      bordered
      onRow={record =>
        onRowClick
          ? {
              onClick: () => onRowClick(record),
            }
          : {}
      }
      onChange={onChange} // hỗ trợ sort, filter về sau
    />
  );
};

export default BaseTable;