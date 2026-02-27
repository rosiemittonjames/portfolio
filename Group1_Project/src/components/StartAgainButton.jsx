import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { resetState } from "../redux/slice";

export function StartAgainButton() {
  const navigate = useNavigate();
  const dispatch = useDispatch();

  function handleClick() {
    dispatch(resetState());
    navigate("/");
  }

  return (
    <>
      <button
        className="font-roboto-mono cursor-pointer text-[20px] text-[#043826] underline"
        onClick={handleClick}
      >
        Start Again
      </button>
    </>
  );
}
