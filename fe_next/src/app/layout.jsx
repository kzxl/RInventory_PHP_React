import "antd/dist/reset.css";

export const metadata = {
  title: "Inventory",
  description: "none",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body> {children} </body>
    </html>
  );
}
