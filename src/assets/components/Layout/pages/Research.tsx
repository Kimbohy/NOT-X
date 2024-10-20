import find from "../../../icons/Magnifying-glass.svg";
const Research = () => {
  return (
    <div className="w-screen ">
      <div className="flex px-3 py-2 mx-2 mt-2 border-2 border-quaternary-light rounded-2xl flex-nowrap">
        <input
          type="text"
          className="flex-grow text-xl bg-transparent outline-none"
        />
        <img src={find} alt="search" className="h-8" />
      </div>
      <div className="flex h-[700px]"></div>
    </div>
  );
};

export default Research;
