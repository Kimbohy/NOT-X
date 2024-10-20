import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper/modules";
import { useState } from "react";

const Images = ({
  images,
  contentId,
}: {
  images: string[];
  contentId: number;
}) => {
  const [activeIndex, setActiveIndex] = useState<number>(0);
  return (
    <div className="relative w-full">
      <Swiper
        modules={[Navigation, Pagination]}
        spaceBetween={30}
        slidesPerView={1}
        loop={false}
        pagination={{
          clickable: true,
          bulletActiveClass: "bg-tertiary-light", // Change this line
          bulletClass: "w-2 h-2 rounded-full cursor-pointer",
        }}
        navigation={{
          prevEl: `#swiper-button-prev-custom-${contentId}`,
          nextEl: `#swiper-button-next-custom-${contentId}`,
        }}
        onBeforeInit={(swiper) => {
          swiper.on("slideChange", () => {
            setActiveIndex(swiper.activeIndex);
          });
        }}
      >
        {images.map((img, index) => (
          <SwiperSlide key={index}>
            <img
              src={img}
              alt={`slide ${index}`}
              style={{ width: "100%", height: "auto" }}
            />
          </SwiperSlide>
        ))}
      </Swiper>

      {/* Custom Navigation Buttons */}

      <div
        className={
          "absolute left-0 z-10 p-3 text-white transform -translate-y-1/2 bg-gray-800 rounded-full cursor-pointer top-1/2" +
          (activeIndex <= 0 ? "w-0 h-0" : "")
        }
        id={"swiper-button-prev-custom-" + contentId}
      >
        ❮
      </div>

      <div
        className={
          "absolute right-0 z-10 p-3 text-white transform -translate-y-1/2 bg-gray-800 rounded-full cursor-pointer top-1/2" +
          (activeIndex < images.length - 1 ? "" : "w-0 h-0")
        }
        id={"swiper-button-next-custom-" + contentId}
      >
        ❯
      </div>
    </div>
  );
};

export default Images;
