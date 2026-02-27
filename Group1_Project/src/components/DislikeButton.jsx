import { DislikeIcon } from "./DislikeIcon";

export function DislikeButton({ onClick }) {
  return (
    <button
      onClick={onClick}
      className="cursor-pointer transition-transform hover:scale-110"
    >
      <DislikeIcon className="drop-shadow-lg hover:drop-shadow-2xl" />
    </button>
  );
}
