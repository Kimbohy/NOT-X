import Google from "../../icons/Google.svg";
import Github from "../../icons/Github.svg";

import { motion } from "framer-motion";

const SingUp = () => {
  return (
    <form action="" className="flex flex-col gap-3">
      <div className="flex flex-col gap-2">
        <label className="text-sm text-gray-600">Your first name</label>
        <input
          type="text"
          name="firstName"
          id="firstName"
          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        />
      </div>
      <div className="flex flex-col gap-2">
        <label className="text-sm text-gray-600">Your last name</label>
        <input
          type="text"
          name="lastName"
          id="lastName"
          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        />
      </div>
      <div className="flex flex-col gap-2">
        <label className="text-sm text-gray-600">Password</label>
        <input
          type="password"
          name="password"
          id="passwordOne"
          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        />
      </div>
      <div className="flex flex-col gap-2">
        <label className="text-sm text-gray-600">Confirm the Password</label>
        <input
          type="password"
          name="password"
          id="passwordTow"
          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        />
      </div>
      <motion.div layoutId="bottom">
        <input
          type="submit"
          value="Join Now"
          className="w-full p-2 text-white rounded-lg bg-primary hover:bg-primary-dark"
        />
        <div className="flex flex-col items-center gap-1">
          <span className="text-sm text-gray-600">Or sign up with</span>
          <div className="flex gap-10">
            <button className="flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary hover:bg-gray-100">
              <img src={Google} alt="google-logo" className="w-5 h-5" />
              <span>Google</span>
            </button>
            <button className="flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary hover:bg-gray-100">
              <img src={Github} alt="github-logo" className="w-5 h-5" />
              <span>Github</span>
            </button>
          </div>
        </div>
      </motion.div>
    </form>
  );
};

export default SingUp;
