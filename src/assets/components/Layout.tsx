import Header from "./Layout/Header";
import Home from "./Layout/pages/Home";
import Nav from "./Layout/Nav";
import { useState } from "react";
import Users from "./Layout/pages/Users";
import Research from "./Layout/pages/Research";

import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";

const Layout = () => {
  const [curentPage, setCurrentPage] = useState(0);
  return (
    <div>
      <Header />
      <div className="w-screen">
        <Swiper spaceBetween={0} slidesPerView={1} loop={false}>
          <SwiperSlide key={0}>
            <Home />
          </SwiperSlide>

          <SwiperSlide key={1}>
            <Users />
          </SwiperSlide>

          <SwiperSlide key={2}>
            <Research />
          </SwiperSlide>
        </Swiper>
      </div>
      <Nav setCurrentPage={setCurrentPage} />
    </div>
  );
};

export default Layout;
