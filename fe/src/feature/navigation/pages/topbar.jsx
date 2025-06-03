import { useEffect, useRef } from "react";
import { useSelector } from "react-redux";

const Topbar = () => {
  const topbarRef = useRef();

  useEffect(() => {
    if (topbarRef.current) {
      localStorage.setItem("topbarHeight", topbarRef.current.clientHeight);
    }
  }, []);
const user=null;
  const signOut = () => {
    window.location = "/signout";
  };

  return (
    <div className="topbar" id="topbaritem" ref={topbarRef}>
      <nav className="bg-cus navbar navbar-expand-lg navbar-light">
        <div className="full d-flex flex-row">
          <button type="button" id="sidebarCollapse" className="sidebar_toggle">
            <i className="fa fa-bars"></i>
          </button>

          <div className="d-flex flex-nowrap">
            <div className="icon_info">
              <ul className="user_profile_dd" title={user?.fullname || ""}>
                <li>
                  <a className="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span className="name_user">{user?.fullname || "Người dùng"}</span>
                  </a>
                  <div className="dropdown-menu">
                    <a className="dropdown-item" href="/users/profile">
                      Thông tin người dùng
                    </a>
                    <a className="dropdown-item" href="/changepassword">
                      Đổi mật khẩu
                    </a>
                    <a className="dropdown-item" href="#" onClick={signOut}>
                      Đăng xuất
                    </a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  );
};

export default Topbar;
