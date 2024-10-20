import pdp from "../../images/1.webp";
import addImage from "../../icons/Image-plus.svg";
const Publish = () => {
  return (
    <div className="flex items-center w-full gap-2 p-2 bg-tertiary-light">
      <img src={pdp} alt="profile-picture" className="rounded-full w-14" />
      <input
        type="text"
        name="content"
        id="content"
        placeholder="What's on your heads?"
        className="flex-grow p-3 bg-white rounded-full h-11"
      />
      <img src={addImage} alt="Image-plus" className="w-10 " />
    </div>
  );
};

export default Publish;
