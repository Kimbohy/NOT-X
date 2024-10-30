import logo from "../../icons/logo/white.svg";
import bell from "../../icons/Bell.svg";
import message from "../../icons/Paper-plane.svg";
import { Link } from "react-router-dom";

const Header = () => {
  return (
    <header className="sticky top-0 z-20 flex justify-between p-3 flex-nowrap bg-primary">
      <img src={logo} alt="Black-logo" className="w-12" />
      <div className="flex gap-3 flex-nowrap">
        <Link to="/notifications">
          <img src={bell} alt="Bell" className="w-7" />
        </Link>
        <img src={message} alt="Paper-plane" className="w-7" />
      </div>
    </header>
  );
};

export default Header;
