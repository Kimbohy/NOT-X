import find from "../../icons/Magnifying-glass.svg";
import home from "../../icons/Home.svg";
import users from "../../icons/Users.svg";
import pdp from "../../images/1.webp";
import { motion } from "framer-motion";

const Nav = ({
  setCurrentPage,
  currentPage,
}: {
  setCurrentPage: React.Dispatch<React.SetStateAction<0 | 1 | 2>>;
  currentPage: 0 | 1 | 2;
}) => {
  const pages = [
    { index: 0, icon: home, id: "home" },
    { index: 1, icon: users, id: "users" },
    { index: 2, icon: find, id: "research" },
  ];

  return (
    <div className="sticky bottom-0 z-10 flex items-center justify-between w-full px-7 bg-secondary-light flex-nowrap">
      {pages.map((page) => (
        <button
          className="relative px-3 py-2"
          key={page.id}
          onClick={() => {
            setCurrentPage(page.index as 0 | 1 | 2);
          }}
        >
          {currentPage == page.index && (
            <motion.div
              layoutId="active-pill"
              className="absolute inset-0 bg-tertiary-light"
              style={{ borderRadius: 4 }}
            />
          )}
          <img src={page.icon} alt={page.id} className="relative z-10 h-8 " />
        </button>
      ))}
      <img src={pdp} alt="profilePicture" className="rounded-full h-11" />
    </div>
  );
};

export default Nav;
