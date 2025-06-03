import { useState, useEffect } from "react";
import { useSelector } from "react-redux";
import Swal from "sweetalert2";
import md5 from "md5";

export default () => {  
  const _token = localStorage.getItem("_token");
  const storedPwdString = localStorage.getItem("password_hash");
  const [editUser, setEditUser]  = useState({});
  const [errorMessages, setErrorMessages]  = useState({});
  const [statusActive, setStatusActive]  = useState(false);

  useEffect(() => {
    fetch(`/auth/activation/check`, {
      headers: {
        Authorization: _token,
      },
    })
      .then((res) => res.json())
      .then((resp) => {
        if (resp.activated) {
          setStatusActive(true);
        } else {
          Swal.fire({
            title:  "faild" ,
            text:  "fail.active" ,
            icon: "error",
          });
        }
      });
  }, [] );

  const submitUpdate = (e) => {
    e.preventDefault();
    const errors = {};

    const oldPwd = editUser.oldPassword || "";
    const newPwd = editUser.newPassword || "";
    const rePwd = editUser.rePassword || "";

    if (!oldPwd) errors.oldPassword =  "error.input" ;
    else if (md5(oldPwd) !== storedPwdString)
      errors.oldPassword =  "wrong password" ;

    if (!newPwd) errors.newPassword =  "error.input" ;
    if (!rePwd) errors.rePassword =  "error.input" ;

    if (oldPwd && newPwd && oldPwd === newPwd)
      errors.duPassword =  "duPassword" ;
    if (newPwd && rePwd && newPwd !== rePwd)
      errors.validPassword =  "validPassword" ;

    if (Object.keys(errors).length > 0) {
      setErrorMessages(errors);
      return;
    }

    fetch(`/auth/changePwd`, {
      method: "POST",
      headers: {
        "content-type": "application/json",
        Authorization: _token,
      },
      body: JSON.stringify({
        account: {
          username: "",
          oldPassword: oldPwd,
          newPassword: newPwd,
        },
      }),
    })
      .then((res) => res.json())
      .then(({ success }) => {
        if (success) {
          Swal.fire({
            title:  "success" ,
            text:  "success.password" ,
            icon: "success",
            confirmButtonText:  "confirm" ,
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/signout";
            }
          });
        } else {
          Swal.fire({
            title: "error",
            text:  "failed.password" ,
            icon: "error",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      });
  };

  if (!statusActive) return null;

  return (
    <div className="midde_cont">
      <div className="container-fluid">
        <div className="row column_title">
          <div className="col-md-12">
            <div className="page_title">
              <h4>{ "profile" }</h4>
            </div>
          </div>
        </div>

        <div className="row column1">
          <div className="col-md-12">
            <div className="white_shd full">
              <div className="full graph_head d-flex justify-content-between align-items-center">
                <div className="heading1 margin_0">
                  <h5>{ "change password" }</h5>
                </div>
              </div>

              <div
                className="full price_table padding_infor_info"
                style={{ height: "80vh" }}
              >
                <div className="container mt-3">
                  <div className="row justify-content-center">
                    <div className="form-group col-lg-6">
                      <label>{ "username" }</label>
                      <input
                        type="text"
                        className="form-control"
                        value={""}
                        readOnly
                      />
                    </div>

                    <div className="form-group col-lg-6">
                      <label>
                        { "old password" }{" "}
                        <span className="red_star ml-1">*</span>
                      </label>
                      <input
                        type="password"
                        className="form-control"
                        value={editUser.oldPassword || ""}
                        onChange={(e) =>
                          setEditUser({
                            ...editUser,
                            oldPassword: e.target.value,
                          })
                        }
                        placeholder={ "p.old password" }
                      />
                      {errorMessages.oldPassword && (
                        <span className="error-message">
                          {errorMessages.oldPassword}
                        </span>
                      )}
                    </div>

                    <div className="form-group col-lg-6">
                      <label>
                        { "new password" }{" "}
                        <span className="red_star ml-1">*</span>
                      </label>
                      <input
                        type="password"
                        className="form-control"
                        value={editUser.newPassword || ""}
                        onChange={(e) =>
                          setEditUser({
                            ...editUser,
                            newPassword: e.target.value,
                          })
                        }
                        placeholder={ "p.new password" }
                      />
                      {errorMessages.newPassword && (
                        <span className="error-message">
                          {errorMessages.newPassword}
                        </span>
                      )}
                      {errorMessages.duPassword && (
                        <span className="error-message">
                          {errorMessages.duPassword}
                        </span>
                      )}
                    </div>

                    <div className="form-group col-lg-6">
                      <label>
                        { "re password" }{" "}
                        <span className="red_star ml-1">*</span>
                      </label>
                      <input
                        type="password"
                        className="form-control"
                        value={editUser.rePassword || ""}
                        onChange={(e) =>
                          setEditUser({
                            ...editUser,
                            rePassword: e.target.value,
                          })
                        }
                        placeholder={ "p.re password" }
                      />
                      {errorMessages.rePassword && (
                        <span className="error-message">
                          {errorMessages.rePassword}
                        </span>
                      )}
                      {errorMessages.validPassword && (
                        <span className="error-message">
                          {errorMessages.validPassword}
                        </span>
                      )}
                    </div>

                    <div className="form-group col-lg-12 text-center mt-4">
                      <button className="btn btn-primary" onClick={submitUpdate}>
                        { "change" }
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
