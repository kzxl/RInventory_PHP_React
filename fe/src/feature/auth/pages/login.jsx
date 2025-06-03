import { useState, useEffect } from "react";
import md5 from "md5";

const Login = () => {

  const [auth, setAuth] = useState({ username: "", password: "" });
  const [rememberMe, setRememberMe] = useState(false);
  const [authError, setAuthError] = useState(null);

  useEffect(() => {
    const storedUsername = localStorage.getItem("username");
    const storedPassword = localStorage.getItem("password");
    const storedRememberMe = localStorage.getItem("remember_me") === "true";

    if (storedRememberMe && storedUsername && storedPassword) {
      setAuth({
        username: storedUsername,
        password: storedPassword,
      });
      setRememberMe(true);
    }
  }, []);

  const enterTriggered = (e) => {
    if (e.keyCode === 13) {
      submit(e);
    }
  };

  const submit = async (e) => {
    e.preventDefault();
    setAuthError(null);

    try {
      const response = await fetch(`/auth/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          account: {
            username: auth.username,
            password: md5(auth.password),
          },
        }),
      });

      const data = await response.json();

      if (data.success) {
        const userData = data.user || {
          username: auth.username,
          fullname: data.fullname || "",
          token: data.token,
        };

        //dispatch(login(userData));

        if (rememberMe) {
          localStorage.setItem("username", auth.username);
          localStorage.setItem("password", auth.password);
          localStorage.setItem("remember_me", "true");
        } else {
          localStorage.removeItem("username");
          localStorage.removeItem("password");
          localStorage.removeItem("remember_me");
        }

        localStorage.setItem("_token", JSON.stringify(data.token));
        localStorage.setItem("user", JSON.stringify(userData));
        window.location.href = "/";
      } else {
        setAuthError("Sai tài khoản hoặc mật khẩu");
      }
    } catch (err) {
      console.error(err);
      setAuthError("Lỗi hệ thống, vui lòng thử lại.");
    }
  };

  return (
    <div className="inner_page login">
      <div className="full_container">
        <div className="container">
          <div className="center verticle_center full_height">
            <div className="login_section">
              <div className="logo_login">
                <div className="center">
                  <img
                    width={280}
                    height={50}
                    src="images/logo/logo.png"
                    alt="Logo"
                  />
                </div>
              </div>
              <div className="login_form">
                <form>
                  <fieldset>
                    <div className="field">
                      {authError && (
                        <div className="row">
                          <div className="col-md-4"></div>
                          <div className="col-md-8" style={{ height: "25px" }}>
                            <span className="error-message error-login">
                              {authError}
                            </span>
                          </div>
                        </div>
                      )}
                    </div>
                    <div className="field">
                      <div className="row">
                        <div className="col-md-4">
                          <label className="label_field">Tài khoản</label>
                        </div>
                        <div className="col-md-8">
                          <input
                            type="text"
                            placeholder="Tên đăng nhập"
                            onKeyUp={enterTriggered}
                            value={auth.username}
                            onChange={(e) =>
                              setAuth({ ...auth, username: e.target.value })
                            }
                          />
                        </div>
                      </div>
                    </div>
                    <div className="field">
                      <div className="row">
                        <div className="col-md-4">
                          <label className="label_field">Mật khẩu</label>
                        </div>
                        <div className="col-md-8">
                          <input
                            type="password"
                            placeholder="Mật khẩu"
                            onKeyUp={enterTriggered}
                            value={auth.password}
                            onChange={(e) =>
                              setAuth({ ...auth, password: e.target.value })
                            }
                          />
                        </div>
                      </div>
                    </div>
                    <div className="field">
                      <label className="form-check-label">
                        <input
                          type="checkbox"
                          checked={rememberMe}
                          onChange={(e) => setRememberMe(e.target.checked)}
                          className="form-check-input"
                        />
                        {" "}Ghi nhớ đăng nhập
                      </label>
                    </div>
                    <div className="field margin_0">
                      <button onClick={submit} className="main_bt">
                        Đăng nhập
                      </button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;
