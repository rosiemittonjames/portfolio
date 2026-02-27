import "./LoadingPage.css";

export function LoadingPage() {
  return (
    <div className="mx-50 my-30 flex flex-col items-center gap-15">
      <h2 className="=">Are you ready to meet your leafy contenders?</h2>
      <img
        src="../src/Assets/Images/Soilmate.png"
        alt="soilmate"
        className="loading-image"
      />
      <h2 className="loading-text">Calculating your results...</h2>
    </div>
  );
}
