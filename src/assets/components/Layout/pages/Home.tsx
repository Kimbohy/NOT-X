import Post from "../Post";
import Publish from "../Publish";

const data = {
  id: 0,
  postOwner: "Someone else",
  publishedSins: "2d",
  content: {
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
    images: ["./src/assets/images/detailed-shot-car-wheels-tires.jpg"],
  },
};
const data2 = {
  id: 1,
  postOwner: "Someone else",
  publishedSins: "2d",
  content: {
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
    images: [
      "./src/assets/images/jack-dong-yUQ79XZDQFQ-unsplash.jpg",
      "./src/assets/images/tiago-ferreira-lOOMSNe3Vng-unsplash.jpg",
    ],
  },
};
const data3 = {
  id: 1,
  postOwner: "Someone else",
  publishedSins: "2d",
  content: {
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
    images: [
      "./src/assets/images/jack-dong-yUQ79XZDQFQ-unsplash.jpg",
      "./src/assets/images/tiago-ferreira-lOOMSNe3Vng-unsplash.jpg",
    ],
  },
};
const Home = () => {
  return (
    <div className="flex flex-col w-screen">
      <Publish />
      <div id="post-container" className="flex flex-col p-4 gat-3">
        <Post data={data} liked={true} />
        <Post data={data2} liked={false} />
        <Post data={data3} liked={false} />
      </div>
    </div>
  );
};

export default Home;
