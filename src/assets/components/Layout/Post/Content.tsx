const Content = ({ text, images }: { text: string; images: string[] }) => {
  return (
    <div className="flex flex-col gap-3">
      <p className="text-primary">{text}</p>
      <div>
        {images.map((image, index) => (
          <img
            key={index}
            src={image}
            alt={`Image ${index + 1}`}
            className="max-w-full rounded-xl"
          />
        ))}
      </div>
    </div>
  );
};

export default Content;
