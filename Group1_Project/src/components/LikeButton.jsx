import { LikeIcon } from "./LikeIcon";

export function LikeButton({ onClick }) {
  return (
    <button
      onClick={onClick}
      // more styling https://tailwindcss.com/docs/transition-property
      className="cursor-pointer transition-transform hover:scale-110"
    >
      <LikeIcon className="drop-shadow-lg hover:drop-shadow-2xl" />
    </button>
  );
}
