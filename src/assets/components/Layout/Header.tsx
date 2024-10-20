import logo from "../../icons/logo/white.svg";
import bell from "../../icons/Bell.svg";
import message from "../../icons/Paper-plane.svg";

const Header = () => {
  return (
    <header className="sticky top-0 z-10 flex justify-between p-4 flex-nowrap bg-primary">
      <img src={logo} alt="Black-logo" className="w-12" />
      <div className="flex gap-3 flex-nowrap">
        <img src={bell} alt="Bell" className="w-7" />
        <img src={message} alt="Paper-plane" className="w-7" />
      </div>
    </header>
  );
};

export default Header;
