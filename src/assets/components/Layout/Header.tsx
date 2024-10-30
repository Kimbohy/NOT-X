import logo from "../../icons/logo/white.svg";
import { Link } from "react-router-dom";
import { AnimatePresence, motion } from "framer-motion";

const Header = ({ page }: { page: string }) => {
  const pathVariants = {
    hidden: {
      opacity: 1,
      pathLength: 0,
      strokeDashoffset: 1,
    },
    visible: {
      opacity: 1,
      pathLength: 1,
      strokeDashoffset: 0,
      transition: { duration: 2 },
    },
  };

  return (
    <header className="sticky top-0 z-20 flex justify-between px-3 py-3 flex-nowrap bg-primary">
      <img src={logo} alt="Black-logo" className="w-12" />
      <AnimatePresence>
        <div className="flex items-center gap-4 flex-nowrap">
          {page !== "home" && (
            <Link to="/">
              <div className={`w-9 ${page === "home" && " invisible"}`}>
                {/* home icon */}
                <motion.svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0,0,60,60"
                  fill-rule="nonzero"
                >
                  <motion.path
                    fill="none"
                    stroke="#ffffff"
                    strokeWidth="3.2"
                    strokeDasharray="1000"
                    variants={pathVariants}
                    initial="hidden"
                    animate="visible"
                    exit={{ opacity: 0, transition: { duration: 0.25 } }}
                    d="M32,8c-0.91125,0 -1.82195,0.30919 -2.56445,0.92969l-20.63477,17.24219c-0.765,0.639 -1.0373,1.75333 -0.5293,2.61133c0.647,1.092 2.07877,1.30534 3.00977,0.52734l0.71875,-0.59961v18.28906c0,2.761 2.239,5 5,5h30c2.761,0 5,-2.239 5,-5v-18.28711l0.71875,0.59961c0.374,0.313 0.8273,0.46484 1.2793,0.46484c0.695,0 1.38462,-0.36069 1.76563,-1.05469c0.465,-0.848 0.19122,-1.91906 -0.55078,-2.53906l-3.21289,-2.68555v-8.49805c0,-1.105 -0.895,-2 -2,-2h-2c-1.105,0 -2,0.895 -2,2v3.48438l-11.43555,-9.55469c-0.7425,-0.6205 -1.6532,-0.92969 -2.56445,-0.92969zM32,12.15234c0.11475,0 0.22877,0.03919 0.32227,0.11719l15.67773,13.09961v20.63086c0,1.105 -0.895,2 -2,2h-8v-14c0,-1.105 -0.895,-2 -2,-2h-8c-1.105,0 -2,0.895 -2,2v14h-8c-1.105,0 -2,-0.895 -2,-2v-20.63281l15.67773,-13.09766c0.0935,-0.078 0.20752,-0.11719 0.32227,-0.11719z"
                  ></motion.path>
                </motion.svg>
              </div>
            </Link>
          )}
          {page === "home" && (
            // bell icon
            <Link to="/notifications">
              <div className="w-7">
                <motion.svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"
                >
                  <motion.path
                    fill="none"
                    stroke="#ffffff"
                    strokeWidth="35"
                    strokeDasharray="1000"
                    variants={pathVariants}
                    initial="hidden"
                    animate="visible"
                    exit={{ opacity: 0, transition: { duration: 0.25 } }}
                    d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"
                  />
                </motion.svg>
              </div>
            </Link>
          )}
          <div>
            <svg
              viewBox="0 0 512 512"
              xmlns="http://www.w3.org/2000/svg"
              className="w-7"
            >
              <path
                fill="#ffffff"
                strokeWidth="40"
                strokeDasharray="10000"
                d="M440 6.5L24 246.4c-34.4 19.9-31.1 70.8 5.7 85.9L144 379.6V464c0 46.4 59.2 65.5 86.6 28.6l43.8-59.1 111.9 46.2c5.9 2.4 12.1 3.6 18.3 3.6 8.2 0 16.3-2.1 23.6-6.2 12.8-7.2 21.6-20 23.9-34.5l59.4-387.2c6.1-40.1-36.9-68.8-71.5-48.9zM192 464v-64.6l36.6 15.1L192 464zm212.6-28.7l-153.8-63.5L391 169.5c10.7-15.5-9.5-33.5-23.7-21.2L155.8 332.6 48 288 464 48l-59.4 387.3z"
              />
            </svg>
          </div>
        </div>
      </AnimatePresence>
    </header>
  );
};

export default Header;
