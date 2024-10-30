import { motion } from "framer-motion";
import { useState } from "react";
import pdp from "../../images/1.webp";

interface commentsType {
  id: number;
  postId: number;
  name: string;
  comment: string;
  date: string;
}

const commentsData: commentsType[] = [
  {
    id: 1,
    postId: 1,
    name: "John Doe",
    comment: "This is a comment",
    date: "2021-10-10 10:10:10",
  },
  {
    id: 2,
    postId: 1,
    name: "Jane Doe",
    comment: "Nice post",
    date: "2024-03-12 04:10:12",
  },
  {
    id: 3,
    postId: 2,
    name: "Peter Parker",
    comment: "Great post",
    date: "2024-05-06 01:05:00",
  },
];

const Comments = (/*{ postId }: { postId: number }*/) => {
  const [comments, setComments] = useState<commentsType[]>(commentsData);
  const handleSend = () => {};
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
      <div className="flex flex-col items-center w-screen gap-2 p-3">
        {comments.map((comment) => (
          <div className="w-full bg-white">
            <h1>{comment.name}</h1>
            <p>{comment.comment}</p>
            <p>{comment.date}</p>
          </div>
        ))}
      </div>
      <div className="bottom-0 flex ">
        <img src={pdp} alt="pdp" className="w-16 rounded-full" />
        <input type="text" placeholder="Ur comment" />
        <button onClick={() => handleSend()}>send</button>
      </div>
    </motion.div>
  );
};

export default Comments;
