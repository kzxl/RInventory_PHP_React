import { Card } from "antd";

const WhitePanel = ({ children, style, bodyStyle }) => {
  return (
    <Card
      style={{
        background: "#fff",
        width: "100%",
        border: "1px solid #d0d0d0",
        ...style,
      }}
      bodyStyle={{ padding: 16, ...bodyStyle }}>
      {children}
    </Card>
  );
};

export default WhitePanel;
