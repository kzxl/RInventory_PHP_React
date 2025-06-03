export default function Navbar() {  // đổi tên hàm cho đúng với export
  return (
    <nav id="sidebar">
      <div className="sidebar_blog_1">
        <div className="sidebar-header">
          <div className="logo_section">
            <a href="#">
              <img
                className="logo_icon img-responsive"
                src="/images/logo/logo_icon.png"
                alt="Logo"
              />
            </a>
          </div>
        </div>
        <div className="sidebar_user_info_custom">
          <div className="user_profile_side">
            <div className="logo_section">
              <a href="#">
                <img
                  className="img-responsive"
                  src="/images/logo/logo.png"
                  alt="User"
                />
              </a>
            </div>
          </div>
        </div>
      </div>
      <div className="sidebar_blog_2">
        <ul className="list-unstyled components">
          {/* Bạn có thể thêm menu ở đây */}
        </ul>
      </div>
      <div className="footer-custom">
        <p>&copy; {new Date().getFullYear()}</p>
        <p></p>
      </div>
    </nav>
  );
}
