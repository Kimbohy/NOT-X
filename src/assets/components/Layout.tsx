import { useState, useRef, useEffect } from "react";
import Header from "./Layout/Header";
import Home from "./Layout/pages/Home";
import Nav from "./Layout/Nav";
import Users from "./Layout/pages/Users";
import Research from "./Layout/pages/Research";

import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";

// Define types
type SlideIndex = 0 | 1 | 2;

import { Swiper as SwiperClass } from "swiper";

interface SwiperRef {
  swiper: SwiperClass;
}

const Layout = () => {
  const [currentPage, setCurrentPage] = useState<SlideIndex>(0);
  const swiperRef = useRef<SwiperRef>(null);

  useEffect(() => {
    if (swiperRef.current?.swiper) {
      swiperRef.current.swiper.slideTo(currentPage);
    }
  }, [currentPage]);

  return (
    <div>
      <Header />
      <div className="w-screen">
        <Swiper
          ref={swiperRef}
          spaceBetween={0}
          slidesPerView={1}
          autoHeight={true}
          loop={false}
          onSlideChange={(swiper) => {
            setCurrentPage(swiper.activeIndex as SlideIndex);
          }}
        >
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

      <Nav setCurrentPage={setCurrentPage} currentPage={currentPage} />
    </div>
  );
};

export default Layout;
