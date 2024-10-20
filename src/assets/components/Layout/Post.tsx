import pdp from "../../images/1.webp";
import Actions from "./Post/Actions";
import Content from "./Post/Content";
import Head from "./Post/Head";

interface dataType {
  id: number;
  postOwner: string;
  publishedSins: string;
  content: {
    text: string;
    images: string[];
  };
}

const Post = ({ data, liked }: { data: dataType; liked: boolean }) => {
  return (
    <div className="p-5 rounded-md shadow-lg">
      <Head
        profilePicture={pdp}
        owner={data.postOwner}
        publishedSins={data.publishedSins}
      />
      <Content
        text={data.content.text}
        images={data.content.images}
        id={data.id}
      />
      <Actions liked={liked} />
    </div>
  );
};

export default Post;
