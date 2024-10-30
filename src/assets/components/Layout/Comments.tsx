import { motion } from "framer-motion";
import { useState } from "react";
import pdp from "../../images/1.webp";
import paper_plan from "../../icons/paper-plane.svg";
import Heart from "../../icons/Heart.svg";
import Heart_full from "../../icons/Heart2.svg";

interface commentsType {
  id: number;
  postId: number;
  name: string;
  comment: string;
  date: string;
  liked: boolean;
}

const commentsData: commentsType[] = [
  {
    id: 1,
    postId: 1,
    name: "John Doe",
    comment: "This is a comment",
    date: "2021-10-10 10:10:10",
    liked: false,
  },
  {
    id: 2,
    postId: 1,
    name: "Jane Doe",
    comment: "Nice post",
    date: "2024-03-12 04:10:12",
    liked: true,
  },
  {
    id: 3,
    postId: 2,
    name: "Peter Parker",
    comment: "Great post",
    date: "2024-05-06 01:05:00",
    liked: true,
  },
];

const Comments = (/*{ postId }: { postId: number }*/) => {
  const [comments, setComments] = useState<commentsType[]>(commentsData);
  const [newComment, setNewComment] = useState<string>("");
  const handleSend = () => {
    setComments(comments);
    // change to send the comment to the server
  };

  const getSinsDate = (date: string) => {
    const now = new Date();
    const past = new Date(date);
    const diff = Math.abs(now.getTime() - past.getTime());

    const diffMinutes = Math.floor(diff / (1000 * 60));
    const diffHours = Math.floor(diff / (1000 * 60 * 60));
    const diffDays = Math.floor(diff / (1000 * 60 * 60 * 24));
    const diffMonths = Math.floor(diff / (1000 * 60 * 60 * 24 * 30));
    const diffYears = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

    if (diffMinutes < 1) {
      return "Just now";
    } else if (diffMinutes < 60) {
      return `${diffMinutes}m`;
    } else if (diffHours < 24) {
      return `${diffHours}h`;
    } else if (diffDays < 30) {
      return `${diffDays}d`;
    } else if (diffMonths < 12) {
      return `${diffMonths}m`;
    } else {
      return `${diffYears}y`;
    }
  };

  return (
    <motion.div
      initial={{ bottom: -1000 }}
      animate={{ bottom: 0 }}
      exit={{ bottom: -1000 }}
      transition={{
        duration: 0.45,
      }}
      className="sticky z-20 w-screen p-2 min-h-[75vh] rounded-t-2xl bg-secondary-light flex flex-col items-center"
    >
      <h1>comment</h1>
      <div className="flex flex-col items-center flex-grow w-screen gap-2 p-2">
        {comments.map((comment) => (
          <div
            key={comment.id}
            className="flex items-center w-screen gap-3 px-4 py-2"
          >
            <img src={pdp} alt="user pdp" className="w-12 rounded-full" />
            <div className="flex-grow">
              <div className="flex items-center gap-1">
                <h1 className="text-xl">{comment.name}</h1>
                <span className="text-sm text-gray-600">
                  {getSinsDate(comment.date)}
                </span>
              </div>
              <p className="text-gray-900">{comment.comment}</p>
            </div>
            <img
              src={comment.liked ? Heart_full : Heart}
              alt="heart"
              className="w-6"
            />
          </div>
        ))}
      </div>

      <div className="flex justify-between w-screen gap-3 px-3">
        <img src={pdp} alt="pdp" className="w-16 rounded-full" />
        <textarea
          placeholder="your comment"
          className="flex-grow p-2 overflow-hidden text-lg resize-none rounded-2xl"
          value={newComment}
          onChange={(e) => setNewComment(e.target.value)}
          rows={1}
          style={{ overflowWrap: "break-word", wordWrap: "break-word" }}
        />
        <button onClick={handleSend}>
          <img src={paper_plan} alt="paper plan" className="w-10" />
        </button>
      </div>
    </motion.div>
  );
};

export default Comments;
