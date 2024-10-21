import { Dispatch, SetStateAction } from "react";
import Heart from "../../../icons/Heart.svg";
import Heart_full from "../../../icons/Heart2.svg";
import Comment from "../../../icons/Message square.svg";

const Actions = ({
  liked,
  id,
  setCommenting,
}: {
  liked: boolean;
  id: number;
  setCommenting: Dispatch<SetStateAction<number | false>>;
}) => {
  return (
    <div className="flex gap-2 pt-4">
      <img src={liked ? Heart_full : Heart} alt="like" className="w-7" />
      <img
        src={Comment}
        alt="comment"
        className="w-7"
        onClick={() => {
          console.log(id);

          setCommenting(id);
        }}
      />
    </div>
  );
};

export default Actions;
