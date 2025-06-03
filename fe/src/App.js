import React, { useState } from "react"
import { useDispatch, useSelector } from "react-redux"
import "./index.css";
import AppRouter from "./routers/appRouters";

function App() {  
  
  //return <AppRouter/>;
  const [items, setItems] = useState(["React", "Tailwind", "Component"])
  const [newItem, setNewItem] = useState("")

  const handleAdd = () => {
    if (newItem.trim()) {
      setItems([...items, newItem])
      setNewItem("")
    }
  }
  const dispatch = useDispatch()
console.log("Dispatch function:", dispatch)
   return (
    <div className="min-h-screen bg-gray-100 p-6">
      <div className="max-w-xl mx-auto">
        <h1 className="text-3xl font-bold text-center mb-4">🚀 My React App</h1>
        <p className="text-center text-gray-600 mb-6">
          Đây là trang mẫu React trong <code>App.js</code>
        </p>

        <div className="flex gap-2 mb-4">
          <input
            type="text"
            placeholder="Thêm item mới..."
            className="flex-1 px-3 py-2 rounded border border-gray-300"
            value={newItem}
            onChange={(e) => setNewItem(e.target.value)}
          />
          <button
            onClick={handleAdd}
            className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            Thêm
          </button>
        </div>

        <ul className="space-y-2">
          {items.map((item, index) => (
            <li
              key={index}
              className="bg-white p-3 rounded shadow border border-gray-200"
            >
              {item}
            </li>
          ))}
        </ul>
      </div>
    </div>
  )
}

export default App;
