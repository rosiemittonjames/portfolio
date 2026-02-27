import { useNavigate } from "react-router-dom";
import React, { useState } from "react";
import "./Question1.css";
import "../../index.css";
import SelectBar from "../../components/SelectBar.jsx";
import Watercan from "../../Assets/Images/Watercan.png";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";

export function Question1() {
  const navigate = useNavigate();
  const [selectedAnswer, setSelectedAnswer] = useState(null);

  const handleSliderChange = (value) => {
    setSelectedAnswer(value);
    console.log("Frequency answer:", value);
  };

  return (
    <>
      <div className="flex w-full justify-between p-5">
        <BackButton onClick={() => navigate(-1)} />
        <StartAgainButton />
      </div>

      <div className="page-center">
        <img src={Watercan} className="Watercan" alt="watering can" />

        <h2>How often do you want to see them?</h2>

        <div className="Slider flex w-full justify-center">
          <div className="w-full max-w-[900px] px-4">
            <SelectBar onChange={handleSliderChange} />
          </div>
        </div>

        <div className="pt-15">
          <button
            onClick={() => {
              if (!selectedAnswer) {
                alert("Please choose your answer");
                return;
              }
              navigate("/Question2");
            }}
            className="next-button w-full cursor-pointer rounded-full border-2 border-[#0b6048] bg-[#0b6048] p-8 font-[HeadingFont] text-white hover:border-2 hover:border-white"
          >
            Keep Sprouting
          </button>
        </div>
      </div>
    </>
  );
}
