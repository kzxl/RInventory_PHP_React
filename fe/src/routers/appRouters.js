import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from "react-router-dom";

import { Login, SignOut, ChangePassword } from "../feature/auth/pages";
import { Navigation } from "../feature/navigation/pages";
import { UnAuthorized, NotFound } from "../pages/error";

const AppRouter = () => {
  const isLoggedIn=true
  return (
    <Router>
      <Routes>
        {/* Trang login chỉ cho người chưa đăng nhập */}
        {/* <Route
          path="/login"
          element={!isLoggedIn ? <Login /> : <Navigate to="/" replace />}
        />
        {/* Trang đăng xuất *}
        <Route path="/signout" element={<SignOut />} />
        
        {/* Trang thay đổi mật khẩu, chỉ cho người đăng nhập *}
        <Route
          path="/changepassword"
          element={
            isLoggedIn ? (
              <Navigation Child={ChangePassword} />
            ) : (
              <Navigate to="/login" replace />
            )
          }
        />

        {/* Trang lỗi *}
        <Route path="/unauthorized" element={<UnAuthorized />} />
        <Route path="*" element={<NotFound />} /> */}
      </Routes>
    </Router>
  );
};

export default AppRouter;
