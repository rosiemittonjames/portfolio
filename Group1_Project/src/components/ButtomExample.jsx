import { useNavigate } from "react-router-dom";

export function ButtonExample() {
  const navigate = useNavigate();
  return <button onClick={() => navigate("/intro")}>Go to Intros</button>;
}
