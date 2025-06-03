import { useEffect } from "react";
import { useSelector } from "react-redux";

const SignOut = () => {
  
  useEffect(() => {
    
    localStorage.removeItem("_token");
    localStorage.removeItem("password_hash");
    localStorage.removeItem("user");
    localStorage.removeItem("selectedCaseDetail");
    localStorage.setItem("user", JSON.stringify({}));

    // Delay để đảm bảo mọi thứ đã xong trước khi redirect
    setTimeout(() => {
      window.location.href = "/login";
    }, 300);
  }, []);

  return (
    <div style={{ padding: "2rem", textAlign: "center" }}>
      <p>Đang đăng xuất...</p>
    </div>
  );
};

export default SignOut;
