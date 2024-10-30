import find from "../../icons/Magnifying-glass.svg";
import home from "../../icons/Home.svg";
import users from "../../icons/Users.svg";
import pdp from "../../images/1.webp";
import { motion, AnimatePresence } from "framer-motion";

const Nav = ({
  setCurrentPage,
  currentPage,
}: {
  setCurrentPage: React.Dispatch<React.SetStateAction<0 | 1 | 2>>;
  currentPage: 0 | 1 | 2 | 3;
}) => {
  const pages = [
    { index: 0, icon: home, id: "home" },
    { index: 1, icon: users, id: "users" },
    { index: 2, icon: find, id: "research" },
    { index: 3, icon: pdp, id: "profile" },
  ];

  return (
    <AnimatePresence>
      {currentPage !== 3 && (
        <motion.div
          animate={{ y: 0, transition: { duration: 0.75 } }}
          initial={{ y: 100 }}
          exit={{
            y: 100,
            transition: { duration: 0.75, delay: 0.5 },
          }}
          className="fixed bottom-0 z-10 flex items-center justify-between w-full px-7 bg-secondary-light flex-nowrap"
        >
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
              {page.index != 3 ? (
                <img
                  src={page.icon}
                  alt={page.id}
                  className="relative z-10 h-8 "
                />
              ) : (
                <img
                  src={pdp}
                  alt="profilePicture"
                  className="relative z-10 rounded-full h-11"
                />
              )}
            </button>
          ))}
        </motion.div>
      )}
    </AnimatePresence>
  );
};

export default Nav;
