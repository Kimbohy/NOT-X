import Header from "./Layout/Header";
import Nav from "./Layout/Nav";
import Post from "./Layout/Post";
import Publish from "./Layout/Publish";

const Home = () => {
  const data = {
    postOwner: "Someone else",
    publishedSins: "2d",
    content: {
      text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
      images: ["./public/detailed-shot-car-wheels-tires.jpg"],
    },
  };
  return (
    <div className="flex flex-col">
      <Header />
      <Publish />
      <div id="post-container" className="flex flex-col p-4 gat-3">
        <Post data={data} liked={true} />
        <Post data={data} liked={false} />
      </div>
      <Nav />
    </div>
  );
};

export default Home;
