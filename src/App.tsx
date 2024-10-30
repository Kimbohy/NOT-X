import Session from "./assets/components/Session";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Layout from "./assets/components/Layout";
import Notification from "./assets/components/Layout/pages/Notification";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Layout />} />
        <Route path="/session" element={<Session />} />
        <Route path="/notifications" element={<Notification />} />
        <Route path="*" element={<h1>404 Not Found</h1>} />
      </Routes>
    </Router>
  );
}

export default App;
