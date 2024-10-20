import find from "../../icons/Magnifying-glass.svg";
import home from "../../icons/Home.svg";
import users from "../../icons/Users.svg";
import pdp from "../../../../public/1.webp";
import { motion } from "framer-motion";
import { useState } from "react";
const Nav = () => {
  const pages = [
    { icon: home, id: "home" },
    { icon: users, id: "users" },
    { icon: find, id: "find" },
  ];
  const [activePage, setActivePage] = useState(pages[0].id);

  return (
    <div className="sticky bottom-0 z-10 flex items-center justify-between w-full px-7 bg-secondary-light flex-nowrap">
      {pages.map((page) => (
        <button
          className="relative px-3 py-2"
          key={page.id}
          onClick={() => {
            setActivePage(page.id);
          }}
        >
          {activePage == page.id && (
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
