import { Dispatch, SetStateAction } from "react";
import Post from "../Post";
import Publish from "../Publish";

const data = {
  id: 0,
  postOwner: "Someone else",
  publishedSins: "2d",
  content: {
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
    images: [
      "./src/assets/images/Liga.jpg",
      "./src/assets/images/FCB.jpg",
      "./src/assets/images/Lamine Yamal.jpg",
    ],
  },
};
const data2 = {
  id: 1,
  postOwner: "Someone else",
  publishedSins: "2d",
  content: {
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, nisi atque nobis eos et praesentium! Dolorum!",
    images: [
      "./src/assets/images/Wes Montgomery.jpg",
      "./src/assets/images/Esperanza Spalding.jpg",
    ],
  },
};
const data3 = {
  id: 2,
  postOwner: "Foot Mercato",
  publishedSins: "1d",
  content: {
    text: "MESDAMES ET MESSIEURS, NEYMAR EST DE RETOUR. 🤩🇧🇷\nLe Brésilien est dans le groupe d’Al-Hilal pour faire le déplacement à Al-Ain en Ligue des Champions asiatique. 💙\nLe football revit. 🥹",
    images: ["./src/assets/images/Neymar.jpg"],
  },
};
const data4 = {
  id: 3,
  postOwner: "Jon Sotiropoulos",
  publishedSins: "1d",
  content: {
    text: ".....Miles 1955\nhttps://www.youtube.com/watch?v=pK7NoYRKBhs...",
    images: ["./src/assets/images/Miles.jpg"],
  },
};
const Home = ({
  setCommenting,
}: {
  setCommenting: Dispatch<SetStateAction<number | false>>;
}) => {
  return (
    <div className="flex flex-col w-screen">
      <Publish />
      <div id="post-container" className="flex flex-col p-4 gat-3">
        <Post data={data} liked={true} setCommenting={setCommenting} />
        <Post data={data2} liked={false} setCommenting={setCommenting} />
        <Post data={data3} liked={true} setCommenting={setCommenting} />
        <Post data={data4} liked={false} setCommenting={setCommenting} />
      </div>
    </div>
  );
};

export default Home;
