import { useState } from "react";
import { useNavigate } from "react-router-dom";
import "./Question3.css";
import Plant03 from "../../Assets/Images/Plant03.png";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";
import { setSunlight } from "../../redux/slice";
import { useDispatch } from "react-redux";

export function Question3() {
  const navigate = useNavigate();
  const [selectedAnswer, setSelectedAnswer] = useState(null);

  const handleClick = (answer) => {
    setSelectedAnswer(answer);
    console.log("Light level answer:", answer);
  };

  const dispatch = useDispatch();

  return (
    <>
      <div className="flex w-full justify-between pt-5 pr-5 pl-5">
        <BackButton onClick={() => navigate(-1)} />
        <StartAgainButton />
      </div>

      <div className="page-center">
        <div className="mr-50 ml-50 items-center justify-center">
          <h2 className="p-20">How do they like to be seen?</h2>

          {/* Questions */}
          <div className="grid grid-flow-col grid-cols-3 grid-rows-3 gap-4 font-[BodyFont]">
            <div className="col-span-2">
              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "shy" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("shy")}
              >
                In a dark and mysterious corner
              </button>
            </div>
            <div className="col-span-2">
              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "ambivert" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("ambivert")}
              >
                Not too much and not too little spotlight!
              </button>
            </div>
            <div className="col-span-2">
              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "extrovert" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("extrovert")}
              >
                Front and centre, full spotlight
              </button>
            </div>
            <div className="row-span-3">
              <img src={Plant03} alt="" />
            </div>
          </div>
          <div className="mb-10 pt-15">
            <button
              onClick={() => {
                if (!selectedAnswer) {
                  alert("Please choose your answer");
                  return;
                }
                dispatch(setSunlight(selectedAnswer));
                navigate("/Question4");
              }}
              className="next-button w-full cursor-pointer rounded-full border-2 border-[#0b6048] bg-[#0b6048] p-8 font-[HeadingFont] text-white hover:border-2 hover:border-white"
            >
              Keep Sprouting
            </button>
          </div>
        </div>
      </div>
    </>
  );
}
