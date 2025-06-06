import React from "react";

const Header = ({ title }) => {
  return (
    <div className="row column_title" id="titleitem">
      <div className="col-md-12">
        <div className="page_title">
          <h4>{title}</h4>
        </div>
      </div>
    </div>
  );
};

export default Header;