import { useState, useRef, useEffect } from "react";
import Header from "./Layout/Header";
import Home from "./Layout/pages/Home";
import Nav from "./Layout/Nav";
import Users from "./Layout/pages/Users";
import Research from "./Layout/pages/Research";

import { Swiper, SwiperSlide } from "swiper/react";
import { Swiper as SwiperClass } from "swiper";
import Comments from "./Layout/Comments";
import "swiper/css";
import { motion, AnimatePresence } from "framer-motion";
import UserCenter from "./Layout/pages/UserCenter";

// Define types
type SlideIndex = 0 | 1 | 2;

interface SwiperRef {
  swiper: SwiperClass;
}

const Layout = () => {
  const [currentPage, setCurrentPage] = useState<SlideIndex>(0);
  const [commenting, setCommenting] = useState<number | false>(false); // set to false as default
  const swiperRef = useRef<SwiperRef>(null);

  useEffect(() => {
    if (swiperRef.current?.swiper) {
      swiperRef.current.swiper.slideTo(currentPage);
    }
  }, [currentPage]);

  return (
    <div className="flex flex-col h-screen">
      <div onClick={() => commenting !== false && setCommenting(false)}>
        <Header />

        <div className="flex-grow w-screen">
          <Swiper
            ref={swiperRef}
            spaceBetween={0}
            slidesPerView={1}
            autoHeight={true}
            loop={false}
            onSlideChange={(swiper) => {
              setCurrentPage(swiper.activeIndex as SlideIndex);
            }}
            className="h-full"
          >
            <SwiperSlide key={0}>
              <Home setCommenting={setCommenting} />
            </SwiperSlide>

            <SwiperSlide key={1}>
              <Users />
            </SwiperSlide>

            <SwiperSlide key={2}>
              <Research />
            </SwiperSlide>
            <SwiperSlide key={3}>
              <UserCenter />
            </SwiperSlide>
          </Swiper>
        </div>

        <Nav setCurrentPage={setCurrentPage} currentPage={currentPage} />
        <AnimatePresence>
          {commenting !== false && (
            <motion.div
              className="sticky bottom-0 z-20 min-h-screen bg-gray-900"
              initial={{ opacity: 0 }}
              animate={{ opacity: 0.7 }}
              exit={{ opacity: 0 }}
              transition={{ duration: 0.25 }}
            />
          )}
        </AnimatePresence>
      </div>

      <AnimatePresence>
        {commenting !== false && <Comments postId={commenting} />}
      </AnimatePresence>
    </div>
  );
};

export default Layout;
