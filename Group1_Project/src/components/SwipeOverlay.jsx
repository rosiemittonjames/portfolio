import { LikeIcon } from "./LikeIcon";
import { DislikeIcon } from "./DislikeIcon";

export function SwipeOverlay({ dragX, dragThreshold }) {
  // Don't render anything when not dragging
  if (dragX === 0) return null;

  const opacity = Math.abs(dragX) / dragThreshold;
  const isLike = dragX < 0; // Drag left = like

  return (
    <div
      className="absolute inset-0 flex items-center justify-center rounded-[20px] bg-white transition-opacity duration-300"
      style={{ opacity }}
    >
      {isLike ? (
        <LikeIcon className="drop-shadow-lg" />
      ) : (
        <DislikeIcon className="drop-shadow-lg" />
      )}
    </div>
  );
}
