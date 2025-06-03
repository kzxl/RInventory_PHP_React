const NotFound = ({ homeUrl }) => {
  return (
    <div className="inner_page login">
      <div className="full_container">
        <div className="container">
          <div className="center verticle_center full_height">
            <div className="error_page">
              <div className="center">
                <div className="error_icon">
                  <img
                    className="img-responsive"
                    src="/images/layout_img/error.png"
                    alt="#"
                  />
                </div>
              </div>
              <br />
              <h3>PAGE NOT FOUND !</h3>
              <p>YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
              <div className="center">
                <a className="main_bt" href={homeUrl}>
                  Go To Home Page
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default NotFound;