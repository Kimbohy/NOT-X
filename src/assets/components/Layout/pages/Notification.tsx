import Header from "../Header";
import pdp from "../../../images/1.webp";

const notifications = [
  {
    type: "new comment",
    description: "Paul commented on your post.",
    time: "2m",
    link: "/post/1",
  },
  {
    type: "new like",
    description: "Jane liked your post.",
    time: "1h",
    link: "/post/1",
  },
  {
    type: "new follower",
    description: "Mary followed you.",
    time: "1d",
    link: "/profile/1",
  },
  {
    type: "new comment",
    description: "Mark commented on your post.",
    time: "2d",
    link: "/post/1",
  },
  {
    type: "new like",
    description: "John liked your post.",
    time: "3d",
    link: "/post/1",
  },
  {
    type: "new follower",
    description: "Jane followed you.",
    time: "1w",
    link: "/profile/1",
  },
];

const Notification = () => {
  const view = (link: string) => () => {
    window.location.href = link; // need to be replaced with react router later
  };
  return (
    <>
      <Header page="notification" />
      <div id="comment-container" className="flex flex-col gap-4 p-3">
        {notifications.map((notification) => (
          <div className="flex gap-2" onClick={view(notification.link)}>
            <img
              src={pdp}
              alt="profile picture"
              className="w-12 h-12 rounded-full"
            />
            <div className="">
              <div className="text-lg">{notification.description}</div>
              <div className="comment-time">{notification.time}</div>
            </div>
          </div>
        ))}
      </div>
    </>
  );
};

export default Notification;
