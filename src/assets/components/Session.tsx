import SingIn from "./session/SingIn";
import SingUp from "./session/SingUp";
import logo from "../icons/logo/bg-black.svg";

import { useState } from "react";
import { motion } from "framer-motion";

const Session = () => {
  const [page, setPage] = useState(false);
  return (
    <div className="flex items-center justify-center h-screen bg-gray-50">
      <div className="flex flex-col w-full h-screen max-w-md p-10 bg-white rounded-lg shadow-md">
        <img src={logo} alt="logo" className="w-20 h-20 mx-auto mb-5" />

        <div className="flex justify-start gap-3 mb-5 border-b-2 border-gray-600">
          <button
            onClick={() => setPage(false)}
            className={` flex flex-col rounded-lg ${page && "text-gray-600"}`}
          >
            <span>Sign in</span>
            {!page && (
              <motion.div
                layoutId="underLine"
                className="relative top-[2px] w-full h-[2px] bg-secondary"
              />
            )}
          </button>
          <button
            onClick={() => setPage(true)}
            className={` rounded-lg ${!page && "text-gray-600"}`}
          >
            <span>Sign up</span>
            {page && (
              <motion.div
                layoutId="underLine"
                className="relative top-[2px] w-full h-[2px] bg-secondary"
              />
            )}
          </button>
        </div>
        {page ? <SingUp /> : <SingIn />}
      </div>
    </div>
  );
};
export default Session;
