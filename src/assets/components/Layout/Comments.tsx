import { motion } from "framer-motion";

const Comments = ({ postId }: { postId: number }) => {
  return (
    <motion.div
      initial={{ bottom: -1000 }}
      animate={{ bottom: 0 }}
      exit={{ bottom: -1000 }}
      transition={{
        duration: 0.45,
      }}
      className="absolute bottom-0 z-20 w-screen p-2 rounded-t-2xl h-3/5 bg-secondary"
    >
      <h1>comment</h1>
      <h2>{postId}</h2>
    </motion.div>
  );
};

export default Comments;
