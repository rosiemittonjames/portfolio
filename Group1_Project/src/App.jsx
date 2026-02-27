// import STUFF from STUFF.file
import { Routes, Route, Link } from "react-router-dom";
import { Intros } from "./pages/Intros";
import { Landing } from "./pages/Landing/Landing";
import { Question2 } from "./pages/q2/Question2";
import { Test } from "./pages/Test";
import { Question3 } from "./pages/q3/Question3";
import { SwipePage } from "./pages/SwipePage/SwipePage";
import { SorryPage } from "./pages/SorryPage/SorryPage";
import { LoadingPage } from "./pages/LoadingPage/LoadingPage";
import { Question1 } from "./pages/q1/Question1";
import { Question4 } from "./pages/q4/Question4";
import { Question5 } from "./pages/q5/Question5";

function App() {
  return (
    <div className="app">
      <nav className="flex w-full justify-between pt-10 pr-10 pl-10">
        <Link to="/">Home</Link>
        <Link to="/intro">Meet The Team</Link>
      </nav>
      <Routes>
        <Route path="/" element={<Landing />} />
        <Route path="/intro" element={<Intros />} />
        <Route path="/test" element={<Test />} />
        <Route path="/Question2" element={<Question2 />} />
        <Route path="/Question3" element={<Question3 />} />
        <Route path="/6-swipe" element={<SwipePage />} />
        <Route path="/sorry" element={<SorryPage />} />
        <Route path="/loading" element={<LoadingPage />} />
        <Route path="/Question1" element={<Question1 />} />
        <Route path="/Question4" element={<Question4 />} />
        <Route path="/Question5" element={<Question5 />} />
      </Routes>
    </div>
  );
}

export default App;
