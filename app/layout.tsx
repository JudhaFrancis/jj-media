import type { Metadata } from "next";
import { Playfair_Display, DM_Sans } from "next/font/google";
import "./globals.css";

const playfair = Playfair_Display({
  subsets: ["latin"],
  variable: "--font-playfair",
});

const dmSans = DM_Sans({
  subsets: ["latin"],
  variable: "--font-dm-sans",
});

export const metadata: Metadata = {
  title: "JJ Media House | Your Brand. Unmissable. Everywhere.",
  description: "Premium outdoor advertising across Bengaluru's most strategic corridors. Bold, beautiful, impossible to ignore.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" className="scroll-smooth">
      <body className={`${dmSans.variable} ${playfair.variable} font-body antialiased selection:bg-brand-gold selection:text-brand-bg`}>
        <div className="noise-overlay"></div>
        {children}
      </body>
    </html>
  );
}
