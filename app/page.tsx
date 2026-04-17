import Navbar from "@/components/Navbar";
import Hero from "@/components/Hero";
import Marquee from "@/components/Marquee";
import Services from "@/components/Services";
import About from "@/components/About";
import Locations from "@/components/Locations";
import ContactForm from "@/components/ContactForm";
import Footer from "@/components/Footer";

export default function Home() {
  return (
    <main className="min-h-screen bg-brand-bg relative">
      <Navbar />
      <Hero />
      <Marquee />
      <Services />
      <About />
      <Locations />
      <ContactForm />
      <Footer />
    </main>
  );
}
