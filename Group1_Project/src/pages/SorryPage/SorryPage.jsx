import { SorryButton } from "../../components/SorryButton";
import "./SorryPage.css";

export function SorryPage() {
  return (
    <div className="flower-background-container mx-50 flex flex-col items-center justify-center gap-20">
      <h1 className="sorry-heading">Oops...</h1>
      <p className="sorry-text">
        There aren't any plants that are a good match, please try again.
      </p>
      <SorryButton />
    </div>
  );
}
