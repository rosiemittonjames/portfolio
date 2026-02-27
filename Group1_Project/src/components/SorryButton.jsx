import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { resetState } from "../redux/slice";

export function SorryButton() {
  const navigate = useNavigate();
  const dispatch = useDispatch();

  function handleClick() {
    dispatch(resetState());
    navigate("/");
  }
  return (
    <>
      <button className="action-button" onClick={handleClick}>
        Start Again
      </button>
    </>
  );
}
