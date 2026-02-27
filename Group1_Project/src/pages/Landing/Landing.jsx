import "./Landing.css";
import Heart03 from "../../Assets/Images/Heart03.png";
import { useNavigate } from "react-router-dom";

export function Landing() {
  const navigate = useNavigate();
  return (
    <>
      <div className="container">
        <img className="heart-img" src={Heart03} alt="" />
        <div className="hero">
          <h1 className="pt-6 pb-8">Plant Pal</h1>
          <h2>Find your soil mate</h2>
          <p className="pt-8 pb-6">
            Tell us your type low-commitment, pet-friendly, or just plain cute
            and we’ll match you with plants made for you.
          </p>
          <p>Your perfect perennial partner is waiting…</p>
          <div className="pt-15">
            <button
              onClick={() => navigate("/Question1")}
              className="mx-auto block w-1/2 cursor-pointer rounded-full border-2 border-[#0b6048] bg-[#0b6048] p-8 text-center font-[HeadingFont] text-white hover:border-2 hover:border-white"
            >
              Sprout My Match!
            </button>
          </div>
        </div>
      </div>
    </>
  );
}
