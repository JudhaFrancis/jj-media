"use client";

import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Menu, X } from "lucide-react";
import Link from "next/link";
import { cn } from "@/lib/utils";

const navLinks = [
  { name: "Services", href: "#services" },
  { name: "About", href: "#about" },
  { name: "Locations", href: "#locations" },
  { name: "Contact", href: "#contact" },
];

export default function Navbar() {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50);
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <>
      <nav
        className={cn(
          "fixed top-0 w-full z-[120] transition-all duration-500 px-6 md:px-12 py-6 flex justify-between items-center",
          isScrolled
            ? "bg-brand-bg/90 backdrop-blur-xl py-4 border-b border-white/5"
            : "bg-transparent py-6"
        )}
      >
        <Link href="/" className="text-3xl font-heading font-black text-brand-gold tracking-tighter">
          JJ.
        </Link>

        {/* Desktop Menu */}
        <div className="hidden md:flex space-x-10 items-center">
          {navLinks.map((link) => (
            <Link
              key={link.name}
              href={link.href}
              className="hover:text-brand-gold transition-colors text-sm uppercase tracking-widest font-medium"
            >
              {link.name}
            </Link>
          ))}
          <Link
            href="#contact"
            className="border border-brand-gold px-6 py-2 text-brand-gold text-xs uppercase tracking-widest font-bold hover:bg-brand-gold hover:text-brand-bg transition-all active:scale-95"
          >
            Book a Site
          </Link>
        </div>

        {/* Mobile Toggle */}
        <button
          className="md:hidden text-brand-gold z-[130]"
          onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
        >
          {mobileMenuOpen ? <X size={32} /> : <Menu size={32} />}
        </button>
      </nav>

      {/* Mobile Menu Overlay */}
      <AnimatePresence>
        {mobileMenuOpen && (
          <motion.div
            initial={{ x: "100%" }}
            animate={{ x: 0 }}
            exit={{ x: "100%" }}
            transition={{ duration: 0.5, ease: [0.22, 1, 0.36, 1] }}
            className="fixed inset-0 bg-brand-bg z-[110] flex flex-col justify-center items-center space-y-8 p-12"
          >
            {navLinks.map((link) => (
              <Link
                key={link.name}
                href={link.href}
                onClick={() => setMobileMenuOpen(false)}
                className="text-4xl font-heading hover:text-brand-gold transition-colors"
              >
                {link.name}
              </Link>
            ))}
            <Link
              href="#contact"
              onClick={() => setMobileMenuOpen(false)}
              className="bg-brand-gold text-brand-bg px-10 py-4 font-bold uppercase tracking-widest active:scale-95"
            >
              Book a Site
            </Link>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
