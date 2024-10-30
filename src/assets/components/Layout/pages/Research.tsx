import find from "../../../icons/Magnifying-glass.svg";

const images = [
  "./src/assets/images/Wes Montgomery.jpg",
  "./src/assets/images/Esperanza Spalding.jpg",
  "./src/assets/images/Miles.jpg",
  "./src/assets/images/Chick Corea.jpg",
  "./src/assets/images/ARILD ANDERSEN.jpg",
  "./src/assets/images/piano.jpg",
  "./src/assets/images/unknown mane.jpg",
  "./src/assets/images/Sonny Rollins.jpg",
];

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
      <div className="flex flex-wrap h-fit">
        {images.map((image) => (
          <img
            src={image}
            alt="image"
            className="flex-grow min-w-28 max-h-32 "
          />
        ))}
      </div>
    </div>
  );
};

export default Research;
