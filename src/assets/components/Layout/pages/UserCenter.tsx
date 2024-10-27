import pdp from "../../../images/1.webp";
import angle_down from "../../../icons/Angle-down.svg";
import personalDetails from "../../../icons/Address-card.svg";
import shield_halved from "../../../icons/Shield-halved.svg";
import bell from "../../../icons/Bell-black.svg";
import language from "../../../icons/Language.svg";
import handcuffs from "../../../icons/handcuffs.svg";
import location from "../../../icons/Location-crosshairs.svg";
import trash_can from "../../../icons/Trash-can.svg";
import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";

const optionClassName =
  "flex p-3 text-lg bg-gray-50 items-center gap-3 rounded hover:bg-gray-100 transition-colors duration-200";
const className = "h-6";
const UserCenter = () => {
  const [moreUser_Actions, setMoreUser_Actions] = useState<boolean>(false);

  return (
    <AnimatePresence>
      <div className="relative flex flex-col w-screen h-screen gap-4 px-2 pt-4 bg-gray-100">
        <div>
          <div className="relative z-10 flex items-center justify-between px-4 py-3 rounded-lg shadow-md bg-primary-light">
            <div className="flex items-center gap-4">
              <img
                src={pdp}
                alt="Profile"
                className="h-16 border-2 border-white rounded-full shadow-lg"
              />
              <h1 className="text-2xl font-semibold text-gray-50">User Name</h1>
            </div>
            <button
              className="p-[5px] transition-transform duration-200 rounded-full bg-secondary-light hover:scale-105"
              onClick={() => setMoreUser_Actions(!moreUser_Actions)}
            >
              <motion.img
                src={angle_down}
                alt="Toggle Dropdown"
                className="w-8 h-7"
                animate={{ rotate: moreUser_Actions ? 180 : 0 }}
                transition={{ duration: 0.3 }}
              />
            </button>
          </div>
          <div>
            {moreUser_Actions && (
              <motion.div
                className="flex flex-col pt-2 pb-1 rounded-b-lg shadow-lg bg-secondary"
                initial={{ y: -20, opacity: 0 }}
                animate={{ y: 0, opacity: 1 }}
                exit={{ y: -20, opacity: 0 }}
                transition={{ duration: 0.3 }}
              >
                <button className="text-lg transition-colors duration-200 hover:text-primary">
                  Switch Account
                </button>
                <button className="text-lg transition-colors duration-200 hover:text-primary">
                  Log Out
                </button>
              </motion.div>
            )}
          </div>
        </div>

        <motion.div className="flex flex-col gap-2 pt-2" layoutId="part2">
          {[
            { icon: personalDetails, label: "Personal Details" },
            { icon: shield_halved, label: "Password and Security" },
            { icon: bell, label: "Notification" },
            { icon: language, label: "Language and Region" },
            { icon: handcuffs, label: "Blocking" },
            { icon: location, label: "Location" },
            { icon: trash_can, label: "Delete Account" },
          ].map(({ icon, label }, index) => (
            <button key={index} className={optionClassName}>
              <img src={icon} alt={label} className={className} />
              <span>{label}</span>
            </button>
          ))}
        </motion.div>
      </div>
    </AnimatePresence>
  );
};

export default UserCenter;
