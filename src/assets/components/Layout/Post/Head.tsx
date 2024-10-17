const Head = ({
  profilePicture,
  owner,
  publishedSins,
}: {
  profilePicture: string;
  owner: string;
  publishedSins: string;
}) => {
  return (
    <div className="flex items-start gap-4 ">
      <img
        src={profilePicture}
        alt="profile-picture"
        className="rounded-full w-14"
      />
      <div className="flex flex-col items-start">
        <span className="text-lg ">{owner}</span>
        <span className="text-sm text-gray-500">{publishedSins}</span>
      </div>
    </div>
  );
};

export default Head;
