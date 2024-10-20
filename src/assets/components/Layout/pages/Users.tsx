const userList = [
  {
    id: 1,
    name: "John Doe",
    profilePicture: "https://randomuser.me/api/portraits/men/1.jpg",
  },
  {
    id: 2,
    name: "Jane Doe",
    profilePicture: "https://randomuser.me/api/portraits/women/2.jpg",
  },
  {
    id: 3,
    name: "John Smith",
    profilePicture: "https://randomuser.me/api/portraits/men/3.jpg",
  },
  {
    id: 4,
    name: "Jane Smith",
    profilePicture: "https://randomuser.me/api/portraits/women/6.jpg",
  },
];

const Users = () => {
  return (
    <div className="w-screen h-[700px] ">
      <div className="flex flex-col gap-4 p-4">
        {userList.map((user) => (
          <div key={user.id} className="flex items-center gap-4">
            <img
              src={user.profilePicture}
              alt="profile-picture"
              className="rounded-full w-14"
            />
            <span className="text-lg">{user.name}</span>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Users;
