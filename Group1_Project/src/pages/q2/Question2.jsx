import { useNavigate } from "react-router-dom";
import "./Question2.css";
import { useState } from "react";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";
import { setDifficulty } from "../../redux/slice";
import { useDispatch } from "react-redux";

export function Question2() {
  const navigate = useNavigate();
  const [selectedAnswer, setSelectedAnswer] = useState(null);

  const handleClick = (answer) => {
    setSelectedAnswer(answer);
    console.log("Selected answer:", answer);
  };

  const dispatch = useDispatch();

  return (
    <>
      <div className="flex w-full justify-between p-5">
        <BackButton onClick={() => navigate(-1)} />
        <StartAgainButton />
      </div>

      <div className="page-center">
        {/* Page Content */}

        <div className="flex w-5xl flex-col items-center justify-center">
          <h2 className="leading-18">
            What kind of commitment are you looking for?
          </h2>

          {/* Answer Choices */}
          <div className="pt-8 font-[BodyFont]">
            <button
              className={`mb-8 block w-4xl cursor-pointer rounded-full border-2 p-4 text-center ${selectedAnswer === "easy" ? "border-[#EC839E] bg-[#fff] p-4" : "border-white bg-[#EC839E] "}`}
              onClick={() => handleClick("easy")}
            >
              Low-maintenance & emotionally stable for me, please
            </button>
            <button
              className={`mb-8 block w-4xl cursor-pointer rounded-full border-2 p-4 text-center ${selectedAnswer === "hard" ? "border-[#EC839E] bg-[#fff] p-4" : "border-white bg-[#EC839E] "}`}
              onClick={() => handleClick("hard")}
            >
              Bring it on - I am fully committed
            </button>
          </div>

          <div className="pt-15">
            <button
              onClick={() => {
                if (!selectedAnswer) {
                  alert("Please choose your answer");
                  return;
                }
                dispatch(setDifficulty(selectedAnswer));

                navigate("/Question3");
              }}
              className="next-button cursor-pointer"
            >
              Keep Sprouting
            </button>
          </div>
        </div>
      </div>
    </>
  );
}
