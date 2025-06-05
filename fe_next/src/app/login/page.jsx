import { Card, Typography } from "antd";
import LoginForm from "../../components/LoginForm";
const { Title } = Typography;

export default function LoginPage() {
  return (
    <div className="login-container">
      <Card className="login-card">
        <h2>Login</h2>
        <LoginForm />
      </Card>
    </div>
  );
}
