import Slider from "rc-slider";
import "rc-slider/assets/index.css";
import "./SelectBar.css";

function SelectBar({ onChange }) {
  return (
    <div style={{ width: "100%" }}>
      <Slider
        min={1}
        max={4}
        step={1}
        onChange={onChange}
        marks={{
          1: "Barely at all",
          2: "Once a week",
          3: "Every few days",
          4: "Daily commitment",
        }}
      />
    </div>
  );
}

export default SelectBar;
