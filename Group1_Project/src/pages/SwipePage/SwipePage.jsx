import { useEffect, useRef, useState } from "react";
import { useNavigate } from "react-router-dom";
import "./SwipePage.css";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";
import { SwipeCard } from "../../components/SwipeCard";
import { LikeButton } from "../../components/LikeButton";
import { DislikeButton } from "../../components/DislikeButton";
import { SwipeOverlay } from "../../components/SwipeOverlay";
import { plantsData } from "../../services/mockData";
import { usePointerDrag } from "react-use-pointer-drag";
import { useDispatch, useSelector } from "react-redux";
import { setPlantsForGallery } from "../../redux/slice";

export function SwipePage() {
  const navigate = useNavigate();
  const dispatch = useDispatch();

  // TODO apply use redux data after all questions logic  are done, for now just use mockdata
  // const plants = useSelector((state) => state.plants.plantsForSwipe);
  const plants = plantsData.slice(0, 10);

  const [currentIndex, setCurrentIndex] = useState(0);
  const [likedPlants, setLikedPlants] = useState([]);
  const [dragX, setDragX] = useState(0);
  const startXRef = useRef(0);

  const currentPlant = plants[currentIndex];
  const lastPlantIndex = plants.length - 1;
  const dragThreshold = 300;

  function handleLastClick() {
    dispatch(setPlantsForGallery(likedPlants)); //save the state in redux
    navigate("/7-gallery");
  }

  function handleClick(behaviour) {
    setDragX(behaviour === "like" ? -dragThreshold : dragThreshold);
    setTimeout(() => {
      if (currentIndex >= lastPlantIndex) {
        handleLastClick();
      }
      if (behaviour === "like") {
        setLikedPlants([...likedPlants, currentPlant]);
      }
      setCurrentIndex((i) => i + 1);
      setDragX(0);
    }, 300);
  }

  const { dragProps } = usePointerDrag({
    onStart: ({ x }) => {
      //save the starting point x
      startXRef.current = x;
    },
    onMove: ({ x }) => {
      setDragX(x - startXRef.current);
    },
    onEnd: ({ x }) => {
      const xDistance = x - startXRef.current;
      // Check which direction and trigger action
      if (xDistance < -dragThreshold) {
        handleClick("like");
      } else if (xDistance > dragThreshold) {
        handleClick("dislike");
      }
      setDragX(0);
    },
  });

  //for dev, remove when go live
  useEffect(() => {
    console.log("likedPlants--->", likedPlants);
    console.log("plants--->", plants);
  }, [likedPlants]);
  //for dev, remove when go live

  return (
    <div className="my-5 flex flex-col gap-20">
      <div className="flex justify-between px-[50px]">
        <BackButton onClick={() => navigate("/5-height")} />
        <StartAgainButton />
      </div>
      <h2 className="font-tan-songbird px-[50px] text-center text-[#043826]">
        Swipe through your plant matches and let love <br />
        (and leaves) grow...
      </h2>

      <div className="swipeCardContainer">
        {/* previous plant */}
        <SwipeCard
          plant={currentIndex > 0 ? plants[currentIndex - 1] : null}
          className="absolute left-0 h-[400px] w-[320px] -translate-x-[30%] scale-90 opacity-50"
        />

        {/* current plant - draggable  card*/}
        <div {...dragProps()} className="relative">
          <SwipeCard
            plant={currentPlant}
            className="z-10 h-[450px] w-[360px]"
          />
          <SwipeOverlay dragX={dragX} dragThreshold={dragThreshold} />
        </div>

        {/* next plant */}
        <SwipeCard
          plant={
            currentIndex < lastPlantIndex ? plants[currentIndex + 1] : null
          }
          className="absolute right-0 h-[400px] w-[320px] translate-x-[30%] scale-90 opacity-50"
        />
      </div>

      <div className="relative bottom-20 z-20 flex justify-center gap-100">
        <LikeButton onClick={() => handleClick("like")} />
        <DislikeButton onClick={() => handleClick("dislike")} />
      </div>
    </div>
  );
}
