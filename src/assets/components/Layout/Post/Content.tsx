import Images from "./Images";

const Content = ({
  text,
  images,
  id,
}: {
  text: string;
  images: string[];
  id: number;
}) => {
  return (
    <div className="flex flex-col gap-3 mt-2">
      <p className="text-gray-600">{text}</p>
      <div className="relative flex items-center flex-nowrap">
        <div className="flex overflow-hidden flex-nowrap">
          <Images images={images} contentId={id} />
        </div>
      </div>
    </div>
  );
};

export default Content;
