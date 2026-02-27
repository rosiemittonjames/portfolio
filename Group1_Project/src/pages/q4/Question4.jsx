import { useNavigate } from "react-router-dom";
import React, { useState } from "react";
import "./Question4.css";
import "../../index.css";
import Heart01 from "../../Assets/Images/Heart01.png";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";

export function Question4() {
  const navigate = useNavigate();
  const [selectedAnswer, setSelectedAnswer] = useState(null);

  const handleClick = (answer) => {
    setSelectedAnswer(answer);
    console.log("Pet friendly answer:", answer);
  };

  return (
    <>
      <div className="flex w-full justify-between p-5">
        <BackButton onClick={() => navigate(-1)} />
        <StartAgainButton />
      </div>

      <div className="page-center">
        <img src={Heart01} className="Heart01" alt="Dark green heart" />

        <h2>Do they need to get along with your pets?</h2>

        {/* Answer Choices */}
        <div className="flex gap-6 font-[BodyFont]">
          <button
            className={`block w-full cursor-pointer rounded-full border-2 p-4 text-center ${selectedAnswer === "true" ? "border-[#EC839E] bg-[#fff] font-bold" : "border-white bg-[#EC839E]"}`}
            onClick={() => handleClick("true")}
          >
            Yes - my pets and I are a package deal
          </button>

          <button
            className={`block w-full cursor-pointer rounded-full border-2 p-4 text-center ${selectedAnswer === "false" ? "border-[#EC839E] bg-[#fff] font-bold" : "border-white bg-[#EC839E]"}`}
            onClick={() => handleClick("false")}
          >
            I don't have pets
          </button>
        </div>

        <div className="pt-15">
          <button
            onClick={() => {
              if (!selectedAnswer) {
                alert("Please choose your answer");
                return;
              }
              navigate("/Question5");
            }}
            className="next-button cursor-pointer rounded-full border-2 border-[#0b6048] bg-[#0b6048] p-8 font-[HeadingFont] text-white hover:border-2 hover:border-white"
          >
            Keep Sprouting
          </button>
        </div>
      </div>
    </>
  );
}
