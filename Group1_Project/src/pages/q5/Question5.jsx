import { useState } from "react";
import { useNavigate } from "react-router-dom";
import "./Question5.css";
import Plant01 from "../../Assets/Images/Plant01.png";
import Plant02 from "../../Assets/Images/Plant02.png";
import { BackButton } from "../../components/BackButton";
import { StartAgainButton } from "../../components/StartAgainButton";

export function Question5() {
  const navigate = useNavigate();
  const [selectedAnswer, setSelectedAnswer] = useState(null);

  const handleClick = (answer) => {
    setSelectedAnswer(answer);
    console.log("Height answer:", answer);
  };

  return (
    <>
      <div className="flex w-full justify-between pt-5 pr-5 pl-5">
        <BackButton onClick={() => navigate(-1)} />
        <StartAgainButton />
      </div>

      <div className="page-center">
        <div className="mr-50 ml-50 items-center justify-center">
          <h2 className="p-5">Is height important to you?</h2>

          {/* Questions */}
          <div className="flex gap-10 font-[BodyFont]">
            <div className="flex w-2/3 flex-col">
              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "short" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("short")}
              >
                I like my partner's short & cute
              </button>

              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "average" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("average")}
              >
                Average & reliable, please
              </button>

              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "tall" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("tall")}
              >
                Tall, dark & handsome only
              </button>

              <button
                className={`mb-8 block w-full cursor-pointer rounded-full border-2 bg-[#EC839E] p-4 text-center ${selectedAnswer === "any" ? "border-[#EC839E] bg-[#fff] p-4 font-bold" : "border-white bg-[#EC839E]"}`}
                onClick={() => handleClick("any")}
              >
                I'm open to all heights
              </button>
            </div>

            <div className="relative -mt-24 ml-20 flex w-1/3 items-end justify-center gap-6">
              <img
                src={Plant01}
                alt="Plant"
                className="h-auto max-w-[180px] drop-shadow-lg"
              />
              <img
                src={Plant02}
                alt="Plant"
                className="h-auto max-w-[320px] translate-y-15 drop-shadow-lg"
              />
            </div>
          </div>
          <div className="mb-10 pt-15">
            <button
              onClick={() => {
                if (!selectedAnswer) {
                  alert("Please choose your answer");
                  return;
                }
                navigate("/loading");
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
