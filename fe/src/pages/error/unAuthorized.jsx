import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const UnAuthorized = ({ homeUrl = "/" }) => {
  const navigate = useNavigate();
  const [countdown, setCountdown] = useState(5);

  useEffect(() => {
    const timer = setInterval(() => {
      setCountdown((prev) => {
        if (prev === 1) {
          navigate(homeUrl);
          return 0;
        }
        return prev - 1;
      });
    }, 1000);

    return () => clearInterval(timer);
  }, [navigate, homeUrl]);

  return (
    <div className="inner_page login">
      <div className="full_container">
        <div className="container">
          <div className="center verticle_center full_height">
            <div className="error_page">
              <div className="lock"></div>
              <div className="message">
                <h1>Access to this page is restricted</h1>
                <p>
                  Please check with the site admin if you believe this is a
                  mistake.
                </p>
                <p>
                  Redirecting in <strong>{countdown}</strong> seconds...
                </p>
                <div className="progress-bar">
                  <div
                    className="progress"
                    style={{ width: `${(countdown / 5) * 100}%` }}></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* CSS nội bộ */}
      <style jsx>{`
        .progress-bar {
          width: 100%;
          height: 5px;
          background-color: #ddd;
          margin-top: 10px;
          border-radius: 5px;
          overflow: hidden;
        }
        .progress {
          height: 100%;
          background-color: #007bff;
          transition: width 1s linear;
        }
      `}</style>
    </div>
  );
};

export default UnAuthorized;