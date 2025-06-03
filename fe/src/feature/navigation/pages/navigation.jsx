import Topbar from "./topbar";
import Navbar from "./navbar";

const Navigation = ({ Child }) => {
  return (
    <div>
      <Navbar />
      <div id="content">
        <Topbar />
        <Child />
      </div>
    </div>
  );
};

export default Navigation;
